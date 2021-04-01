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
    // assign and init controller
    if (file_exists(CONT . DS . ucfirst($url[0]) . "Controller.php")) {
      $this->controller = ucfirst($url[0]);
      unset($url[0]);
    }
    $this->controller = $this->controller . "Controller";

    require_once(CONT . DS . $this->controller . ".php");

    $this->controller = new $this->controller;

    // assign action
    if (isset($url[1])) {
      if (method_exists($this->controller, $url[1])) {
        $this->action = $url[1];
      }
      unset($url[1]);
    }

    // assign parameter
    $this->params = $url ? array_values($url) : [];

    // call function Controller -> Action -> Parameter
    call_user_func_array([$this->controller, $this->action], $this->params);
  }

  function urlProcess()
  {
    if (isset($_GET['url'])) {
      return explode('/', filter_var(trim($url = $_GET['url'])));
    } else if (!isset($_GET['url'])) {
      return [
        'Home',
        'index',
      ];
    }
  }
}
