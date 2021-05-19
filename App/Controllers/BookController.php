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
    $this->view("client", "home/index", $data);
  }
  function detail($id)
  {
    $data = $this->book->getByID($id);
    if ($data == false) {
      header("Location: " . DOCUMENT_ROOT . "/home");
    }
    $this->view("client", "books/index", $data);
  }
  function getAllJSON()
  {
    $data = [];
    $result = $this->book->all();
    if ($result) {
      $data = $result;
    }
    foreach ($data as $key => $book) {
      $data[$key]['Hinh1'] = DOCUMENT_ROOT . "/public/uploads/book-images/" . $book['Hinh1'];
      $data[$key]['Gia'] = number_format($book['Gia'], 0, '', ',') . "đ";
    }
    echo ($data === [] ? "Not found any book!" : json_encode($data));
  }
  function getByIDJSON($id = "")
  {
    $data = [];
    $result = $this->book->getByID($id);
    if ($result) {
      $data = $result;
      $data['Hinh1'] = DOCUMENT_ROOT . "/public/uploads/book-images/" . $data['Hinh1'];
      $data['Gia'] = number_format($data['Gia'], 0, '', ',') . "đ";
    }
    echo ($data == [] ? "Not found book id: $id" : json_encode($data));
  }
}
