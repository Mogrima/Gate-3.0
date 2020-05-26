<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php $menu_active[2] = "page-navigation__item--active"; 
  require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Галерея</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Галерея</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Рисование будоражило меня с незапамятных лет, часто открывая моей памяти дорогу к истокам.
             При помощи графического планшета и вдохновенного настроя светлой грусти порой возможно совершить чудо - воссоздать 
             живых и мертвых, пробудить историю, да и просто дать полную волю вымыслу.</p>
          <p class="page-description page-description--flex">Этот раздел разбит на альбомы, 
             в каждом из которых – иллюстрации к разным книгам, а так же просто рисунки, ссылающиеся на разных упомянутых во 
             Вратах персонажей.</p>
          <p class="page-description page-description--flex">Приятного просмотра!</p>
        </div>
        <p class="attention"><i>P.S.:</i> Делитесь своими впечатлениями, оставляйте свои комментарии – это легко и быстро можно сделать под каждым альбомом в Галерее! Только Вы способны помочь в совершенствовании своим откликом – это столь ценно для нас.</p>
        <!-- <section class="filters">
          <h2 class="visually-hidden">Фильтр рисунков</h2>
          <form action="#" class="filter" method="get">
            <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
                  <ul class="filter__list filter__list--center">
                    <div class="filter__wrapper-gallery">
                    <li class="filter__item-gallery"><input checked class="checkbox" id="popular-checkbox" name="popular" type="checkbox"> <label class="checkbox__name" for="popular-checkbox"><span class="checkbox__indicator"></span> По популярности</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="old-checkbox" name="old" type="checkbox"> <label class="checkbox__name" for="old-checkbox"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="free-checkbox" name="free" type="checkbox"> <label class="checkbox__name" for="free-checkbox"><span class="checkbox__indicator"></span> Цветные</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="colorless" name="pay" type="checkbox"> <label class="checkbox__name" for="colorless"><span class="checkbox__indicator"></span> Черно-белые</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="history" name="pay" type="checkbox"> <label class="checkbox__name" for="history"><span class="checkbox__indicator"></span> Истории</label></li>
                    </div>
                  </ul>
            </fieldset><button class="filter__button filter__button--center">Применить</button>
          </form>
        </section> -->
        <?php $works_title = 'Список альбомов и рисунков';
        // выключаем (прячем) заголовок
        $sectionTitleOn = false;
        $works_link = 'album.php?id=';
        $src_stat = 'img/';
        
        // --------------------- пагинация ---------------------------------------------- //
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $on_page = 6;
        $shift = ($page - 1) * $on_page;
        // запрос на вывод данных каталога произведений из бд в порядке убывания по id
        $sql = "SELECT * FROM `album_list` WHERE `nested` = 0 ORDER BY `id` DESC LIMIT $shift, $on_page";
        $query = $pdo->query($sql);
        $stmt = $pdo->query("SELECT COUNT(*) FROM album_list");
        $row = $stmt->fetch();
        $c=$row[0];
        $countPage = ceil($c / $on_page);
        // подключение самого шаблона католога, в котором уже прописан цикл для вывода данных
        require(BLOCKS .'works_section.php');
        $link = '/gallery.php';
        $link_add = "";
        $anchor = '#anchor';
        require_once(BLOCKS . 'pagination.php'); ?>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>
</html>