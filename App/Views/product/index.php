<h1>product</h1>
<?php
foreach ($data as $product) {
  echo $product['MSHH'] . " - ";
  echo $product['QuyCach'] . " - ";
  echo $product['Gia'] . " - ";
  echo $product['SoLuongHang'] . " - ";
  echo $product['GhiChu'] . " - ";
  echo $product['MaLoaiHang'] . "<br/>";
}
