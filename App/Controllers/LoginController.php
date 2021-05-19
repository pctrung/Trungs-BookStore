<?php

use App\Core\Controller;

class LoginController extends Controller
{
  private $customer;
  function __construct()
  {
    $this->customer = $this->model("CustomerModel");
  }
  function index()
  {
    $this->view("client", "login/index", []);
  }
  function checkUser()
  {
    $message = "Vui lòng nhập tài khoản và mật khẩu";
    if (isset($_POST['email']) && isset($_POST['password'])) {
      $email = $_POST['email'];
      $password = $_POST['password'];
      $result = $this->customer->checkUser($email, $password);
      if ($result) {
        $_SESSION['user'] = $email;
        header("Location:" . DOCUMENT_ROOT . "/");
        return;
      } else {
        $message = "Tài khoản hoặc mật khẩu không đúng";
      }
    }
    $_SESSION['customerErrorMessage'] = $message;
    header("Location:" . DOCUMENT_ROOT . "/login");
  }
  function logout()
  {
    unset($_SESSION['user']);
    unset($_SESSION['username']);
    header("Location:" . DOCUMENT_ROOT . "/");
  }
  function signup()
  {
    $this->view("client", "login/signup", []);
  }
  function register()
  {
    if (isset($_POST)) {
      $data = $_POST;

      $data['password'] = isset($data['password']) ? md5($data['password']) : md5("12345");
      $result = $this->customer->store($data);

      if ($result === true) {
        $_SESSION['customerSucessMessage'] = "Đăng ký tài khoản thành công";
      } else {
        $_SESSION['customerErrorMessage'] = "Đăng ký tài khoản không thành công";
      }
      header("Location: " . DOCUMENT_ROOT . "/login");
    } else {
      header("Location: " . DOCUMENT_ROOT . "/login/signup");
    }
  }
  function checkEmail($email)
  {
    $result = false;
    if ($email != "") {
      $result = $this->customer->checkEmail($email);
    }

    echo $result ? "false" : "true";
  }
}
