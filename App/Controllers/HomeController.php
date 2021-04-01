<?php

use App\Core\Controller;

class HomeController extends Controller
{
  private $product;

  function __construct()
  {
    $this->product =  $this->model("ProductModel");
  }
  function index()
  {
    $data = $this->product->all();
    $this->view("client", "home" . DS . "index", $data);
  }
}
