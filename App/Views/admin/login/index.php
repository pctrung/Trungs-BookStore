<div class="hold-transition login-page">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary py-4">
      <div class="card-header text-center">
        <a href="#" class="h4"><b>Quản lý Trung's BookStore</b></a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Đăng nhập bằng tài khoản admin để vào trang quản lý</p>

        <p class="login-box-msg text-red"><?php echo isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : "";
                                          unset($_SESSION['errorMessage']); ?></p>

        <form action="<?= DOCUMENT_ROOT ?>/admin/login/checkUser" method="post">
          <div class="form-group mb-3">
            <label class="" for="username">Mã số nhân viên (Kiểm thử: 28)</label>
            <input required id="username" name="id" type="text" class="form-control" placeholder="Nhập mã số nhân viên">
          </div>
          <div class="form-group mb-3">
            <label class="" for="username">Mật khẩu (Kiểm thử: 12345)</label>
            <input required type="password" name="password" class="form-control" placeholder="Nhập mật khẩu">
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!--
        <p class="mt-2">
          <a href="/admin/login/signup" class="text-center">Đăng ký tài khoản admin</a>
        </p> -->
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->
</div>