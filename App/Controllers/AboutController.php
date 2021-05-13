<?php

use App\Core\Controller;

class AboutController extends Controller
{
  function index()
  {
    $this->view("client", "/about/index", []);
  }
}
