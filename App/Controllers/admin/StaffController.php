<?php

use App\Core\Controller;

class StaffController extends Controller
{
  private $staff;

  function __construct()
  {
    $this->staff = $this->model("StaffModel");
  }
  function index()
  {
    $data = $this->staff->all();
    $this->view("admin", "staffs/index", $data);
  }
  function create()
  {
    $data = [];
    $this->view("admin", "staffs/create", $data);
  }
  function edit($id)
  {
    $data['updateStaff'] = $this->staff->getByID($id);
    if (!($data['updateStaff'])) {
      header("Location: " . DOCUMENT_ROOT . "/admin/staff/index");
    }
    $this->view("admin", "staffs/edit", $data);
  }
  function store()
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/staff/index");
    }
    $data = $_POST;

    $result = $this->staff->store($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Thêm nhân viên thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/staff/create");
  }
  function update($id)
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/staff/index");
    }

    $data = $_POST;
    $data['MSNV'] = $id;

    $result = $this->staff->update($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Cập nhật nhân viên thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/staff/edit/$id");
  }
  function delete($id)
  {

    $result = $this->staff->delete($id);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Xóa nhân viên thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }

    header("Location:" . DOCUMENT_ROOT . "/admin/staff/index");
  }
}
