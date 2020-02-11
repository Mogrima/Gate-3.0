<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $id = $_GET["id"];
    $contents = $_GET["contents"];
    // вывод информации об альбоме
    // $album_list = "SELECT `works_title`, `works_desc` FROM `album_list` WHERE id = $id";
    // $query = $pdo->query($album_list);
    // $album = $query->fetch(PDO::FETCH_OBJ);
    // $album_title = $album->works_title;
    // $album_desc = $album->works_desc;
    $website_title = 'Наследники богов двух миров';
    // вывод рисунков
    $album_arts = "SELECT * FROM `manga` WHERE manga_title = 'Наследники богов двух миров' AND num_of_Head = $contents ORDER BY `id` ASC";
    $query = $pdo->query($album_arts);
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="fotorama/fotorama.css" rel="stylesheet">
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); 
  ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head page-main__head--mb">
          <h1 class="title">Глава 1</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./gallery.php">Галерея</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./endlessStory.php">Бесконечная история</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Наследники богов двух миров</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          </div>
          <div class="fotorama" data-width="800"  data-max-width="100%" data-allowfullscreen="native">
            <?php 
            while($art = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <img class="fotorama__img" src="./img/manga/<?=$art->manga_src?><?=$art->works_image?>.jpg">
           <?php } ?>
          </div>
          <section>
        <?php 
         $book_id = 1;
         $get_id = $book_id;
        $link_comment = '/manga.php';
        $link_comment_get = "?id=$get_id";
        $comments_table = 'comments_art';
        require_once(BLOCKS .'comment.php');
         $link = '/manga.php';
         $link_add = "&amp;id=$book_id";

          // получение полного количества новостей
          $stmt = $pdo->query("SELECT COUNT(*) FROM $comments_table WHERE article_id = $book_id");
          $row = $stmt->fetch();
          $c=$row[0]; //количество строк

          $countPage = ceil($c / $on_page);
         require_once(BLOCKS . 'pagination.php'); ?>
        </section>
        </div>
    </div>
    </main>
    <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <script src="./js/jquery.min.js"></script>
  <script src="fotorama/fotorama.js"></script>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>
</html>