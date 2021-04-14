 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Cập nhật</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/book" ?>Quản lý sách</a></li>
           <li class="breadcrumb-item active">Chỉnh sửa sách</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form action="<?= DOCUMENT_ROOT ?>/admin/book/update/<?= $data['updateBook']['MSHH'] ?>" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Cập nhật thông tin sách</h3>
           </div>
           <div class="card-body">
             <div class="form-group">
               <label for="MaLoaiHang">Loại sách</label>
               <select required id="MaLoaiHang" name="MaLoaiHang" class="form-control custom-select">
                 <option disable selected value="<?= $data['updateBook']['MaLoaiHang'] ?>"><?= $data['updateBook']['TenLoaiHang'] ?></option>
                 <?php foreach ($data['bookKind'] as $key => $bookKind) : ?>
                   <option value="<?= $bookKind['MaLoaiHang'] ?>"><?= $bookKind['TenLoaiHang'] ?></option>;
                 <?php endforeach ?>
               </select>
             </div>
             <div class="form-group">
               <label for="TenHH">Tựa sách</label>
               <input required type="text" name="TenHH" id="TenHH" class="form-control" value="<?= $data['updateBook']['TenHH'] ?>">
             </div>
             <div class="form-group">
               <label for="QuyCach">Quy Cách</label>
               <input type="text" id="QuyCach" name="QuyCach" class="form-control" value="<?= $data['updateBook']['QuyCach'] ?>"></input>
             </div>
             <div class=" form-group">
               <label for="Gia">Giá Tiền</label>
               <input required type="text" id="Gia" name="Gia" class="form-control" value="<?= $data['updateBook']['Gia'] ?>"></input>
             </div>
             <div class=" form-group">
               <label for="SoLuongHang">Số Lượng Hàng</label>
               <input required type="text" id="SoLuongHang" name="SoLuongHang" class="form-control" value="<?= $data['updateBook']['SoLuongHang'] ?>"></input>
             </div>
             <div class=" form-group">
               <label for="GhiChu">Ghi chú</label>
               <input type="text" id="GhiChu" name="GhiChu" class="form-control" value="<?= $data['updateBook']['GhiChu'] ?>"></input>
             </div>

             <?php for ($i = 1; $i <= 3; $i++) : ?>
               <div class="form-group">
                 <label for="Hinh<?= $i ?>">Hình <?= $i ?></label>
                 <div class="input-group d-flex align-items-center">
                   <?php if ($data['updateBook']["Hinh$i"] == "") : ?>
                     <div class="custom-file">
                       <input type="file" id="Hinh<?= $i ?>" name="Hinh<?= $i ?>">
                     </div>
                   <?php endif; ?>
                   <?php if ($data['updateBook']["Hinh$i"] != "") : ?>
                     <img src="<?= BOOK_IMAGES . '/' . $data['updateBook']["Hinh$i"] ?>" class="my-admin-book-thumbnail img-thumbnail mr-3" alt="Ảnh Bìa Sách <?= $data['updateBook']['MSHH'] ?>">
                     <div class="custom-file">
                       <input type="file" id="Hinh<?= $i ?>" name="Hinh<?= $i ?>">
                     </div>
                   <?php endif; ?>
                 </div>
               </div>
             <?php endfor; ?>

             <div class=" row">
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