<?php

use App\Core\Controller;

class BookController extends Controller
{
  private $book;
  private $limit = 20;

  function __construct()
  {
    $this->book = $this->model("BookModel");
  }
  function index()
  {
    $currentPage = $this->getCurrentPage();
    $data = $this->product->pagination($currentPage, $this->limit);
    $this->view("client", "books/index", $data);
  }
  function detail($id)
  {
    $product = $this->product->getByID($id);
  }
  function getCurrentPage()
  {
    return isset($_GET['page']) ? $_GET['page'] : 1;
  }
}
