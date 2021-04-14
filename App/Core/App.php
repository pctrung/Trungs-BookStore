<?php

namespace App\Core;

class App
{
  private $controller = \DEFAULT_CONTROLLER;
  private $action = \DEFAULT_ACTION;
  private $params = [];

  function __construct()
  {
    // Process url
    $url = $this->urlProcess();

    $GLOBALS['currentRoute'] = $this->controller;
    $GLOBALS['currentAction'] = $this->action;

    if ($url[0] === "admin") {
      // handler when admin side
      unset($url[0]);
      if (file_exists(CONT . DS . "admin" . DS . ucfirst($url[1]) . "Controller.php")) {
        $this->controller = ucfirst($url[1]);
        $GLOBALS['currentRoute'] = $url[1];
        unset($url[1]);
      }

      $this->controller .= "Controller";

      require_once(CONT . DS . "admin" . DS . $this->controller . ".php");

      $this->controller = new $this->controller;

      // assign action
      if (method_exists($this->controller, $url[2])) {
        $this->action = $url[2];
        $GLOBALS['currentAction'] = $url[2];
        unset($url[2]);
      }
    } else {
      // handling when client side
      // assign and init controller
      if (file_exists(CONT . DS . ucfirst($url[0]) . "Controller.php")) {
        $this->controller = ucfirst($url[0]);
        $GLOBALS['currentRoute'] = $url[0];
        unset($url[0]);
      }
      $this->controller = $this->controller . "Controller";

      require_once(CONT . DS . $this->controller . ".php");
      $this->controller = new $this->controller;
      // assign action

      if (method_exists($this->controller, $url[1])) {
        $this->action = $url[1];
        $GLOBALS['currentAction'] = $url[1];
        unset($url[1]);
      }
    }

    // assign parameter
    $this->params = $url ? array_values($url) : [];

    // call function Controller -> Action -> Parameter
    call_user_func_array([$this->controller, $this->action], $this->params);
  }

  function urlProcess()
  {
    if (isset($_GET['url'])) {
      $url = explode('/', filter_var(trim($url = $_GET['url'])));

      if ($url[0] === "admin") {
        if (!isset($url[1]) || $url[1] === "") {
          $url[1] = \DEFAULT_CONTROLLER;
        }
        if (!isset($url[2]) || $url[2] === "") {
          $url[2] = \DEFAULT_ACTION;
        }
      }
      return $url;
    } else {
      return [
        DEFAULT_CONTROLLER,
        DEFAULT_ACTION,
      ];
    }
  }
}
