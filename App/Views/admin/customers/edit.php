 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Cập nhật</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/customer" ?>Quản lý khách hàng</a></li>
           <li class="breadcrumb-item active">Chỉnh sửa khách hàng</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form onsubmit="return formValidate();" action="<?= DOCUMENT_ROOT ?>/admin/customer/update/<?= $data['updateCustomer']['MSKH'] ?>" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Cập nhật thông tin khách hàng</h3>
           </div>
           <div class="card-body">

             <div class="form-group">
               <label for="MSKH">Mã khách hàng</label>
               <input disabled type="text" name="MSKH" id="MSKH" class="form-control" value="<?= $data['updateCustomer']['MSKH'] ?>">
             </div>
             <div class="form-group">
               <label for="HoTenKH">Tên khách hàng</label>
               <input required type="text" id="HoTenKH" name="HoTenKH" class="form-control" value="<?= $data['updateCustomer']['HoTenKH'] ?>"></input>
             </div>
             <div class="form-group">
               <label for="TenCongTy">Tên công ty</label>
               <input required type="text" id="TenCongTy" name="TenCongTy" class="form-control" value="<?= $data['updateCustomer']['TenCongTy'] ?>"></input>
             </div>
             <div class="form-group">
               <label for="DiaChi">Địa chỉ</label>
               <input required type="text" id="DiaChi" name="DiaChi" class="form-control" value="<?= $data['updateCustomer']['DiaChi'] ?>"></input>
             </div>
             <div class="form-group">
               <label for="SoDienThoai">Số điện thoại</label>
               <input required type="tel" id="SoDienThoai" name="SoDienThoai" class="form-control" value="<?= $data['updateCustomer']['SoDienThoai'] ?>" onchange="phoneValidate(this);"></input>
               <div class="text-danger mt-2" id="phoneValidateMessage"></div>
             </div>
             <div class="form-group">
               <label for="Email">Email</label>
               <input required type="email" id="Email" name="Email" class="form-control" value="<?= $data['updateCustomer']['Email'] ?>"></input>
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