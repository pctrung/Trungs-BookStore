<div class="banner">
  <img src="<?= DOCUMENT_ROOT . "/public/img/banner.png" ?>" alt="">
</div>

<?php if (isset($data['popularBook'])) : ?>
  <div class="popular-book__title">
    <h3>Sách bán chạy trong tháng</h3>
  </div>
  <section class="popular-book">
    <?php foreach ($data['popularBook'] as $key => $popularBook) : ?>
      <?php if ($key < 2) : ?>
        <div class="popular-book__item">
          <img class="popular-book__item__image" src="<?= DOCUMENT_ROOT . "/public/uploads/book-images/" . $popularBook['Hinh1'] ?>" alt="Best Seller Book">
          <div class="popular-book__item__info">
            <div class="popular-book__item__info__title"><a href="<?= DOCUMENT_ROOT . "/book/detail/" . $popularBook['MSHH'] ?>"><?= $popularBook['TenHH'] ?></a></div>
            <div class="popular-book__item__info__price"><?= number_format($popularBook['Gia'], 0, '', ',') ?>đ </div>
            <div class="popular-book__item__info__content"><?= $popularBook['GhiChu'] ?></div>
            <div class="popular-book__item__button" id="cartButton<?= $key  ?>">
              <?php
              $flag = 0;
              foreach ($_SESSION['bookInCart'] as $key2 => $value) {
                if ($value['MSHH'] == $popularBook['MSHH']) {
              ?>
                  <button onClick="removeInCart(<?= $popularBook['MSHH'] ?>, <?= $key ?>)" class="btn btn--secondary">Đã thêm vào giỏ</button>
                <?php
                  $flag = 1;
                  break;
                }
              }
              if ($flag == 0) {
                ?>
                <button onClick="addToCart(<?= $popularBook['MSHH'] ?>, <?= $key ?>)" class="btn btn--primary">Thêm vào giỏ +</button>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </section>
<?php endif; ?>

<div class="category-book__title">
  <h3>Tất cả sách</h3>
  <span class="category-book__title__more">
    Xem thêm
  </span>
</div>
<nav>
  <ul id="navCategory" class="nav">
    <?php foreach ($data['categories'] as $key => $category) : ?>
      <?php if ($key + 1 <= 13) : ?>
        <li onclick="addCategory(this)" class="nav__item" value="<?= $category['MaLoaiHang'] ?>"><?= $category['TenLoaiHang'] ?></li>
      <?php endif; ?>
      <?php if ($key + 1 == 14) : ?>
        <li class="nav__item">...</li>
      <?php endif; ?>
    <?php endforeach; ?>
</nav>
<div class="category-book" id="category-book">

</div>
<div id="view-more-button" class="container category-book__view-more">
  <!-- <button class="btn btn--secondary">Xem thêm</button> -->
</div>

<script>
  function addToCart(id, key) {
    ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "false") {
          alert("Thêm sách vào giỏ không thành công");
        } else {
          document.getElementById("headerCartCount").innerText = this.responseText;
          document.getElementById("cartButton" + key).innerHTML =
            `
          <button onClick="removeInCart(${id}, ${key})" class="btn btn--secondary">Đã thêm vào giỏ</button>
          `
        }
      }
    };
    ajax.open("GET", "<?= DOCUMENT_ROOT ?>/book/addToCart/" + id, true);
    ajax.send();
  }

  function removeInCart(id, key) {
    ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "false") {
          alert("Thêm sách vào giỏ không thành công");
        } else {
          document.getElementById("headerCartCount").innerText = this.responseText;
          document.getElementById("cartButton" + key).innerHTML =
            `
          <button onClick="addToCart(${id}, ${key})" class="btn btn--primary">Thêm vào giỏ +</button>
          `
        }
      }
    };
    ajax.open("GET", "<?= DOCUMENT_ROOT ?>/book/removeInCart/" + id, true);
    ajax.send();
  }
</script>