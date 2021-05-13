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

function orderValidate() {
  // check date is valid
  if (document.getElementById("NgayDH") && document.getElementById("NgayGH")) {
    let ngayDH = new Date(document.getElementById("NgayDH").value);
    let ngayGH = new Date(document.getElementById("NgayGH").value);

    if (ngayGH < ngayDH) {
      document.getElementById("dateMessage").innerText =
        "Ngày giao hàng không được nhỏ hơn ngày đặt hàng!";
      return false;
    } else {
      document.getElementById("dateMessage").innerText = "";
    }
  }

  // check customer id and staff id is valid
  if (
    document.getElementById("staffDetail") ||
    document.getElementById("customerDetail")
  ) {
    let staffDetail = document.getElementById("staffDetail").innerText;
    let customerDetail = document.getElementById("customerDetail").innerText;

    if (
      staffDetail.includes("Không tồn tại") ||
      customerDetail.includes("Không tồn tại")
    ) {
      return false;
    }
  }
  return true;
}
