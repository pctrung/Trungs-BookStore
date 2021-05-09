<?php

use App\Core\Controller;

class BookController extends Controller
{
  private $book;
  private $bookKind;

  function __construct()
  {
    $this->book = $this->model("BookModel");
    $this->bookKind = $this->model("BookKindModel");
  }
  function index()
  {
    $data = $this->book->all();
    $this->view("admin", "books/index", $data);
  }
  function create()
  {
    $data['bookKind'] = $this->bookKind->all();
    $this->view("admin", "books/create", $data);
  }
  function edit($id)
  {
    $data['updateBook'] = $this->book->getByID($id);

    if (!($data['updateBook'])) {
      header("Location: " . DOCUMENT_ROOT . "/admin/book");
    }

    $data['bookKind'] = $this->bookKind->all();
    $this->view("admin", "books/edit", $data);
  }
  function store()
  {
    if (!isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin");
    }

    $data = $_POST;

    $data['Gia'] = intval($_POST['Gia']);
    $data['SoLuongHang'] = intval($_POST['SoLuongHang']);
    $data['MaLoaiHang'] = intval($_POST['MaLoaiHang']);
    $data['Hinh1'] = "";
    $data['Hinh2'] = "";
    $data['Hinh3'] = "";

    // handle image
    $output_dir = ROOT . DS . "public" . DS . "uploads" . DS . "book-images"; //Path for file upload

    for ($i = 1; $i <= 3; $i++) {
      if (isset($_FILES["Hinh$i"])) {
        if ($_FILES["Hinh$i"]['name'] != "") {
          $randomNum = time() + $i;
          $imageName = str_replace(' ', '-', strtolower($_FILES["Hinh$i"]['name']));
          $imageExt = substr($imageName, strrpos($imageName, '.'));
          $imageExt = str_replace('.', '', $imageExt);
          $newImageName = $randomNum . '.' . $imageExt;

          move_uploaded_file($_FILES["Hinh$i"]["tmp_name"], $output_dir . DS . $newImageName);
          $data["Hinh$i"] = $newImageName;
        }
      }
    }
    $result = $this->book->store($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Thêm sách thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/book/create");
  }
  function update($id)
  {

    $updateBook = $this->book->getByID($id);
    if (!$updateBook || !isset($_POST)) {
      header("Location: " . DOCUMENT_ROOT . "/admin/book");
    }
    $data = $_POST;

    $data['MSHH'] = $id;
    $data['Gia'] = intval($_POST['Gia']);
    $data['SoLuongHang'] = intval($_POST['SoLuongHang']);
    $data['MaLoaiHang'] = intval($_POST['MaLoaiHang']);
    $data['Hinh1'] = $updateBook['Hinh1'];
    $data['Hinh2'] = $updateBook['Hinh2'];
    $data['Hinh3'] = $updateBook['Hinh3'];

    // handle image
    $output_dir = ROOT . DS . "public" . DS . "uploads" . DS . "book-images"; //Path for file upload

    for ($i = 1; $i <= 3; $i++) {
      if (isset($_FILES["Hinh$i"])) {
        if ($_FILES["Hinh$i"]['name'] != "") {
          $randomNum = time() + $i;
          $imageName = str_replace(' ', '-', strtolower($_FILES["Hinh$i"]['name']));
          $imageExt = substr($imageName, strrpos($imageName, '.'));
          $imageExt = str_replace('.', '', $imageExt);
          $newImageName = $randomNum . '.' . $imageExt;

          move_uploaded_file($_FILES["Hinh$i"]["tmp_name"], $output_dir . DS . $newImageName);

          $oldImage = $updateBook["Hinh$i"];

          if ($updateBook["Hinh$i"] != "") {
            unlink(ROOT . DS  . 'public' . DS . 'uploads' . DS . 'book-images' . DS . $oldImage);
          }

          $data["Hinh$i"] = $newImageName;
        }
      }
    }

    $result = $this->book->update($data);

    if ($result === true) {
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Cập nhật thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }
    header("Location: " . DOCUMENT_ROOT . "/admin/book/edit/$id");
  }
  function delete($id)
  {
    $deleteBook = $this->book->getByID($id);

    $result = $this->book->delete($id);

    if ($result === true) {
      for ($i = 1; $i <= 3; $i++) {
        if ($deleteBook["Hinh$i"] != "") {
          unlink(ROOT . DS  . 'public' . DS . 'uploads' . DS . 'book-images' . DS . $deleteBook["Hinh$i"]);
        }
      }
      $_SESSION['alert']['success'] = true;
      $_SESSION['alert']['messages'] = "Xóa thành công";
    } else {
      $_SESSION['alert']['success'] = false;
      $_SESSION['alert']['messages'] = $result;
    }

    header("Location:" . DOCUMENT_ROOT . "/admin/book/index");
  }
}
