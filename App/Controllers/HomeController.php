<?php

use App\Core\Controller;

class HomeController extends Controller
{
  private $book;

  function __construct()
  {
    $this->book =  $this->model("BookModel");
  }
  function index()
  {
    $data = $this->book->all();
    $this->view("client", "home" . DS . "index", $data);
  }
}
