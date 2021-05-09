 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Cập nhật</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/staff" ?>Quản lý nhân viên</a></li>
           <li class="breadcrumb-item active">Chỉnh sửa nhân viên</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form onsubmit="return formValidate();" action="<?= DOCUMENT_ROOT ?>/admin/staff/update/<?= $data['updateStaff']['MSNV'] ?>" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Cập nhật thông tin nhân viên</h3>
           </div>
           <div class="card-body">

             <div class="form-group">
               <label for="MSNV">Mã nhân viên</label>
               <input disabled type="text" name="MSNV" id="MSNV" class="form-control" value="<?= $data['updateStaff']['MSNV'] ?>">
             </div>
             <div class="form-group">
               <label for="HoTenNV">Tên nhân viên</label>
               <input required type="text" id="HoTenNV" name="HoTenNV" class="form-control" value="<?= $data['updateStaff']['HoTenNV'] ?>"></input>
             </div>
             <div class="form-group">
               <label for="ChucVu">Chức vụ</label>
               <select required class="form-control custom-select" name="ChucVu" id="ChucVu">
                 <option <?= $data['updateStaff']['ChucVu'] == "Chủ tịch" ? "selected" : "" ?> value="Chủ tịch">Chủ tịch</option>
                 <option <?= $data['updateStaff']['ChucVu'] == "Giám đốc" ? "selected" : "" ?> value="Giám đốc">Giám đốc</option>
                 <option <?= $data['updateStaff']['ChucVu'] == "Nhân viên bán hàng" ? "selected" : "" ?> value="Nhân viên bán hàng">Nhân viên bán hàng</option>
                 <option <?= $data['updateStaff']['ChucVu'] == "Nhân viên kỹ thuật" ? "selected" : "" ?> value="Nhân viên kỹ thuật">Nhân viên kỹ thuật</option>
                 <option <?= $data['updateStaff']['ChucVu'] == "Quản lý" ? "selected" : "" ?> value="Quản lý">Quản lý</option>
                 <option <?= $data['updateStaff']['ChucVu'] == "Trưởng phòng" ? "selected" : "" ?> value="Trưởng phòng">Trưởng phòng</option>
               </select>
             </div>
             <div class="form-group">
               <label for="DiaChi">Địa chỉ</label>
               <input required type="text" id="DiaChi" name="DiaChi" class="form-control" value="<?= $data['updateStaff']['DiaChi'] ?>"></input>
             </div>
             <div class="form-group">
               <label for="SoDienThoai">Số điện thoại</label>
               <input required type="tel" id="SoDienThoai" name="SoDienThoai" class="form-control" value="<?= $data['updateStaff']['SoDienThoai'] ?>" onchange="phoneValidate(this);"></input>
               <div class="text-danger mt-2" id="phoneValidateMessage"></div>
             </div>
             <div class=" row">
               <div class="col-12">
                 <a class="btn btn-secondary" href="<?= DOCUMENT_ROOT ?>/admin/staff">
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