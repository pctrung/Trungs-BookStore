<?php

use App\Core\Controller;

class HomeController extends Controller
{

  function __construct()
  {
  }
  function index()
  {
    $data = [];
    $this->view("admin", "home" . DS . "index", $data);
  }
}
