<div class="container">
  <div class="seperate"></div>

  <div class="profile">
    <div class="profile__item">
      <h3>Thông tin tài khoản</h3>
      <form action="<?= DOCUMENT_ROOT . "/profile/update/" . $data['customer']['MSKH'] ?>" method="post" class="profile__info">
        <label for="name">Họ tên: </label>
        <input type="text" name="HoTenKH" id="name" value="<?= $data['customer']['HoTenKH'] ?>">
        <label for="email">Email: </label>
        <input type="text" name="Email" id="email" value="<?= $data['customer']['Email'] ?>">
        <label for="phone">Số điện thoại: </label>
        <input type="text" name="SoDienThoai" id="phone" value="<?= $data['customer']['SoDienThoai'] ?>">
        <label for="address">Địa chỉ: </label>
        <input type="text" name="DiaChi" id="address" value="<?= $data['customer']['DiaChi'] ?>">
        <label for="companyName">Tên công ty: </label>
        <input type="text" name="TenCongTy" id="companyName" value="<?= $data['customer']['TenCongTy'] ?>">
        <button class="btn btn--primary">Cập nhật thông tin</button>
      </form>
    </div>

    <div class="profile__item">
      <h3>Địa chỉ giao hàng</h3>
      <form action="<?= DOCUMENT_ROOT . "/profile/updateAddress/" . $data['customer']['MSKH'] ?>" method="post" class="profile__address">
        <?php $i = 0;
        if (isset($data['addresses'])) : ?>
          <?php
          foreach ($data['addresses'] as $key => $address) : ?>
            <label for="address<?= $key ?>">Địa chỉ <?= $key + 1 ?>: </label>
            <input type="text" name="DiaChi[]" id="address<?= $key ?>" value="<?= $address['DiaChi'] ?>">
          <?php $i = $key + 1;
          endforeach; ?>
        <?php endif; ?>
        <label for="address<?= $key ?>">Thêm địa chỉ <?= $i + 1 ?> (Để trống nếu không muốn thêm): </label>
        <input type="text" name="DiaChi[]" id="address<?= $i ?>">
        <button class="btn btn--primary">Cập nhật địa chỉ</button>
      </form>
    </div>
  </div>

  <div class="profile__order">
    <h3>Lịch sử mua hàng</h3>
    <div class="profile__order__list">
      <?php if (isset($data['orders'])) : ?>
        <?php foreach ($data['orders'] as $i => $order) : ?>
          <div class="profile__order__item">
            <h6>Đơn hàng #<span style="color:blue"><?= $order['SoDonDH'] ?></span></h6>
            <!-- <?php foreach ($order['DonHang'] as $j => $orderDetail) : ?>
              <div class="profile__order__item__book">
                <div><b><?= $orderDetail['bookDetail']['TenHH'] ?></b></div>
                <div><?= number_format($orderDetail['GiaDatHang'], 0); ?>đ</div>
                <div><?= $orderDetail['SoLuong'] ?></div>
              </div>
            <?php endforeach; ?> -->

            <ul>
              <?php foreach ($order['DonHang'] as $j => $orderDetail) : ?>
                <li class="profile__order__item__book">
                  <a href="<?= DOCUMENT_ROOT . "/book/detail/" . $orderDetail['bookDetail']['MSHH'] ?>" ?><img class="profile__order__item__image" src="<?= DOCUMENT_ROOT . "/public/uploads/book-images/" . $orderDetail['bookDetail']['Hinh1'] ?>" alt="">
                  </a>
                  <div class="profile__order__item__info">
                    <a href="<?= DOCUMENT_ROOT . "/book/detail/" . $orderDetail['bookDetail']['MSHH'] ?>" class="profile__order__item__info__title">
                      <?= $orderDetail['bookDetail']['TenHH'] ?>
                    </a>
                    <input type="number" hidden id="priceOfBook<?= $key ?>" value="<?= $orderDetail['bookDetail']['Gia'] ?>">
                    <p class="profile__order__item__info__price"><?= number_format($orderDetail['bookDetail']['Gia'], 0) ?>đ</p>
                    <p>Số lượng: <?= $orderDetail['SoLuong'] ?></p>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>

            <div class="profile__order__item__state">
              <b>Trạng thái: <?= $order['TrangThai'] ?></b>
              <b>Tổng tiền: <span class="profile__order__item__info__price"><?= number_format($order['ThanhTien'], 0); ?>đ</span>
              </b>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else : ?>
        <div>Bạn chưa mua hàng</div>
      <?php endif; ?>
    </div>
  </div>