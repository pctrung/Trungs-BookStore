<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?= DOCUMENT_ROOT ?>/admin/home" class="brand-link">
    <img src="<?= DOCUMENT_ROOT ?>/public/admin/img/AdminLogo.png" alt="Admin Logo" class="brand-image  elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Book Store</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= DOCUMENT_ROOT ?>/public/admin/img/avatar-user1.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Phạm Chí Trung</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <?php foreach (SITE['navigation']['admin'] as $key => $item) :  ?>

          <?php
          $activeClass = "";
          $openMenuClass = "";
          if (strtolower($GLOBALS['currentRoute']) === $item['name']) {
            $activeClass = "active ";
          }
          if (isset($item['subitems'])) {
            foreach ($item['subitems'] as $key => $subitem) {
              if (strtolower($GLOBALS['currentRoute']) === $subitem['name']) {
                $openMenuClass = "menu-is-opening menu-open ";
              }
            }
          } ?>

          <li id="nav-<?= $key ?>" class="nav-item <?= $openMenuClass ?>">

            <a href=<?= $item['link'] ?> class="nav-link <?= $activeClass ?>">
              <i class="nav-icon <?= $item['icon'] ?>"></i>
              <p>
                <?= $item['title'] ?>
                <?php if (isset($item['subitems'])) : ?>
                  <i class="right fas fa-angle-left"></i>
                <?php endif; ?>
              </p>
            </a>
            <?php if (isset($item['subitems'])) : ?>
              <?php foreach ($item['subitems'] as $key => $subitem) : ?>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href=<?= $subitem['link'] ?> class="nav-link <?php if (strtolower($GLOBALS['currentRoute']) === $subitem['name']) echo "active"; ?>">
                      <i class="<?= $subitem['icon'] ?> nav-icon ml-3"></i>
                      <p><?= $subitem['title'] ?></p>
                    </a>
                  </li>
                </ul>
              <?php endforeach; ?>
            <?php endif ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>