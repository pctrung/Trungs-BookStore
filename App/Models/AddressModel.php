<?php

use App\Core\Database;

class AddressModel extends Database
{

  private $table = "DIACHIKH";
  private $primaryKey = "MADC";

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
  function getByUserID($id)
  {
    $id = intval($id);
    $stmt = $this->db->prepare("SELECT * FROM $this->table WHERE MSKH = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    // var_dump($result->fetch_all(MYSQLI_ASSOC));
    // die();
    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return false;
    }
  }

  // function store($data)
  // {
  //   $stmt = $this->db->prepare("INSERT INTO $this->table (HoTenKH, TenCongTy, DiaChi, SoDienThoai, Email, password) VALUES (?, ?, ?, ?, ?, ?)");

  //   $stmt->bind_param("ssssss", $data['HoTenKH'], $data['TenCongTy'], $data['DiaChi'], $data['SoDienThoai'], $data['Email'], $data['password']);

  //   $isSuccess = $stmt->execute();

  //   // die(var_dump($isSuccess));

  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Thêm khách hàng không thành công";
  //   }
  //   return true;
  // }
  // function update($data)
  // {
  //   $stmt = $this->db->prepare("UPDATE $this->table SET HoTenKH = ?, TenCongTy = ?, DiaChi = ?, SoDienThoai = ?, Email = ? WHERE MSKH = ?");

  //   $stmt->bind_param("sssssi", $data['HoTenKH'], $data['TenCongTy'], $data['DiaChi'], $data['SoDienThoai'], $data['Email'], $data['MSKH']);

  //   $isSuccess = $stmt->execute();

  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Không có sự thay đổi";
  //   }
  //   return true;
  // }

  // function delete($id)
  // {
  //   $id = intval($id);

  //   $stmt = $this->db->prepare("DELETE FROM $this->table WHERE MSKH = ?");
  //   $stmt->bind_param("i", $id);
  //   $isSuccess = $stmt->execute();

  //   if (!$isSuccess) {
  //     return $stmt->error;
  //   } else if ($stmt->affected_rows <= 0) {
  //     return "Không tồn tại khách hàng ID: $id";
  //   }

  //   return true;
  // }

}
