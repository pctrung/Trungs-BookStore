<?php

use App\Core\Controller;

class CartController extends Controller
{
  function __construct()
  {
  }
  function index()
  {
    $data = $_SESSION['bookInCart'];
    $this->view("client", "cart/index", $data);
  }
}
