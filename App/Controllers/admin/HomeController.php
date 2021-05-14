<?php

use App\Core\Controller;

class HomeController extends Controller
{
  private $staff;
  private $order;
  private $book;
  function __construct()
  {
    $this->staff = $this->model("StaffModel");
    $this->order = $this->model("OrderModel");
    $this->book = $this->model("BookModel");
  }
  function index()
  {
    $month = 6;

    $data['numOfBook'] = $this->book->getAllNumber();
    $data['numOfStaff'] = $this->staff->getAllNumber();
    $data['numOfOrder'] = $this->order->getAllNumber();
    $data['revenue'] = $this->order->getRevenue(6);
    $this->view("admin", "home" . DS . "index", $data);
  }
}
