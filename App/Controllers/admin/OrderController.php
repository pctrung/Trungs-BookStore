<?php

use App\Core\Controller;

class OrderController extends Controller
{
  private $order;

  function __construct()
  {
    $this->order = $this->model("OrderModel");
  }
  function index()
  {
    $data = $this->order->all();
    $this->view("admin", "orders/index", $data);
  }
  function create()
  {
    $data = [];
    $this->view("admin", "orders/create", $data);
  }
  function edit($id)
  {
    $data['updateOrder'] = $this->order->getByID($id);
    if (!($data['updateOrder'])) {
      header("Location: " . DOCUMENT_ROOT . "/admin/order/index");
    }
    // die(print_r($data, true));
    $this->view("admin", "orders/edit", $data);
  }
  function store()
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/order/index");
    }
    $data = $_POST;

    $ngayDH = date_create($data['NgayDH']);
    $ngayGH = date_create($data['NgayGH']);
    // var_dump($ngayDH, $ngayGH, $ngayDH > $ngayGH);
    // die();
    if ($ngayDH > $ngayGH) {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = "Ngày đặt hàng không được lớn hơn ngày giao hàng";
      header("Location: " . DOCUMENT_ROOT . "/admin/order/create");
      return;
    }

    $result = $this->order->store($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Thêm đơn hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/order/create");
  }
  function update($id)
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/order/index");
    }

    $data = $_POST;
    $data['SoDonDH'] = $id;

    $result = $this->order->update($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Cập nhật đơn hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/order/edit/$id");
  }
  function delete($id)
  {

    $result = $this->order->delete($id);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Xóa đơn hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }

    header("Location:" . DOCUMENT_ROOT . "/admin/order/index");
  }

  function updateState($id, $state)
  {
  }
}
