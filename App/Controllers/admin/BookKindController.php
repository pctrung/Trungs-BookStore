<?php

use App\Core\Controller;

class BookKindController extends Controller
{
  private $bookKind;

  function __construct()
  {
    $this->bookKind = $this->model("BookKindModel");
  }
  function index()
  {
    $data = $this->bookKind->all();
    $this->view("admin", "book-kinds/index", $data);
  }
  function create()
  {
    $data = [];
    $this->view("admin", "book-kinds/create", $data);
  }
  function edit($id)
  {
    $data['updateBookKind'] = $this->bookKind->getByID($id);
    if (!($data['updateBookKind'])) {
      header("Location: " . DOCUMENT_ROOT . "/admin/bookkind/index");
    }
    $this->view("admin", "book-kinds/edit", $data);
  }
  function store()
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/bookkind/index");
    }
    $data = $_POST;

    $result = $this->bookKind->store($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Thêm loại sách thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = "Thêm loại sách không thành công";
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/bookkind/create");
  }
  function update($id)
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/bookkind/index");
    }

    $data = $_POST;
    $data['MaLoaiHang'] = $id;

    $result = $this->bookKind->update($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Cập nhật loại sách thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = "Cập nhật loại sách không thành công";
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/bookkind/edit/$id");
  }
  function delete($id)
  {

    $result = $this->bookKind->delete($id);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Xóa loại sách thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = "Xóa loại sách không thành công";
    }

    header("Location:" . DOCUMENT_ROOT . "/admin/bookkind/index");
  }
}
