<?php

use App\Core\Database;

class BookModel extends Database
{
  private $table = "HANGHOA";
  private $primaryKey = "MSHH";
  function all()
  {
    $sql = "SELECT * FROM view_DanhSachHangHoa";
    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return false;
    }
  }

  function getByID($id)
  {
    $id = intval($id);
    $stmt = $this->db->prepare("SELECT * FROM view_DanhSachHangHoa WHERE MSHH = ?");
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
    $stmt = $this->db->prepare("INSERT INTO $this->table (TenHH, QuyCach, Gia, SoLuongHang, MaLoaiHang, GhiChu, Hinh1, Hinh2, Hinh3) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssiiissss", $data['TenHH'], $data['QuyCach'], $data['Gia'], $data['SoLuongHang'], $data['MaLoaiHang'], $data['GhiChu'], $data['Hinh1'], $data['Hinh2'], $data['Hinh3']);

    $isSuccess = $stmt->execute();
    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Thêm sách không thành công";
    }
    return true;
  }
  function update($data)
  {
    $stmt = $this->db->prepare("UPDATE $this->table SET TenHH = ?, QuyCach = ?, Gia = ?, SoLuongHang = ?, MaLoaiHang = ?, GhiChu = ?, Hinh1 = ?, Hinh2 = ?, Hinh3 = ? WHERE MSHH = ?");

    $stmt->bind_param("ssiiissssi", $data['TenHH'], $data['QuyCach'], $data['Gia'], $data['SoLuongHang'], $data['MaLoaiHang'], $data['GhiChu'], $data['Hinh1'], $data['Hinh2'], $data['Hinh3'], $data['MSHH']);
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

    $stmt = $this->db->prepare("DELETE FROM $this->table WHERE MSHH = ?");
    $stmt->bind_param("i", $id);
    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không tồn tại sách ID: $id";
    }

    return true;
  }

  // function pagination($currentPage, $limit)
  // {
  //   $startNumber = ($currentPage - 1) * $limit;

  //   $stmt = $this->db->prepare("SELECT * FROM $this->table LIMIT ?, ?");
  //   $stmt->bind_param("ii", $startNumber, $limit);
  //   $stmt->execute();

  //   $result = $stmt->get_result();

  //   if ($result->num_rows > 0) {
  //     return $result->fetch_all(MYSQLI_ASSOC);
  //   } else {
  //     return "0 results";
  //   }
  // }
}
