<?php

use App\Core\Database;

class BookKindModel extends Database
{
  function all()
  {
    $sql = "SELECT * FROM LOAIHANGHOA";
    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_all(MYSQLI_ASSOC);
    } else {
      return "0 results";
    }
  }
}
