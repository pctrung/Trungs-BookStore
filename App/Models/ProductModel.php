<?php

use App\Core\Database;

class ProductModel extends Database
{
  function all()
  {
    $sql = "select * from hanghoa";
    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all();
    } else {
      return "0 results";
    }
  }

  function getByID($id)
  {
    $stmt = $this->db->prepare("SELECT * FROM HANGHOA WHERE MSHH = ?");
    $stmt->bind_param("s", $id);

    $stmt->execute();
    $stmt->bind_result($result);
    $stmt->fetch();

    return $result;
  }
}
