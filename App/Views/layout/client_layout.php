<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>BookStore</title>
  <link rel="icon" href="<?= DOCUMENT_ROOT ?>/public/img/icon.png">
</head>

<body>
  <?php require_once(VIEW . DS . "includes/client/header.php") ?>
  <?php require_once(VIEW . DS . $view) ?>
  <?php require_once(VIEW . DS . "includes/client/footer.php") ?>
</body>

</html>