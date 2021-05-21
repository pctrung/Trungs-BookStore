<div class="seperate"></div>
<div class="container">
  <h3>Kết quả tìm kiếm cho: "<?= isset($data['key']) ? $data['key'] : "" ?>"</h3>
  <?php if (isset($data['searchBooks']) && is_array($data['searchBooks'])) : ?>
    <div class="search-book">
      <?php foreach ($data['searchBooks'] as $key => $book) : ?>
        <a href="<?= DOCUMENT_ROOT ?>/book/detail/<?= $book['MSHH'] ?>">
          <div class="search-book__item">
            <img class="search-book__item__image" src="<?= DOCUMENT_ROOT ?>/public/uploads/book-images/<?= $book['Hinh1'] ?>" alt="Ảnh bìa sách Biện Hộ Cho Một Nền Giáo Dục Khai Phóng">
            <div class="search-book__item__title">
              <?= $book['TenHH'] ?>
            </div>
            <div class="search-book__item__price">
              <?= number_format($book['Gia'], 0) ?>đ
            </div>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  <?php elseif (isset($data['searchBooks']) && is_string($data['searchBooks'])) : ?>
    <p><?= $data['searchBooks'] ?></p>
  <?php endif; ?>
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