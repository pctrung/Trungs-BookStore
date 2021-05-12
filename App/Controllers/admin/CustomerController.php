<?php

use App\Core\Controller;

class CustomerController extends Controller
{
  private $customer;

  function __construct()
  {
    $this->customer = $this->model("CustomerModel");
  }
  function index()
  {
    $data = $this->customer->all();
    $this->view("admin", "customers/index", $data);
  }
  function create()
  {
    $data = [];
    $this->view("admin", "customers/create", $data);
  }
  function edit($id)
  {
    $data['updateCustomer'] = $this->customer->getByID($id);
    if (!($data['updateCustomer'])) {
      header("Location: " . DOCUMENT_ROOT . "/admin/customer/index");
    }
    $this->view("admin", "customers/edit", $data);
  }
  function store()
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/customer/index");
    }
    $data = $_POST;

    $result = $this->customer->store($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Thêm khách hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/customer/create");
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
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Cập nhật khách hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }

    header("Location: " . DOCUMENT_ROOT . "/admin/customer/edit/$id");
  }
  function delete($id)
  {

    $result = $this->customer->delete($id);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Xóa khách hàng thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }

    header("Location:" . DOCUMENT_ROOT . "/admin/customer/index");
  }

  // for ajax
  function getByIDJSON($id)
  {
    $data = $this->customer->getByID($id);
    echo json_encode($data);
  }
}
