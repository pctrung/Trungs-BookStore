<?php

namespace App\Core;

class Controller
{
  private $route;
  function model($model)
  {
    if (\file_exists(MODEL . DS . $model . ".php")) {
      require_once(MODEL . DS . $model . ".php");
      return new $model;
    } else {
      die("Not found " . $model);
    }
  }

  function view($role, $view, $data = [])
  {
    if (\file_exists(VIEW . DS . $view . ".php")) {
      $view .= ".php";
      require_once(VIEW . DS . "layout/" . $role . "_" . "layout.php");
    } else {
      die("Not found view " . $view);
    }
  }

  function currentRoute()
  {
    $url = explode("/", filter_var(trim($u = $_SERVER['REQUEST_URI'])));
    $this->route = $url[1];
    return $this->route;
  }
}
