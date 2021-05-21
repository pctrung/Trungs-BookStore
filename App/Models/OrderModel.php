<?php

use App\Core\Database;

class OrderModel extends Database
{
  private $table = "view_DanhSachDonHang";
  private $primaryKey = "SoDonDH";
  private $allData;

  function __construct()
  {
    parent::__construct();
    $allOrderID = $this->db->query("SELECT SoDonDH FROM DATHANG")->fetch_all();

    // var_dump($allOrderID);
    // die();
    $sql = "SELECT * FROM $this->table";
    $result = $this->db->query($sql);
    // var_dump($this->db);
    // die();
    if ($result->num_rows > 0) {
      $data = $result->fetch_all(MYSQLI_ASSOC);
      // var_dump($data);
      // die();

      // Xử lý dữ liệu, thêm mảng các mặt hàng vào 1 đơn
      foreach ($allOrderID as $i => $orderID) {
        $id = $orderID[0];
        $this->allData[$i]['SoDonDH'] = $id;
        foreach ($data as $j => $order) {
          if ($order['SoDonDH'] == $orderID[0]) {
            $this->allData[$i]['MSKH'] = $order['MSKH'];
            $this->allData[$i]['HoTenKH'] = $order['HoTenKH'];
            $this->allData[$i]['MSNV'] = $order['MSNV'];
            $this->allData[$i]['HoTenNV'] = $order['HoTenNV'];
            $this->allData[$i]['NgayDH'] = $order['NgayDH'];
            $this->allData[$i]['NgayGH'] = $order['NgayGH'];
            $this->allData[$i]['TrangThai'] = $order['TrangThai'];
            $this->allData[$i]['DonHang'][$j]['MSHH'] = $order['MSHH'];
            $this->allData[$i]['DonHang'][$j]['SoLuong'] = $order['SoLuong'];
            $this->allData[$i]['DonHang'][$j]['GiaDatHang'] = $order['GiaDatHang'];
            $this->allData[$i]['DonHang'][$j]['GiamGia'] = $order['GiamGia'];
            $this->allData[$i]['ThanhTien'] = $order['ThanhTien'];

            $this->allData[$i]['SoLuongSachMua'] = count($this->allData[$i]['DonHang']);
          }
        }
        // reset index về 0, 1...
        if (isset($this->allData[$i]['DonHang'])) {
          $this->allData[$i]['DonHang'] = is_array($this->allData[$i]['DonHang']) ? array_values($this->allData[$i]['DonHang']) : $this->allData[$i]['DonHang'];
        }
      }
      // print("<pre>" . print_r($this->allData, true) . "</pre>");
      // die();
    } else {
      $this->allData = [];
    }
  }
  function all()
  {
    return $this->allData;
  }
  function getByID($id)
  {
    $result = "";
    foreach ($this->allData as $key => $order) {
      if ($order['SoDonDH'] == $id) {
        $result = $order;
        break;
      }
    }
    //  die(var_dump($result == "" ? false : $result));
    return ($result == "" ? false : $result);
  }

  function store($data)
  {
    $managerStaff = $this->db->query("SELECT * FROM NHANVIEN WHERE CHUCVU = 'Quản lý'")->fetch_assoc();
    // die(var_dump($managerStaff));
    $result = "";
    $ngayGH = $data["NgayGH"] == "" ? "" : $data["NgayGH"];
    $data['MSNV'] = $data["MSNV"] == "" ? $managerStaff['MSNV'] : $data["MSNV"];

    $stmt = $this->db->prepare("INSERT INTO DATHANG ( MSNV, MSKH, NgayDH, NgayGH, TrangThai) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $data["MSNV"], $data["MSKH"], $data["NgayDH"], $ngayGH, $data["TrangThai"]);

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return  $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Thêm không thành công";
    }

    $soDonDH = $this->db->query("SELECT LAST_INSERT_ID()");

    if (!$soDonDH) {
      return  $this->db->error;
    }
    $soDonDH = $soDonDH->fetch_row()[0];

    for ($i = 0; $i < count($data['MSHH']); $i++) {
      $stmt = $this->db->prepare("INSERT INTO CHITIETDATHANG ( SoDonDH, MSHH, SoLuong, GiaDatHang, GiamGia) VALUES (?, ?, ?, ?, ?)");

      if ($stmt) {
        $stmt->bind_param("iiiii", $soDonDH, $data["MSHH"][$i], $data["SoLuong"][$i], $data["GiaDatHang"][$i], $data["GiamGia"][$i]);
        $isSuccess = $stmt->execute();

        if (!$isSuccess) {
          $result = "";
          $ngayGH = $data["NgayGH"] == "" ? "" : $data["NgayGH"];

          $deleteStmt = $this->db->prepare("DELETE FROM DATHANG WHERE SoDonDH = ?");
          $deleteStmt->bind_param("i", $soDonDH);

          $isDeleteSuccess = $deleteStmt->execute();

          if (!$isDeleteSuccess) {
            return  $deleteStmt->error;
          }
          return $stmt->error;
        } else if ($stmt->affected_rows <= 0) {
          return "Thêm không thành công";
        }
      } else {
        return $stmt;
      }
    }
    return true;
    // echo '<pre>';
    // var_dump($stmt);
    // echo '</pre>';
    // die();
  }
  function update($data)
  {
    $ngayGH = $data["NgayGH"] == "" ? "" : $data["NgayGH"];

    $stmt = $this->db->prepare("UPDATE DATHANG SET MSNV = ?, MSKH = ?, NgayDH = ?, NgayGH = ?, TrangThai = ? WHERE SoDonDH = ?");
    $stmt->bind_param("iisssi", $data["MSNV"], $data["MSKH"], $data["NgayDH"], $ngayGH, $data["TrangThai"], $data["SoDonDH"]);

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return  $stmt->error;
    }

    $soDonDH = $data["SoDonDH"];

    $stmt = $this->db->prepare("DELETE FROM CHITIETDATHANG WHERE SoDonDH = ?");
    $stmt->bind_param("i", $soDonDH);
    $isSuccess = $stmt->execute();

    for ($i = 0; $i < count($data["MSHH"]); $i++) {
      $stmt = $this->db->prepare("INSERT INTO CHITIETDATHANG ( SoDonDH, MSHH, SoLuong, GiaDatHang, GiamGia) VALUES (?, ?, ?, ?, ?)");

      if ($stmt) {
        $stmt->bind_param("iiiii", $soDonDH, $data["MSHH"][$i], $data["SoLuong"][$i], $data["GiaDatHang"][$i], $data["GiamGia"][$i]);
        $isSuccess = $stmt->execute();

        if (!$isSuccess) {
          return $stmt->error;
        }
      }
    }

    return true;
  }

  function delete($id)
  {
    $stmt = $this->db->prepare("DELETE FROM CHITIETDATHANG WHERE SoDonDH = ?");
    $stmt->bind_param("i", $id);

    $isSuccess = $stmt->execute();

    $stmt = $this->db->prepare("DELETE FROM DATHANG WHERE SoDonDH = ?");
    $stmt->bind_param("i", $id);

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return  $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không tồn tại mã đơn: " . $id;
    }
    return true;
  }

  function updateState($id, $state)
  {
    $stateValue = "";
    switch ($state) {
      case 1:
        $stateValue = "Chưa xử lý";
        break;
      case 2:
        $stateValue = "Đang chuẩn bị hàng";
        break;
      case 3:
        $stateValue = "Đang giao hàng";
        break;
      case 4:
        $stateValue = "Đã giao";
        break;
      default:
        $stateValue = "Chưa xử lý";
    }
    if (isset($_SESSION['admin'])) {
      $staffID = intval($_SESSION['admin']);
      $stmt = $this->db->prepare("UPDATE DATHANG SET TrangThai = ?, MSNV = ? WHERE SoDonDH = ?");
      $stmt->bind_param("sii", $stateValue, $staffID, $id);
    } else {
      $stmt = $this->db->prepare("UPDATE DATHANG SET TrangThai = ? WHERE SoDonDH = ?");
      $stmt->bind_param("si", $stateValue, $id);
    }

    $isSuccess = $stmt->execute();

    if (!$isSuccess) {
      return  $stmt->error;
    } else if ($stmt->affected_rows <= 0) {
      return "Không có sự thay đổi";
    }
    return true;
  }

  function getAllNumber()
  {
    $sql = "SELECT COUNT(*) FROM DATHANG WHERE TrangThai = 'Chưa xử lý'";

    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_row()[0];
    } else {
      return false;
    }
    return true;
  }

  function getRevenue($month)
  {
    $sql = "SELECT fn_DoanhThuThang($month)";

    $result = $this->db->query($sql);

    if ($result->num_rows > 0) {
      return $result->fetch_row()[0];
    } else {
      return false;
    }
    return true;
  }
  function getByUserID($id)
  {
    $result = [];
    foreach ($this->allData as $key => $order) {
      if ($order['MSKH'] == $id) {
        $result[] = $order;
      }
    }
    if ($result != []) {
      return $result;
    } else {
      return false;
    }
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
  }
}
