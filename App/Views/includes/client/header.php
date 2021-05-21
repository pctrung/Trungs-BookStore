<header class="container-fluid">
  <div class="container header">
    <a href="<?= DOCUMENT_ROOT ?>/home" class="header__logo"><img src="<?= DOCUMENT_ROOT ?>/public/img/icon.png" alt="Trung's Bookstore logo">
      <h1 class="header__name">Trung's <br> Bookstore</h1>
    </a>
    <div class="header__search">
      <input type="text" name="search" placeholder="Search..."><img class="header__search__icon" src="<?= DOCUMENT_ROOT ?>/public/img/search.svg" alt="Search icon">
    </div>
    <div class="header__user">
      <div class="header__user__cart">
        <a href="<?= DOCUMENT_ROOT ?>/cart"> <img src="<?= DOCUMENT_ROOT ?>/public/img/bag.svg" alt="Shopping Cart Icon"></a>
        <span class='header__user__cart__badge' id='headerCartCount'><?= isset($_SESSION['booksInCart']) ? count($_SESSION['booksInCart']) : "0" ?></span>
      </div>

      <?php if (isset($_SESSION['userDetail'])) : ?>
        <a href="<?= DOCUMENT_ROOT ?>/profile">
          <span class="header__user__username"><?= isset($_SESSION['userDetail']) ? $_SESSION['userDetail']['HoTenKH'] : "Phạm Chí Trung" ?>
          </span>
          <div class="header__user__avatar">
            <img src="<?= DOCUMENT_ROOT ?>/public/admin/img/trung-avatar.png" alt="User Avatar">
            <div class="header__user__logout"><a href="<?= DOCUMENT_ROOT ?>/login/logout">Đăng xuất</a></div>
          </div>
        </a>
        <div onClick="openMenu();" class="header__menu"> <img src="<?= DOCUMENT_ROOT ?>/public/img/menu.svg" alt="Menu icon"></div>
    </div>
  <?php else : ?>
    <div class="header__login-button">
      <a href="<?= DOCUMENT_ROOT . "/login" ?>"><button class="btn btn--primary">Đăng nhập</button></a>
      <div onClick="openMenu();" class="header__menu"> <img src="<?= DOCUMENT_ROOT ?>/public/img/menu.svg" alt="Menu icon"></div>
    </div>
  <?php endif; ?>
  </div>
</header>

<div id="headerMenuMobile" class="container header__menu--mobile">
  <div class="header__search">
    <input type="text" name="search" placeholder="Search..."><img class="header__search__icon" src="<?= DOCUMENT_ROOT ?>/public/img/search.svg" alt="Search icon">
  </div>
</div>