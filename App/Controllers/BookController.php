<?php

use App\Core\Controller;

class BookController extends Controller
{
  private $book;
  function __construct()
  {
    $this->book = $this->model("BookModel");
  }
  function index()
  {
    $data = [];
    $this->view("client", "books/index", $data);
  }
  function getAllJSON()
  {
    $data = [];
    $result = $this->book->all();
    if ($result) {
      $data = $result;
    }
    echo ($data === [] ? "Not found any book!" : json_encode($data));
  }
  function getByIDJSON($id = "")
  {
    $data = [];
    $result = $this->book->getByID($id);
    if ($result) {
      $data = $result;
    }
    echo ($data == [] ? "Not found book id: $id" : json_encode($data));
  }
}
