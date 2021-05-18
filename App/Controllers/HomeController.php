<?php

use App\Core\Controller;

class HomeController extends Controller
{
  private $book;
  private $bookKind;

  function __construct()
  {
    $this->book =  $this->model("BookModel");
    $this->bookKind =  $this->model("BookKindModel");
  }
  function index()
  {
    $data['books'] = $this->book->all();
    $data['popularBook'][] = $data['books'][35];
    $data['popularBook'][] = $data['books'][34];
    $data['popularBook'][] = $data['books'][34];
    $data['popularBook'][] = $data['books'][32];
    $data['popularBook'][] = $data['books'][31];
    $data['popularBook'][] = $data['books'][12];
    $data['popularBook'][] = $data['books'][23];
    $data['popularBook'][] = $data['books'][13];
    $data['popularBook'][] = $data['books'][14];
    $data['categories'] = $this->bookKind->all();
    $this->view("client", "home" . DS . "index", $data);
  }
}
