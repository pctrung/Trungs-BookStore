<?php if (isset($_SESSION['alert'])) : ?>
  <?php if ($_SESSION['alert']['success'] == true) : ?>
    <div class="alert alert-success" role="alert">
      <?php echo $_SESSION['alert']['messages'];
      unset($_SESSION['alert']); ?>
    </div>
  <?php else : ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $_SESSION['alert']['messages'];
      unset($_SESSION['alert']); ?>
    </div>
  <?php endif; ?>
<?php endif; ?>