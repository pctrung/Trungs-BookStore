<?php

use App\Core\Controller;

class ProductController extends Controller
{
  private $product;

  function __construct()
  {
    $this->product = $this->model("ProductModel");
  }
  function index()
  {
    $data = $this->product->all();
    $this->view("client", "product/index", $data);
  }
  function detail($id)
  {
    $product = $this->product->getByID($id);
    var_dump($product);
  }
}
