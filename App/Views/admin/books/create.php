 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Thêm mới</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/book" ?>Quản lý sách</a></li>
           <li class="breadcrumb-item active">Thêm sách</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form action="<?= DOCUMENT_ROOT ?>/admin/book/store" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Nhập thông tin sách</h3>
           </div>
           <div class="card-body">
             <div class="form-group">
               <label for="MaLoaiHang">Loại sách</label>
               <select required id="MaLoaiHang" name="MaLoaiHang" class="form-control custom-select">
                 <option disable selected>Select one</option>
                 <?php foreach ($data['bookKind'] as $key => $bookKind) : ?>
                   <option value="<?= $bookKind['MaLoaiHang'] ?>"><?= $bookKind['TenLoaiHang'] ?></option>;
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group">
               <label for="TenHH">Tựa sách</label>
               <input required type="text" name="TenHH" id="TenHH" class="form-control">
             </div>
             <div class="form-group">
               <label for="QuyCach">Quy Cách</label>
               <input type="text" id="QuyCach" name="QuyCach" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="Gia">Giá Tiền</label>
               <input required type="text" id="Gia" name="Gia" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="SoLuongHang">Số Lượng Hàng</label>
               <input required type="text" id="SoLuongHang" name="SoLuongHang" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="GhiChu">Ghi chú</label>
               <input type="text" id="GhiChu" name="GhiChu" class="form-control"></input>
             </div>
             <div class="form-group">
               <label for="Hinh1">Hình 1</label>
               <div class="input-group">
                 <div class="custom-file">
                   <input type="file" id="Hinh1" name="Hinh1">
                 </div>
               </div>
             </div>
             <div class="form-group">
               <label for="Hinh2">Hình 2</label>
               <div class="input-group">
                 <div class="custom-file">
                   <input type="file" id="Hinh2" name="Hinh2">
                 </div>
               </div>
             </div>
             <div class="form-group">
               <label for="Hinh3">Hình 3</label>
               <div class="input-group">
                 <div class="custom-file">
                   <input type="file" id="Hinh3" name="Hinh3">
                 </div>
               </div>
             </div>
             <div class="row">
               <div class="col-12">
                 <a class="btn btn-secondary" href="<?= DOCUMENT_ROOT ?>/admin/book">
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