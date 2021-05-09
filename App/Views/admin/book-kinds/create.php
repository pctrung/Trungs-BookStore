 <!-- Content Header (Page header) -->
 <section class="content-header">
   <div class="container-fluid">
     <div class="row mb-2">
       <div class="col-sm-6">
         <h1>Thêm mới</h1>
       </div>
       <div class="col-sm-6">
         <ol class="breadcrumb float-sm-right">
           <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin/bookkind" ?>Quản lý loại sách</a></li>
           <li class="breadcrumb-item active">Thêm loại sách</li>
         </ol>
       </div>
     </div>
   </div>
   <!-- /.container-fluid -->
 </section>

 <!-- Main content -->
 <section class="content">
   <?php require_once(VIEW . DS . "shared/noti.php") ?>
   <form action="<?= DOCUMENT_ROOT ?>/admin/bookkind/store" method="post" enctype="multipart/form-data">
     <div class="row">
       <div class="col-md-12">
         <div class="card card-primary">
           <div class="card-header">
             <h3 class="card-title">Thêm loại sách</h3>
           </div>
           <div class="card-body">

             <div class="form-group">
               <label for="TenLoaiHang">Tên loại sách</label>
               <input type="text" id="TenLoaiHang" name="TenLoaiHang" class="form-control"></input>
             </div>

             <div class=" row">
               <div class="col-12">
                 <a class="btn btn-secondary" href="<?= DOCUMENT_ROOT ?>/admin/bookkind">
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