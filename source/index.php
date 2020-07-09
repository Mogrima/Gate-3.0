<?php require_once('./core/business/session.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
  require_once('./core/business/appvars.php');
  require_once(BUS . 'connectvars.php');
  // подключение к базе данных
  require_once(BUS . '/mysql__connect.php');
  $website_title = 'Врата. Версия 6';
  require_once(BUS . '/pagevars.php');
  require_once(BLOCKS . 'head.php'); ?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!-- Подложка -->
        <h1 class="visually-hidden">Врата</h1>
        <div class="page-main__head">
          <h2 class="title">Добро пожаловать
            <!-- во <span class="page-main__label">«Врата»</span> -->
          </h2>
          <p class="page-main__intro-text">Арт-проект <span class="page-main__label">«Врата»</span> посвящён искусству в
            разных его формах авторства <a class="link link--reviews" href="https://vk.com/id501667863" target="_blank">Роджера</a> и <a class="link link--reviews" href="https://vk.com/mogrima" target="_blank">Могримы</a>.</p>
          <p class="page-main__intro-text">Здесь Вы найдёте:</p>
          <ul class="page-main__intro-list">
            <li class="page-main__intro-item"> книги: <span class="grey">проза и стихотворения</span>;</li>
            <li class="page-main__intro-item"> рассказы;</li>
            <li class="page-main__intro-item"> сценарии;</li>
            <li class="page-main__intro-item"> иллюстрации;</li>
          </ul>
          <p class="page-description page-description--flex">Отличительная черта творчества за Вратами - загадка в
            каждом произведении, дух тайны, рождаемой фантазией.
            Врата раскрывают множество путей, отведущих ваше воображение по тропам к давно сгинувшим мирам, а может даже
            к истокам истории. За ними изложены и показаны судьбы.
            Шаг за Врата, уступка любопытству, и я постараюсь поведать Вам все, что знаю.</p>
          <?php
          if ($session_id == 22) {
          ?>
            <a href="user.php">Пользователь</a> <br>
            <a href="login.php">Авторизоваться</a><br>
            <a href="registration.php">Зарегистрироваться</a> <br>
            <a href="addImage.php">добавить изображение</a> <br>
            <a href="./core/admin/administrator.php">Администратор</a>
            <a href="book.php">Ссылка на читалку</a>
            <a href="../core/admin/adWorks3.php">Ссылка на adWorks</a>
          <?php } ?>
          <?php require_once BLOCKS . 'search-block.php' ?>
        </div>
        <!--$works_title заголовок section works  -->
        <?php $works_title = 'Популярные произведения';
        $src_stat = '../img/works-catalog/';
        $works_link = 'book.php?id=';
        // включаем заголовки
        $sectionTitleOn = true;
        // запрос на вывод данных каталога произведений из бд в порядке убывания по id
        $sql = 'SELECT * FROM `works_catalog` ORDER BY `id` ASC';
        $query = $pdo->query($sql);
        // подключение самого шаблона католога, в котором уже прописан цикл для вывода данных
        $newHtmlClassON = true;
        $newHtmlClass = ' works__wrapper--popular';
        require(BLOCKS . 'works_section.php');
        // ------------------------------------------------------------------------------------- //
        $works_title = 'Популярные иллюстрации';
        $src_stat = 'img/';
        $works_link = 'album.php?id=';
        $sql = 'SELECT * FROM `album_arts` WHERE `ill_of_books` = TRUE LIMIT 3';
        $type_image = '.jpg';
        $query = $pdo->query($sql);

        require(BLOCKS . 'works_section.php');
        ?>
        <!-- ----------------------------------------------------------------------------------- -->
        <?php $news_title = 'Новости';
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $on_page = 3;
        $shift = ($page - 1) * $on_page;
        $sql = "SELECT * FROM `news` ORDER BY `date` DESC LIMIT $shift, $on_page";
        $query = $pdo->query($sql);
        $stmt = $pdo->query("SELECT COUNT(*) FROM news");
        $row = $stmt->fetch();
        $c = $row[0];
        $countPage = ceil($c / $on_page);
        require_once(BLOCKS . 'news-block.php');
        $link = '/index.php';
        $link_add = "";
        $anchor = '#news';
        require_once(BLOCKS . 'pagination.php'); ?>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS . 'footer.php'); ?>
  <?php require_once(BLOCKS . 'modal-login.php'); ?>
  <?php require_once(BLOCKS . 'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS . 'scripts-include.php'); ?>
</body>

</html>