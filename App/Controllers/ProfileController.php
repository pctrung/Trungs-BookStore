<?php

use App\Core\Controller;

class ProfileController extends Controller
{
  private $customer;
  private $order;
  private $address;
  private $book;

  function __construct()
  {
    $this->customer =  $this->model("CustomerModel");
    $this->address =  $this->model("AddressModel");
    $this->order =  $this->model("OrderModel");
    $this->book = $this->model("BookModel");
  }
  function index()
  {
    $id = 0;
    $data = [];
    if (isset($_SESSION['userDetail'])) {
      // lay thong tin khach hang
      $id = $_SESSION['userDetail']['MSKH'];
      $data['customer'] = $this->customer->getByID($id);

      // lay thong tin dia chi
      $addresses = $this->address->getByUserID($id);
      if ($addresses != false) {
        $data['addresses'] = $addresses;
      }

      // lay thong tin don hang
      $orders = $this->order->getByUserID($id);
      if ($orders != false) {
        $data['orders'] = $orders;
        $data['orders'] = array_reverse($data['orders'], true);
        for ($i = 0; $i < count($data['orders']); $i++) {
          for ($j = 0; $j < count($data['orders'][$i]['DonHang']); $j++) {
            $data['orders'][$i]['DonHang'][$j]['bookDetail'] = $this->book->getByID($data['orders'][$i]['DonHang'][$j]['MSHH']);
          }
        }
      }

      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';
      // die();

      $this->view("client", "profile" . DS . "index", $data);
    } else {
      header("Location: " . DOCUMENT_ROOT . "/home");
    }
  }
  function update($id)
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/customer/index");
    }

    $data = $_POST;
    $data['MSKH'] = $id;

    $result = $this->customer->update($data);

    if ($result === true) {
      $_SESSION['userAlert']['success'] = true;
      $_SESSION['userAlert']['message'] = "Cập nhật khách hàng thành công";
    } else {
      $_SESSION['userAlert']['success'] = false;
      $_SESSION['userAlert']['message'] = $result;
    }

    header("Location: " . DOCUMENT_ROOT . "/profile");
  }
  function updateAddress($id)
  {
    if (!isset($_POST) || $id == 0) {
      header("Location: " . DOCUMENT_ROOT . "/profile");
    }

    $data = $_POST;
    $data['MSKH'] = $id;

    $result = $this->address->updateByUserID($data);
    if ($result === true) {
      $_SESSION['userAlert']['success'] = true;
      $_SESSION['userAlert']['message'] = "Cập nhật địa chỉ thành công";
    } else {
      $_SESSION['userAlert']['success'] = false;
      $_SESSION['userAlert']['message'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/profile");
  }
}
