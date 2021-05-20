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
  <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

  <!-- my css -->
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/style.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/header.css">
  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/footer.css">

  <link rel="stylesheet" href="<?= DOCUMENT_ROOT ?>/public/css/<?= $GLOBALS['currentRoute'] ?>.css">
</head>

<body>
  <p hidden id="DOCUMENT_ROOT"><?= DOCUMENT_ROOT ?></p>

  <?php if (strpos($GLOBALS['currentRoute'], "login") !== false) : ?>
    <?php require_once(VIEW . DS . $view); ?>
  <?php else : ?>
    <?php require_once(VIEW . DS . "includes/client/header.php") ?>
    <div class="wrapper">
      <div class="container">
        <?php require_once(VIEW . DS . $view) ?>
      </div>
    </div>
    <?php require_once(VIEW . DS . "includes/client/footer.php") ?>
  <?php endif; ?>

</body>

<!-- Add javascript -->
<?php if (strpos($view, "home") !== false) : ?>
  <script src="<?= DOCUMENT_ROOT ?>/public/js/app.js"></script>
<?php endif; ?>

</html>