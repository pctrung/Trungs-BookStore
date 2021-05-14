<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Trung's Bookstore</title>

  <link rel="icon" href="<?= DOCUMENT_ROOT ?>/public/img/icon.png">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/css/my-style.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/css/adminpage.css">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Nếu là trang login thì không hiện header footer -->
    <?php if (strpos($view, "login")) : ?>
      <?php require_once(VIEW . DS . $view); ?>

    <?php else : ?>
      <?php require_once(VIEW . DS . "includes/admin/sidebar.php") ?>

      <?php require_once(VIEW . DS . "includes/admin/header.php") ?>

      <div class="content-wrapper">
        <?php require_once(VIEW . DS . $view); ?>
      </div>

      <?php require_once(VIEW . DS . "includes/admin/footer.php") ?>
    <?php endif; ?>
  </div>

  <!-- My script -->
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/js/validate.js"></script>

  <!-- jQuery -->
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/jszip/jszip.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!-- AdminLTE App -->
  <script src="<?= DOCUMENT_ROOT ?>/public/admin/js/adminlte.min.js"></script>

  <script>
    $(function() {
      $("#main-table").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#main-table_wrapper .col-md-6:eq(0)');
    });
    $(function() {
      $("#order-table").DataTable({
        "order": [
          [0, "desc"]
        ],
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "buttons": ["copy", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#order-table_wrapper .col-md-6:eq(0)');
    });
  </script>

</body>

</html>