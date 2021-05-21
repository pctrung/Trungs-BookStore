<div class="container">
  <div class="seperate"></div>
  <h3 class="title">Giỏ hàng</h3>
  <form action="<?= DOCUMENT_ROOT ?>/cart/checkout" method="post">
    <div class="cart-detail">
      <ul class="cart-detail__book">
        <?php if (count($data['booksInCart']) == 0) : ?>
          <p>Bạn chưa chọn quyển sách nào!</p>
        <?php endif; ?>
        <?php foreach ($data['booksInCart'] as $key => $book) : ?>
          <li class="cart-detail__book__item">
            <a href="<?= DOCUMENT_ROOT . "/book/detail/" . $book['MSHH'] ?>" ?><img class="cart-detail__book__item__image" src="<?= DOCUMENT_ROOT . "/public/uploads/book-images/" . $book['Hinh1'] ?>" alt="">
            </a>
            <div class="cart-detail__book__item__info">
              <a href="<?= DOCUMENT_ROOT . "/book/detail/" . $book['MSHH'] ?>" class="cart-detail__book__item__info__title">
                <?= $book['TenHH'] ?>
              </a>
              <input type="number" hidden id="priceOfBook<?= $key ?>" value="<?= $book['Gia'] ?>">
              <p class="cart-detail__book__item__info__price"><?= number_format($book['Gia'], 0) ?>đ</p>
              <p>Kho: còn <?= $book['SoLuongHang'] ?> quyển</p>
              <label class="cart-detail__book__item__info__number" for="numOfBook<?= $book['MSHH'] ?>">Số lượng: <input onchange="onNumOfBookChange()" id="numOfBook<?= $key ?>" type="number" value="1" min="1" max="99" name="numOfBook[]"></label>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      <div class="cart-detail__user-info">
        <div class="cart-detail__user-info__title">Thông tin nhận hàng</div>

        <?php if (isset($_SESSION['user'])) : ?>
          <div class="cart-detail__user-info__detail">
            <input hidden type="text" name="MSKH" value="<?= $_SESSION['userDetail']['MSKH'] ?>">
            <p><b>Tên người nhận:</b></p>
            <p><?= $_SESSION['userDetail']['HoTenKH'] ?></p>
            <p><b>Số điện thoại:</b></p>
            <p> <?= $_SESSION['userDetail']['SoDienThoai'] ?></p>
            <div class="cart-detail__user-info__detail__address">
              <b>Địa chỉ nhận hàng:</b>
              <?php if (isset($data['addresses'])) : ?>
                <?php foreach ($data['addresses'] as $key2 => $address) : ?>
                  <div class="form-select">
                    <label for="address<?= $key2 + 1 ?>">
                      <input <?= $key2 == 0 ? "checked" : "" ?> type="radio" name="address" id="address<?= $key2 + 1 ?>" value="<?= $address['DiaChi'] ?>"><?= $address['DiaChi'] ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              <?php else : ?>
                <p style="color: darkorange">Bạn chưa thêm địa chỉ giao hàng, hãy vào trang cá nhân để thêm địa chỉ.</p>
              <?php endif; ?>
            </div>
            <div class="cart-detail__user-info__detail__total">
              <b>Tổng tiền:</b>
              <b id="total" class="price"> <?= number_format($data['total'], 0) ?>đ</b>
            </div>
            <div class="cart-detail__user-info__detail__total">
              <button class="btn btn--primary">Đặt hàng</button>
            </div>
          </div>
        <?php else : ?>
          <p style="line-height: 25px;">Bạn chưa đăng nhập, hãy đăng nhập để đặt hàng!</p>
        <?php endif; ?>
      </div>
    </div>
  </form>
</div>
</div>

<script>
  function onNumOfBookChange() {
    var total = document.getElementById("total");
    var totalNumber = 0;
    if (total != undefined) {
      for (var i = 0; i < <?= count($data['booksInCart']) ?>; i++) {
        var numOfBook = document.getElementById("numOfBook" + i).value;
        var priceOfBook = document.getElementById("priceOfBook" + i).value;
        totalNumber += parseInt(numOfBook) * parseInt(priceOfBook);
      }
      total.innerText = new Intl.NumberFormat().format(totalNumber) + "đ";
    }
    return;
  }
</script>