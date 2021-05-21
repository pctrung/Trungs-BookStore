<?php

use App\Core\Controller;

class CartController extends Controller
{
  private $order;
  private $address;
  function __construct()
  {
    $this->address = $this->model("AddressModel");
    $this->order = $this->model("OrderModel");
  }
  function index()
  {
    $data = [];
    if (isset($_SESSION['userDetail']['MSKH'])) {
      $addresses = $this->address->getByUserID($_SESSION['userDetail']['MSKH']);
      if ($addresses != false) {
        $data['addresses'] = $addresses;
      }
    }
    $data['booksInCart'] = $_SESSION['booksInCart'];
    $data['total'] = 0;
    foreach ($data['booksInCart'] as $key => $book) {
      $data['total'] += $book['Gia'];
    }
    $_SESSION['cartDetail'] = $data;
    $this->view("client", "cart/index", $data);
  }
  function checkout()
  {
    $data['address'] = $_POST['address'];
    $data["MSNV"] = "";
    $data["MSKH"] = $_SESSION['userDetail']['MSKH'];
    $data["NgayDH"] = date("Y-m-d");
    $data["NgayGH"] = date('Y-m-d', strtotime($data["NgayDH"] . ' + 5 days'));
    $data["TrangThai"] = "Chưa xử lý";

    foreach ($_SESSION['cartDetail']['booksInCart'] as $key => $book) {
      $data['MSHH'][] = $book['MSHH'];
      $data['GiaDatHang'][] = intval($book['Gia']);
      $data['GiamGia'][] = 0;
      $data['SoLuong'][] = intval($_POST['numOfBook'][$key]);
    }
    $result = $this->order->store($data);
    if ($result !== true) {
      $_SESSION['userAlert']['success'] = false;
      $_SESSION['userAlert']['message'] = "Đặt hàng không thành công";
    } else {
      $_SESSION['userAlert']['success'] = true;
      $_SESSION['userAlert']['message'] = "Đặt hàng thành công";
      unset($_SESSION['booksInCart']);
    }
    header("Location:" . DOCUMENT_ROOT . "/home");
  }
}
