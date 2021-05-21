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
  function updateByUserID($data)
  {
    $stmt = $this->db->prepare("DELETE FROM $this->table WHERE MSKH = ?");

    $stmt->bind_param("i", $data['MSKH']);

    $isSuccess = $stmt->execute();

    foreach ($data['DiaChi'] as $key => $address) {
      if ($address != "") {
        $stmt = $this->db->prepare("INSERT INTO $this->table(MSKH, DIACHI) VALUE (?, ?)");

        $stmt->bind_param("is", $data['MSKH'], $address);

        $isSuccess = $stmt->execute();
      }
    }

    if (!$isSuccess) {
      return $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không có sự thay đổi";
    }
    return true;
  }
}
