 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Thêm mới</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/order" ?>Quản lý đơn đặt hàng</a></li>
           <li class="breadcrumb-item active">Tạo mới đơn đặt hàng</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form onsubmit="return orderValidate();" action="<?= DOCUMENT_ROOT ?>/admin/order/store" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Tạo mới đơn đặt hàng</h3>
           </div>
           <div class="card-body">
             <div class="form-group">
               <label for="MSNV">Mã nhân viên</label>
               <input required oninput="onChangeStaffID()" type="text" id="staffIDInput" name="MSNV" class="form-control"></input>
               <div id="staffDetail"></div>
             </div>
             <div class="form-group">
               <label for="MSKH">Mã khách hàng</label>
               <input required oninput="onChangeCustomerID()" type="text" id="cusomterIDInput" name="MSKH" class="form-control"></input>
               <div id="customerDetail"></div>
             </div>
             <div class="form-group">
               <label for="NgayDH">Ngày đặt hàng</label>
               <input required type="date" id="NgayDH" name="NgayDH" class="form-control" onchange="orderValidate()"></input>
             </div>
             <div class="form-group">
               <label for="NgayGH">Ngày giao hàng</label>
               <input required type="date" id="NgayGH" name="NgayGH" class="form-control" onchange="orderValidate()"></input>
               <div id="dateMessage" class="text-red mt-1"></div>
             </div>
             <div class=" form-group">
               <label for="TrangThai">Trạng thái đơn hàng</label>
               <select required class="form-control custom-select" name="TrangThai" id="TrangThai">
                 <option disabled selected value="" class="text-secondary">Chọn trạng thái</option>
                 <option value="Chưa xử lý">Chưa xử lý</option>
                 <option value="Đang chuẩn bị hàng">Đang chuẩn bị hàng</option>
                 <option value="Đang giao hàng">Đang giao hàng</option>
                 <option value="Đã giao">Đã giao</option>
               </select>
             </div>
             <div class="form-group">
               <label for="numOfBook">Số lượng sách</label>
               <div class="input-group">
                 <input onchange="onNumOfBookChange(this)" required type="number" id="numOfBookInput" name="numOfBookInput" class="form-control" value="1" min="1" max="99"></input>
                 <div class="input-group-append">
                   <input type="button" class="btn btn-primary border-left" onClick="decreaseNumOfBook()" value="-"></input>
                   <input type="button" class="btn btn-primary border-left" onClick="increaseNumOfBook()" value="+"></input>
                   <input type="button" class="btn btn-primary border-left" onClick="onNumOfBookChange()" value="Cập nhật"></input>
                 </div>
               </div>
             </div>
             <div id="bookOption">
             </div>
             <div class=" row">
               <div class="col-12">
                 <a class="btn btn-secondary" href="<?= DOCUMENT_ROOT ?>/admin/order">
                   Hủy
                 </a>
                 <input type="submit" value="Lưu" class="btn btn-success float-right">
               </div>
             </div>
           </div>
           <!-- /.card-body -->
         </div>
       </div>
     </div>

   </form>
 </section>

 <script>
   window.onload = init();

   function init() {
     onNumOfBookChange();
     onChangeStaffID();
   }
   // XỬ LÝ AJAX

   // NHÂN VIÊN
   // hàm xử lý gọi ajax khi nhập vào mã nhân viên
   function onChangeStaffID() {
     var staffIDInput = document.getElementById('staffIDInput');

     if (staffIDInput.value != "") {
       var ajax = new XMLHttpRequest();

       ajax.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           if (this.responseText == "false") {
             staffNotFound(staffIDInput);
           } else {
             staffFound(staffIDInput, this.responseText);
           }
         }
       };

       ajax.open("post", "<?= DOCUMENT_ROOT ?>/admin/staff/getByIDJSON/" + staffIDInput.value, true);
       ajax.send();
     } else if (staffIDInput.value == "") {
       emptyStaffID();
     }
     return;
   }

   function emptyStaffID() {
     let message = document.getElementById('staffDetail');
     message.innerHTML = "";
   }

   // hàm xử lý khi không tìm thấy mã nhân viên
   function staffNotFound(staffIDInput) {
     let message = document.getElementById('staffDetail');

     message.classList = "text-danger mt-1";
     message.innerHTML = "Không tồn tại mã nhân viên: " + staffIDInput.value;
   }

   // xử lý khi tìm thấy mã nhân viên
   function staffFound(staffIDInput, data) {
     let message = document.getElementById('staffDetail');

     if (data != "") {
       let staff = JSON.parse(data);

       message.classList = "text-info mt-1";

       message.innerHTML = `
        <p>
          Tên nhân viên: <span class="text-dark">${staff.HoTenNV}</span><br>
          Chức vụ: <span class="text-dark">${staff.ChucVu}</span><br>
          Số điện thoại: <span class="text-dark">${staff.SoDienThoai}</span><br>
        </p>
        `
     }

   }

   // KHÁCH HÀNG
   // hàm xử lý gọi ajax khi nhập vào mã khách hàng
   function onChangeCustomerID() {
     var customerIDInput = document.getElementById('cusomterIDInput');

     if (customerIDInput.value != "") {
       var ajax = new XMLHttpRequest();

       ajax.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           if (this.responseText == "false") {
             customerNotFound(customerIDInput);
           } else {
             customerFound(customerIDInput, this.responseText);
           }
         }
       };

       ajax.open("post", "<?= DOCUMENT_ROOT ?>/admin/customer/getByIDJSON/" + customerIDInput.value, true);
       ajax.send();
     } else if (customerIDInput.value == "") {
       emptyCustomerID();
     }
     return;
   }

   function emptyCustomerID() {
     let message = document.getElementById('customerDetail');
     message.innerHTML = "";
   }

   // hàm xử lý khi không tìm thấy mã khách hàng
   function customerNotFound(customerIDInput) {
     let message = document.getElementById('customerDetail');

     message.classList = "text-danger mt-1";
     message.innerHTML = "Không tồn tại mã khách hàng: " + customerIDInput.value;
   }

   // xử lý khi tìm thấy mã khách hàng
   function customerFound(customerIDInput, data) {
     let message = document.getElementById('customerDetail');

     if (data != "") {
       let customer = JSON.parse(data);

       message.classList = "text-info mt-1";

       message.innerHTML = `
        <p>
          Tên khách hàng: <span class="text-dark">${customer.HoTenKH}</span><br>
          Tên công ty: <span class="text-dark">${customer.TenCongTy}</span><br>
          Email: <span class="text-dark">${customer.Email}</span><br>
          Số điện thoại: <span class="text-dark">${customer.SoDienThoai}</span><br>
        </p>
        `
     }

   }

   // SẢN PHẨM
   // hàm xử lý gọi ajax khi nhập vào mã sản phẩm
   function onChangeBookID(e) {
     if (e.target.value != "") {
       var ajax = new XMLHttpRequest();

       ajax.onreadystatechange = function() {
         if (this.readyState == 4 && this.status == 200) {
           if (this.responseText == "false") {
             bookNotFound(e.target);
           } else {
             bookFound(e.target, this.responseText);
           }
         }
       };

       ajax.open("post", "<?= DOCUMENT_ROOT ?>/admin/book/getByIDJSON/" + e.target.value, true);
       ajax.send();
     } else if (e.target.value == "") {
       emptyBookID(e.target);
     }
     return;
   }

   function emptyBookID(bookIDInput) {
     let bookNameInputDetail = bookIDInput.id.slice(0, bookIDInput.id.indexOf("ID")) + "Detail";

     let message = document.getElementById(bookNameInputDetail);

     message.innerHTML = "";
   }

   // hàm xử lý khi không tìm thấy mã sảm phẩm
   function bookNotFound(bookIDInput) {
     let bookNameInputDetail = bookIDInput.id.slice(0, bookIDInput.id.indexOf("ID")) + "Detail";

     let message = document.getElementById(bookNameInputDetail);

     message.classList = "text-danger mt-1";

     message.innerHTML = "Không tồn tại mã sách: " + bookIDInput.value;
   }

   // xử lý khi tìm thấy mã sản phẩm
   function bookFound(bookIDInput, data) {

     let imageSource = "<?= DOCUMENT_ROOT ?>/public/uploads/book-images/";

     let bookNameInputDetail = bookIDInput.id.slice(0, bookIDInput.id.indexOf("ID")) + "Detail";

     let message = document.getElementById(bookNameInputDetail);

     let book = JSON.parse(data);

     message.classList = "text-info mt-1";

     message.innerHTML = `
       <div class="row">
        <div class="col-2">
          <img src="${imageSource + book.Hinh1}" class="rounded float-left w-100"/>
        </div>
        <div class="col-10">
            <div>
              Tên sách: <span class="text-dark">${book.TenHH}</span>
            </div>
            <div>
              Tồn kho: <span class="text-dark">${book.SoLuongHang}</span>
            </div>
            <div>
              Đơn giá: <input name="GiaDatHang[]" class="text-dark form-control" readonly value="${book.Gia}"></input>
            </div>
            <div>
              Giảm giá: <input name="GiamGia[]" class="text-dark form-control"></input>
            </div>
        </div>
       </div>
     `
   }

   // hàm thêm sản phẩm
   function addBookOption(numOfBook) {
     numOfBook = parseInt(numOfBook);
     // tạo các tùy chọn sách
     let bookOption = document.getElementById('bookOption');
     let currentOptionLength = bookOption.children.length;

     if (numOfBook > currentOptionLength) {

       let nextOptionIndex = currentOptionLength + 1;

       for (var i = nextOptionIndex; i <= numOfBook; i++) {
         currentBookOption = "bookOption" + i;

         // tạo element form group để append label và input
         let formGroup = document.createElement("div");
         formGroup.classList = "form-group";

         let title = document.createElement("h4");
         title.innerText = "Sách " + i;
         title.classList = "font-weight-bold text-info";

         let row = document.createElement("div");
         row.classList = "row";

         let col1 = document.createElement("div");
         col1.classList = "col-6";
         let col2 = document.createElement("div");
         col2.classList = "col-6";

         // tạo cột mã sách
         let nameLabel = document.createElement("label");
         nameLabel.htmlFor = currentBookOption + "ID";
         nameLabel.innerText = "Mã sách " + i;

         let nameInput = document.createElement("input");
         nameInput.type = "text";
         nameInput.id = currentBookOption + "ID";
         nameInput.name = "MSHH[]";
         nameInput.classList = "form-control";
         nameInput.required = "true";

         // tạo cột số lượng
         let numberLabel = document.createElement("label");
         numberLabel.htmlFor = currentBookOption + "Number";
         numberLabel.innerText = "Số lượng";

         let numberInput = document.createElement("input");
         numberInput.type = "number";
         numberInput.id = currentBookOption + "Number";
         numberInput.name = "SoLuong[]";
         numberInput.classList = "form-control";
         numberInput.required = "true";

         col1.appendChild(nameLabel);
         col1.appendChild(nameInput);

         col2.appendChild(numberLabel);
         col2.appendChild(numberInput);

         row.appendChild(col1);
         row.appendChild(col2);

         formGroup.appendChild(title);
         formGroup.appendChild(row);

         // tạo thông tin chi tiết ajax
         row2 = document.createElement("div");
         row2.id = currentBookOption + "Detail";
         row2.classList = "row";

         formGroup.appendChild(row2);

         bookOption.appendChild(formGroup);

         //tạo event gọi ajax lấy dữ liệu từ mã sản phẩm
         nameInput.addEventListener('input', onChangeBookID);
       }
     }
   }

   // hàm xóa sản phẩm
   function removeBookOption(numOfBook) {
     let bookOption = document.getElementById('bookOption');
     let currentOptionLength = bookOption.children.length;

     for (let i = numOfBook + 1; i <= currentOptionLength; i++) {
       removeOption = bookOption.children[numOfBook];
       removeOption.remove();
     }
   }

   // tăng số sản phẩm
   function increaseNumOfBook() {
     let numOfBookInput = document.getElementById("numOfBookInput");
     if (numOfBookInput.valueAsNumber > 99) {
       numOfBookInput.valueAsNumber = 99;
     } else if (numOfBookInput.value == "") {
       numOfBookInput.valueAsNumber = document.getElementById('bookOption').children.length + 1;
     } else {
       numOfBookInput.valueAsNumber += 1;
     }
     onNumOfBookChange();
   }

   // giảm số sản phẩm
   function decreaseNumOfBook() {
     let numOfBookInput = document.getElementById("numOfBookInput");
     if (numOfBookInput < 1) {
       numOfBookInput.valueAsNumber = 1;
     } else {
       numOfBookInput.valueAsNumber -= 1;
     }
     onNumOfBookChange();
   }

   // hàm xử ly thay đổi số sản phẩm
   function onNumOfBookChange(x) {
     let numOfBookInput = document.getElementById("numOfBookInput");

     if (numOfBookInput.valueAsNumber < 1) {
       numOfBookInput.valueAsNumber = 1;
     } else if (numOfBookInput.valueAsNumber > 99) {
       numOfBookInput.valueAsNumber = 99;
     }

     numOfBook = numOfBookInput.valueAsNumber

     let bookOption = document.getElementById('bookOption');
     let currentOptionLength = bookOption.children.length;

     if (numOfBook > currentOptionLength) {
       addBookOption(numOfBook);
     } else if (numOfBook < currentOptionLength) {
       removeBookOption(numOfBook);
     }
   }
 </script>
 <!-- /.content -->