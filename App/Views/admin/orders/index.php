<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Quản lý đơn đặt hàng</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/home">Trang chủ</a></li>
          <li class="breadcrumb-item active">Quản lý đơn đặt hàng</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <?php require_once(VIEW . DS . "shared/noti.php") ?>

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex align-items-center">
            <h3 class="card-title">Tất cả đơn đặt hàng</h3>
            <a href="<?= DOCUMENT_ROOT ?>/admin/order/create" class="btn btn-primary ml-auto">Thêm đơn đặt hàng</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="order-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Mã đơn đặt hàng</th>
                  <th>Tên KH</th>
                  <th>Tên NV</th>
                  <th>Ngày đặt</th>
                  <th>Ngày giao</th>
                  <th>Trạng thái</th>
                  <th>Tổng tiền</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $order) : ?>
                  <tr>
                    <td><?= $order['SoDonDH'] ?></td>
                    <td><?= $order['HoTenKH'] ?></td>
                    <td><?= $order['HoTenNV'] ?></td>
                    <td><?= $order['NgayDH'] ?></td>
                    <td><?= ($order['NgayGH'] == "" || $order['NgayGH'] == "00/00/0000") ? "Chưa giao" : $order['NgayGH'] ?></td>
                    <td>
                      <select class="form-control custom-select" name="TrangThai" id="TrangThai<?= $key ?>" onchange="onChangeStateOrder(<?= $order['SoDonDH'] ?>,this)">
                        <option value="1" <?= $order['TrangThai'] == 'Chưa xử lý' ? 'selected' : '' ?>>Chưa xử lý</option>
                        <option value="2" <?= $order['TrangThai'] == 'Đang chuẩn bị hàng' ? 'selected' : '' ?>>Đang chuẩn bị hàng</option>
                        <option value="3" <?= $order['TrangThai'] == 'Đang giao hàng' ? 'selected' : '' ?>>Đang giao hàng</option>
                        <option value="4" <?= $order['TrangThai'] == 'Đã giao' ? 'selected' : '' ?>>Đã giao</option>
                      </select>
                    </td>
                    <td><?= number_format($order['ThanhTien'], 0, '', ','); ?>đ</td>
                    <td class="project-actions text-right">
                      <a class="btn btn-info btn-sm mb-1" href="<?= DOCUMENT_ROOT ?>/admin/order/edit/<?= $order['SoDonDH'] ?>">
                        <i class="fas fa-info-circle">
                        </i>
                        Chi tiết
                      </a>
                      <button type="button" class="btn btn-sm btn-danger mb-1" data-toggle="modal" data-target="#deleteBookConfirm<?= $key ?>">
                        <i class="fas fa-trash">
                        </i>
                        Xóa
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="deleteBookConfirm<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBookConfirmTitle<?= $key ?>" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle<?= $key ?>">Xác nhận xóa</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-left">
                              Xóa đơn đặt hàng <?= $order['SoDonDH'] ?>?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                              <a href="<?= DOCUMENT_ROOT ?>/admin/order/delete/<?= $order['SoDonDH'] ?>" class="btn btn-danger">Xóa</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<script>
  function onChangeStateOrder(orderID, trangThai) {
    var state = trangThai.options[trangThai.selectedIndex].value;
    window.location.replace("<?= DOCUMENT_ROOT . "/admin/order/updateState/" ?>" + orderID + "/" + state);

    // Tính làm ajax nhưng bị lỗi

    // var ajax = new XMLHttpRequest();

    // ajax.onreadystatechange = function() {
    //   if (this.readyState == 4 && this.status == 200) {
    //     if (this.responseText == "false") {
    //       bookNotFound(e.target);
    //     } else {
    //       bookFound(e.target, this.responseText);
    //     }
    //   }
    // };

    // ajax.open("post", "<?= DOCUMENT_ROOT . "/admin/order/updateState/" ?>" + orderID + "/" + state, true);
    // ajax.send();
  }
</script>

<!-- <option value="Chưa xử lý" <?= $order['TrangThai'] == 'Chưa xử lý' ? 'selected' : '' ?>><a href="<?= DOCUMENT_ROOT ?>/admin/order/updateState/<?= $order['SoDonDH'] ?>/0">Chưa xử lý</a></option>
<option value="Đang chuẩn bị hàng" <?= $order['TrangThai'] == 'Đang chuẩn bị hàng' ? 'selected' : '' ?>><a href="<?= DOCUMENT_ROOT ?>/admin/order/updateState/<?= $order['SoDonDH'] ?>/1">Đang chuẩn bị hàng</a></option>
<option value="Đang giao hàng" <?= $order['TrangThai'] == 'Đang giao hàng' ? 'selected' : '' ?>><a href="<?= DOCUMENT_ROOT ?>/admin/order/updateState/<?= $order['SoDonDH'] ?>/2">Đang giao hàng</a></option>
<option value="Đã giao" <?= $order['TrangThai'] == 'Đã giao' ? 'selected' : '' ?>><a href="<?= DOCUMENT_ROOT ?>/admin/order/updateState/<?= $order['SoDonDH'] ?>/3">Đang giao hàng</a></option> -->