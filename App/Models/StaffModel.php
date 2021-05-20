<?php

use App\Core\Database;

class StaffModel extends Database
{
  private $table = "NHANVIEN";
  private $primaryKey = "MSNV";
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
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE MSNV = ?");
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
    $stmt = $this->db->prepare("INSERT INTO $this->table (HoTenNV, ChucVu, DiaChi, SoDienThoai) VALUES (?, ?, ?, ?)");

    $stmt->bind_param("ssss", $data['HoTenNV'], $data['ChucVu'], $data['DiaChi'], $data['SoDienThoai']);

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Thêm nhân viên không thành công";
    }
    return true;
  }
  function update($data)
  {
    $stmt = $this->db->prepare("UPDATE $this->table SET HoTenNV = ?, ChucVu = ?, DiaChi = ?, SoDienThoai = ? WHERE MSNV = ?");

    $stmt->bind_param("ssssi", $data['HoTenNV'], $data['ChucVu'], $data['DiaChi'], $data['SoDienThoai'], $data['MSNV']);

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

    $stmt = $this->db->prepare("DELETE FROM $this->table WHERE MSNV = ?");
    $stmt->bind_param("i", $id);
    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không tồn tại nhân viên ID: $id";
    }

    return true;
  }
  function checkUser($id, $password)
  {
    $md5Pass = md5($password);
    $id = intval($id);
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE MSNV = ? AND password = ?");
    $stmt->bind_param("is", $id, $md5Pass);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $username = $result->fetch_assoc();
      $_SESSION['adminName'] = $username['HoTenNV'];
      return true;
    } else {
      return false;
    }
  }

  function getAllNumber()
  {
    $sql = "SELECT COUNT(*) FROM $this->table";

    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_row()[0];
    } else {
      return false;
    }
    return true;
  }
}
