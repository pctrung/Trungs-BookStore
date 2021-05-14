<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Trung's Bookstore</title>
  <link rel="icon" href="<?= DOCUMENT_ROOT ?>/public/img/icon.png">

  <!-- font -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

  <!-- css -->
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/style.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/header.css">
</head>

<body>
  <div class="wrapper">
    <div class="container">
      <?php require_once(VIEW . DS . "includes/client/header.php") ?>
      <?php require_once(VIEW . DS . $view) ?>
      <?php require_once(VIEW . DS . "includes/client/footer.php") ?>
    </div>
  </div>
</body>

</html>