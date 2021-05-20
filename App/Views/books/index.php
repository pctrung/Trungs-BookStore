<section class="container">
  <div class="seperate"></div>
  <h3 class="title">Chi tiết hàng hoá</h3>
  <div class="book-detail">
    <img src="<?= DOCUMENT_ROOT . "/public/uploads/book-images/" . $data['Hinh1'] ?>" alt="Ảnh bìa sách <?= $data['TenHH'] ?>" class="book-detail__image">
    <div class="book-detail__info">
      <div class="book-detail__info__title"><?= $data['TenHH'] ?></div>
      <div class="book-detail__info__price"><?= number_format($data['Gia'], 0) ?>đ</div>
      <div class="book-detail__info__detail">
        <p class="book-detail__info__detail__title">Mã sách:</p>
        <p class="book-detail__info__detail__title">Thể loại:</p>
        <p class="book-detail__info__detail__title">Kho:</p>
        <p><?= $data['MSHH'] ?></p>
        <p><?= $data['TenLoaiHang'] ?></p>
        <p><?= $data['SoLuongHang'] ?></p>
      </div>
      <div id="cartButton">
        <?php
        $flag = 0;
        foreach ($_SESSION['booksInCart'] as $key => $value) {
          if ($value['MSHH'] == $data['MSHH']) {
        ?>
            <button onClick="removeInCart(<?= $data['MSHH'] ?>)" class="btn btn--secondary book-detail__button">Đã thêm vào giỏ</button>
          <?php
            $flag = 1;
            break;
          }
        }
        if ($flag == 0) {
          ?>
          <button onClick="addToCart(<?= $data['MSHH'] ?>)" class="btn btn--primary book-detail__button">Thêm vào giỏ +</button>
        <?php
        }
        ?>
      </div>

    </div>

  </div>
  <div class="book-detail__content">
    <p class="book-detail__content__title">Sơ lược sách</p>
    <p class="book-detail__content__content"><?= $data['GhiChu'] ?></p>
  </div>
</section>

<script>
  function addToCart(id) {
    ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "false") {
          alert("Thêm sách vào giỏ không thành công");
        } else {
          document.getElementById("headerCartCount").innerText = this.responseText;
          document.getElementById("cartButton").innerHTML =
            `
          <button onClick="removeInCart(${id})" class="btn btn--secondary book-detail__button">Đã thêm vào giỏ</button>
          `
        }
      }
    };
    ajax.open("GET", "<?= DOCUMENT_ROOT ?>/book/addToCart/" + id, true);
    ajax.send();
  }

  function removeInCart(id) {
    ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "false") {
          alert("Thêm sách vào giỏ không thành công");
        } else {
          document.getElementById("headerCartCount").innerText = this.responseText;
          document.getElementById("cartButton").innerHTML =
            `
          <button onClick="addToCart(${id})" class="btn btn--primary book-detail__button">Thêm vào giỏ +</button>
          `
        }
      }
    };
    ajax.open("GET", "<?= DOCUMENT_ROOT ?>/book/removeInCart/" + id, true);
    ajax.send();
  }
</script>