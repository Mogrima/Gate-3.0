<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Книги';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS . 'head.php'); 
    
    $book_id = $_GET["id"];
    $sql = "SELECT * FROM `works_catalog` WHERE id = $book_id";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $title = $row->works_title;
      $desc = $row->works_desc;
      $works_image_src = '../img/works-catalog/'.$row->works_image;
      $genre = $row->genre;
      $warning = $row->warning;
      $NC = $row->NC;?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title"><?=$title?> <img src="./img/icons/<?=$NC?>.png" alt="<?=$NC?>+" width="65" height="100"></h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
            <a class="breadcrumb__link" href="works-catalog.php">Книги</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current"><?=$title?></li>
          </ul>
          <section class="preview">
            <h2 class="visually-hidden">Описание книги <?=$title?></h2>
            <div class="preview__wrapper">
              <div class="preview__content">
                <img class="preview__content-img" src="<?=$works_image_src?>" alt="<?=$title?>">
                
              </div>
              <div class="preview__desc">
                <div class="preview__genre">
                  <h3 class="preview__caption">Жанр:</h3> <?=$genre?>
                </div>
                <?php if ($warning != '') { ?>
                <p class="attention preview__attention"><strong class="preview__caption">Предупреждения:</strong><?=$warning?></p>
                <?php } ?>
                <h3 class="preview__caption">Сюжет:</h3>
                <p class="preview__text"><?=$desc?> </p>
              </div>
              <a class="preview__button button" href="reader.php?id=<?=$id?>">Читать</a>
            </div>
          </section>
          <section class="reviews">
          <?php 
          $get_id = $book_id;
          $link_comment = '/book.php';
          $link_comment_get = "?id=$get_id";
          $comments_table = 'comments_book';
          require_once(BLOCKS .'comment.php');
          $link = '/book.php';
          $link_add = "&amp;id=$book_id";
          // получение полного количества новостей
          $stmt = $pdo->query("SELECT COUNT(*) FROM $comments_table WHERE article_id = $book_id");
          $row = $stmt->fetch();
          $c=$row[0]; //количество строк

          $countPage = ceil($c / $on_page);

          require_once(BLOCKS . 'pagination.php'); ?>
        </section>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
        </div>
        </div>
      </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
  <script>
  let totalCount = 600;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCount - countInput.value.length;
  });
  </script>
</body>

</html>
