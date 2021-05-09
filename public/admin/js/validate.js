window.onload = function () {};

function formValidate() {
  var isValid = phoneValidate();

  return isValid;
}

function phoneValidate() {
  var phoneNumber = document.getElementById("SoDienThoai");
  var phoneValidateMessage = document.getElementById("phoneValidateMessage");
  var pattern = "(84|0[3|5|7|8|9])+([0-9]{8})";
  var regex = new RegExp(pattern);

  var result = regex.exec(phoneNumber.value);

  var message;
  if (!result) {
    message = "Số điện thoại phải bao gồm 10 số!";
    phoneValidateMessage.innerText = message;
    return false;
  }

  phoneValidateMessage.innerText = "";
  return true;
}
