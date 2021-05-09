 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Thêm mới</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/customer" ?>Quản lý khách hàng</a></li>
           <li class="breadcrumb-item active">Thêm thông tin khách hàng</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form onsubmit="return formValidate();" action="<?= DOCUMENT_ROOT ?>/admin/customer/store" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Thêm thông tin khách hàng</h3>
           </div>
           <div class="card-body">
             <div class="form-group">
               <label for="HoTenKH">Tên khách hàng</label>
               <input required type="text" id="HoTenKH" name="HoTenKH" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="TenCongTy">Tên công ty</label>
               <input required type="text" id="TenCongTy" name="TenCongTy" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="DiaChi">Địa chỉ</label>
               <input required type="text" id="DiaChi" name="DiaChi" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="Email">Email</label>
               <input required type="email" id="Email" name="Email" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="SoDienThoai">Số điện thoại</label>
               <input required type="number" id="SoDienThoai" name="SoDienThoai" class="form-control" onchange="phoneValidate(this);"></input>
               <div class="text-danger mt-2" id="phoneValidateMessage"></div>
             </div>
             <div class=" row">
               <div class="col-12">
                 <a class="btn btn-secondary" href="<?= DOCUMENT_ROOT ?>/admin/customer">
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
 <!-- /.content -->