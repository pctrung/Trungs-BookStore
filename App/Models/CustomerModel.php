<?php

use App\Core\Database;

class CustomerModel extends Database
{

  private $table = "KHACHHANG";
  private $primaryKey = "MSKH";

  function all()
  {
    $sql = "SELECT * FROM $this->table";
    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return "0 results";
    }
  }
  function getByID($id)
  {
    $id = intval($id);
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE MSKH = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }

  function store($data)
  {
    $stmt = $this->db->prepare("INSERT INTO $this->table (HoTenKH, TenCongTy, DiaChi, SoDienThoai, Email, password) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssss", $data['HoTenKH'], $data['TenCongTy'], $data['DiaChi'], $data['SoDienThoai'], $data['Email'], $data['password']);

    $isSuccess = $stmt->execute();

    // die(var_dump($isSuccess));

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Thêm khách hàng không thành công";
    }
    return true;
  }
  function update($data)
  {
    $stmt = $this->db->prepare("UPDATE $this->table SET HoTenKH = ?, TenCongTy = ?, DiaChi = ?, SoDienThoai = ?, Email = ? WHERE MSKH = ?");

    $stmt->bind_param("sssssi", $data['HoTenKH'], $data['TenCongTy'], $data['DiaChi'], $data['SoDienThoai'], $data['Email'], $data['MSKH']);

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không có sự thay đổi";
    }
    return true;
  }

  function delete($id)
  {
    $id = intval($id);

    $stmt = $this->db->prepare("DELETE FROM $this->table WHERE MSKH = ?");
    $stmt->bind_param("i", $id);
    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không tồn tại khách hàng ID: $id";
    }

    return true;
  }

  function checkUser($email, $password)
  {
    $md5Pass = md5($password);
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE Email = ? AND password = ?");
    $stmt->bind_param("ss", $email, $md5Pass);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $user = $result->fetch_assoc();
      $_SESSION['userDetail'] = $user;
      return true;
    } else {
      return false;
    }
  }
  function checkEmail($email)
  {
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }
}
