<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Quản lý sách</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/home">Trang chủ</a></li>
          <li class="breadcrumb-item active">Quản lý sách</li>
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
            <h3 class="card-title">Tất cả sách</h3>
            <a href="<?= DOCUMENT_ROOT ?>/admin/book/create" class="btn btn-primary ml-auto">Thêm sách</a>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="main-table" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>Mã</th>
                  <th>Tên sách</th>
                  <th>Quy Cách</th>
                  <th>Số lượng tồn</th>
                  <th>Loại sách</th>
                  <th>Ghi chú</th>
                  <th>Giá</th>
                  <th>Ảnh bìa</th>
                  <th>Thao tác</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($data as $key => $book) : ?>
                  <tr>
                    <td><?= $book['MSHH'] ?></td>
                    <td><?= $book['TenHH'] ?></td>
                    <td><?= $book['QuyCach'] ?></td>
                    <td><?= $book['SoLuongHang'] ?></td>
                    <td><?= $book['TenLoaiHang'] ?></td>
                    <td><span class="d-inline-block text-truncate" style="max-width: 150px;"><?= $book['GhiChu'] ?></span></td>
                    <td> <?= number_format($book['Gia'], 0, '', ',') ?>đ </td>
                    <td>
                      <?php if ($book['Hinh1'] != "") : ?>
                        <img src="<?= BOOK_IMAGES . '/' . $book['Hinh1'] ?>" class="my-admin-book-thumbnail rounded mx-auto d-block" alt="Ảnh Bìa <?= $book['MSHH'] ?>">
                      <?php endif; ?>
                    </td>
                    <td class="project-actions text-right d-flex flex-column d-none d-md-block">
                      <a class="btn btn-info btn-sm mb-1 w-100" href="<?= DOCUMENT_ROOT ?>/admin/book/edit/<?= $book['MSHH'] ?>">
                        <i class="fas fa-edit">
                        </i>
                        Sửa
                      </a>
                      <button type="button" class="btn btn-sm btn-danger mb-1 w-100" data-toggle="modal" data-target="#deleteBookConfirm<?= $key ?>">
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
                              Xóa quyển sách <?= $book['TenHH'] ?>?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                              <a href="<?= DOCUMENT_ROOT ?>/admin/book/delete/<?= $book['MSHH'] ?>" class="btn btn-danger">Xóa</a>
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