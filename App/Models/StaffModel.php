<?php

use App\Core\Database;

class StaffModel extends Database
{
  function all()
  {
    $sql = "SELECT * FROM NHANVIEN";
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
    $stmt = $this->db->prepare("SELECT * FROM NHANVIEN WHERE MSNV = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return false;
    }
  }

  // function store($data)
  // {
  //   $stmt = $this->db->prepare("INSERT INTO LOAIHANGHOA (TenLoaiHang) VALUES (?)");

  //   $stmt->bind_param("s", $data['TenLoaiHang']);

  //   $isSuccess = $stmt->execute();
  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Thêm không thành công";
  //   }
  //   return true;
  // }
  // function update($data)
  // {
  //   $stmt = $this->db->prepare("UPDATE LOAIHANGHOA SET TenLoaiHang = ? WHERE MaLoaiHang = ?");

  //   $stmt->bind_param("si", $data['TenLoaiHang'], $data['MaLoaiHang']);

  //   $isSuccess = $stmt->execute();
  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Cập nhật không thành công";
  //   }
  //   return true;
  // }

  // function delete($id)
  // {
  //   $id = intval($id);

  //   $stmt = $this->db->prepare("DELETE FROM LOAIHANGHOA WHERE MaLoaiHang = ?");
  //   $stmt->bind_param("i", $id);
  //   $isSuccess = $stmt->execute();

  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Không tồn tại sách ID: $id";
  //   }

  //   return true;
  // }
}
