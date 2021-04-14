<?php

namespace App\Core;

class Controller
{
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
    if ($role === "admin") {
      $view = "admin" . DS . $view . ".php";
    } else {
      $view .= ".php";
    }

    if (\file_exists(VIEW . DS . $view)) {
      require_once(VIEW . DS . "layout/" . $role . "_" . "layout.php");
    } else {
      die("Not found view " . $view);
    }
  }
}
