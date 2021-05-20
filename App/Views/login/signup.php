<div class="login__background" style="height:100%">
  <form onsubmit="return onSubmit();" class="login__form" action="<?= DOCUMENT_ROOT . "/login/register" ?>" method="post">
    <h1 class="login__form__title">Đăng ký tài khoản <br> Trung's Bookstore</h1>
    <p class="login__form__message">
      <?php echo isset($_SESSION['customerErrorMessage']) ? $_SESSION['customerErrorMessage'] : "";
      unset($_SESSION['customerErrorMessage']); ?>
    </p>
    <div class="login__form__input">
      <div class="login__form__input">
        <label for="Email">Email <span style="color:red; font-weight: normal;">(*)</span></label>
        <input oninput="onEmailChange(this.value)" required id="Email" type="email" name="Email" placeholder="Nhập email của bạn...">
        <div id="emailCheckMessage" class="signupCheckMessage"></div>
      </div>
      <label for="HoTenKH">Họ tên <span style="color:red; font-weight: normal;">(*)</span></label>
      <input required id="HoTenKH" type="text" name="HoTenKH" placeholder="Nhập họ tên của bạn...">
    </div>
    <div class="login__form__input">
      <label for="password">Mật khẩu <span style="color:red; font-weight: normal;">(*)</span></label>
      <input required id="password" type="password" name="password" placeholder="Nhập mật khẩu...">
      <div id="passwordCheckMessage" class="signupCheckMessage"></div>
    </div>
    <div class="login__form__input">
      <label for="re-password">Nhập lại mật khẩu <span style="color:red; font-weight: normal;">(*)</span></label>
      <input required id="rePassword" type="password" name="re-password" placeholder="Nhập lại mật khẩu...">
    </div>
    <div class="login__form__input">
      <label for="phone">Số điện thoại <span style="color:red; font-weight: normal;">(*)</span></label>
      <input required id="phone" type="text" name="SoDienThoai" placeholder="Nhập số điện thoại của bạn...">
      <div id="phoneCheckMessage" class="signupCheckMessage"></div>
    </div>
    <div class="login__form__input">
      <label for="DiaChi">Địa chỉ <span style="color:red; font-weight: normal;">(*)</span></label>
      <input required id="DiaChi" type="text" name="DiaChi" placeholder="Nhập địa chỉ giao hàng của bạn...">
    </div>
    <div class="login__form__input">
      <label for="TenCongTy">Tên công ty</label>
      <input id="TenCongTy" type="text" name="TenCongTy" placeholder="Nhập tên công ty của bạn...">
    </div>
    <button class="btn btn--primary">Đăng ký</button>
    <div style="margin-left:auto; margin-top: 10px;">Đã có tài khoản? <a href="<?= DOCUMENT_ROOT ?>/login" style="font-weight: bold; color: red; margin-left: 10px;">Đăng nhập</a></div>
</div>
</form>
</div>
<script>
  // dùng ajax kiểm tra email trùng
  function onEmailChange(email) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var emailCheckMessage = document.getElementById("emailCheckMessage");
        if (emailCheckMessage != undefined) {
          if (this.responseText == "true") {
            emailCheckMessage.style = "color: green";
            emailCheckMessage.innerText = "Tài khoản khả dụng";
          } else if (this.responseText != "true") {
            emailCheckMessage.style = "color: red";
            emailCheckMessage.innerText = "Email đã được sử dụng";
          }
        }
      }
    };
    ajax.open("GET", "<?= DOCUMENT_ROOT ?>" + "/login/checkEmail/" + email, true);
    ajax.send();
  }

  function checkPhone(phone) {
    if (phone.length < 10 || phone.length > 10) {
      return "Số điện thoại phải gồm 10 số";
    }
    return true;
  }

  function checkPassword(password, rePassword) {
    var result = true;
    if (password !== rePassword) {
      result = "Mật khẩu phải trùng khớp"
    }
    if (password.length < 8) {
      result = "Mật khẩu phải có ít nhất 8 ký tự";
    }
    return result;
  }

  function onSubmit() {
    var password = document.getElementById("password").value;
    var rePassword = document.getElementById("rePassword").value;
    var phone = document.getElementById("phone").value;

    var checkPasswordValue = checkPassword(password, rePassword);
    var checkPhoneValue = checkPhone(phone);

    var result;
    if (checkPasswordValue !== true) {
      document.getElementById("passwordCheckMessage").innerText = checkPasswordValue;
      result = false;
    } else {
      document.getElementById("passwordCheckMessage").innerText = "";
    }
    if (checkPhoneValue !== true) {
      document.getElementById("phoneCheckMessage").innerText = checkPhoneValue;
      result = false;
    } else {
      document.getElementById("phoneCheckMessage").innerText = "";
    }
    if (document.getElementById("emailCheckMessage").innerText == "Email đã được sử dụng") {
      result = false
    }
    return result;
  }
</script>