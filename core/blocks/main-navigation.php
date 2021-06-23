<nav class="page-navigation page-navigation--closed page-navigation--nojs">
    <button class="page-navigation__toggle" type="button"><span class="visually-hidden">Открыть меню</span></button>
      <ul class="page-navigation__list">
        <li class="page-navigation__item <?php echo $res = ($url_active ==  $menu[0]) ? "page-navigation__item--active" : "false";?>">
          <a class="page-navigation__link" href="index.php">Новости</a>
        </li>
        <li class="page-navigation__item <?php echo $res = ($url_active ==  $menu[1]) ? "page-navigation__item--active" : "";?>">
          <a class="page-navigation__link page-navigation__link--green" href="works-catalog.php">Книги</a>
        </li>
        <li class="page-navigation__item <?php echo $res = ($url_active ==  $menu[2]) ? "page-navigation__item--active" : "";?>">
          <a class="page-navigation__link page-navigation__link--yellow" href="gallery.php">Галерея</a>
        </li>
        <li class="page-navigation__item <?php echo $res = ($url_active ==  $menu[3]) ? "page-navigation__item--active" : "";?>">
          <a class="page-navigation__link page-navigation__link--peach" href="about.php">О нас</a>
        </li>
        <li class="page-navigation__item page-navigation__item--anonc <?php echo $res = ($url_active ==  $menu[5]) ? "page-navigation__item--active" : "";?>">
          <span class="page-navigation__link page-navigation__link--purple">Персонажи</span>
        </li>
      </ul>
  </nav>