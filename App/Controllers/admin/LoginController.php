<?php

use App\Core\Controller;

class LoginController extends Controller
{
  private $staff;
  function __construct()
  {
    $this->staff = $this->model("StaffModel");
  }
  function index()
  {
    $this->view("admin", "login/index", []);
  }
  function checkUser()
  {
    $message = "Vui lòng nhập tài khoản và mật khẩu";

    if (isset($_POST['id']) && isset($_POST['password'])) {
      $id = $_POST['id'];
      $password = $_POST['password'];
      $result = $this->staff->checkUser($id, $password);
      if ($result) {
        $_SESSION['admin'] = $id;
        header("Location:" . DOCUMENT_ROOT . "/admin");
        return;
      } else {
        $message = "Tài khoản hoặc mật khẩu không đúng";
      }
    }
    $_SESSION['errorMessage'] = $message;
    header("Location:" . DOCUMENT_ROOT . "/admin/login");
  }
  function logout()
  {
    unset($_SESSION['admin']);
    header("Location:" . DOCUMENT_ROOT . "/admin/login");
  }
}
