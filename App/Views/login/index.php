<div class="login__background">
  <form class="login__form" action="<?= DOCUMENT_ROOT . "/login/checkUser" ?>" method="post">
    <h1 class="login__form__title">Đăng nhập <br> Trung's Bookstore</h1>
    <p class="login__form__message">
      <span style="color:red">
        <?php echo isset($_SESSION['customerErrorMessage']) ? $_SESSION['customerErrorMessage'] : "";
        unset($_SESSION['customerErrorMessage']); ?>
      </span>
      <span style="color:green">
        <?php echo isset($_SESSION['customerSucessMessage']) ? $_SESSION['customerSucessMessage'] : "";
        unset($_SESSION['customerSucessMessage']); ?>
      </span>
    </p>
    <div class="login__form__input">
      <label for="email">Email (Kiểm thử: trungb1809424@student.ctu.edu.vn)</label>
      <input id="email" type="text" name="email" placeholder="Nhập email của bạn...">
    </div>
    <div class="login__form__input">
      <label for="password">Mật khẩu (Kiểm thử: 12345678)</label>
      <input id="password" type="password" name="password" placeholder="Nhập mật khẩu...">
    </div>
    <button class="btn btn--primary">Đăng nhập</button>
    <div style="margin-left:auto; margin-top: 10px;">Chưa có tài khoản? <a href="<?= DOCUMENT_ROOT ?>/login/signup" style="font-weight: bold; color: red; margin-left: 10px;">Đăng ký</a></div>
  </form>
</div>