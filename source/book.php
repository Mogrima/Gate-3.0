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
    $type = 'book';
    $sql = "SELECT * FROM `works_catalog` WHERE id = $book_id";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $title = $row->works_title;
      $desc = $row->works_desc;
      $works_image_src = '../img/works-catalog/'.$row->works_image;
      $genre = $row->genre;
      $warning = $row->warning;?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title"><?=$title?> 18+</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.html.html">Новости</a>
            </li>
            <li class="breadcrumb__item">Книги</li>
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
          if(isset($_POST['submit'])) {
            if($_POST['name'] != '' && $_POST['reviews'] != '') {
              $username = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
              $mess = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
              $article_id = $_GET["id"];
              $page = $type;

              $sql = "INSERT INTO comments(page, author, comment, article_id) VALUES('$page', '$username', '$mess', '$article_id')";
              $query = $pdo->prepare($sql);
              $query->execute([$page, $username, $mess, $article_id]);
              echo "Данные отправлены!";
          }
          else { 
            echo "Данные не заполнены!";
          }
          }
        ?>
          <h2 class="reviews__form-title">Поделиться впечатлениями</h2>
          <form action="/book.php?id=<?=$_GET['id']?>" class="reviews__form" method="post">
            <div class="reviews__form-wrapper">
              <p class="input__wrapper input__wrapper--flex">
                <label class="input__sign input__sign--left" for="reviews-name">Назовитесь:</label>
                <input class="input reviews__input" id="reviews-name" type="text" name="name" placeholder="имя..." value="<?=$_SESSION['username']?>" required>
              </p>
            </div>
            <p class="input__wrapper input__wrapper--flex">
              <label class="visually-hidden" for="reviews-massage">Здесь вы можете оставить свой отзыв:</label> 
              <textarea class="input reviews__massage" id="reviews-massage" name="reviews">ваш отзыв</textarea>
            </p>
            <button class="button feedback__button" name="submit" type="submit">Выразить мнение</button>
          </form>
          <div class="reviews__list">
            <blockquote class="reviews__item">
              <div class="header-title">
                <cite class="header-title__title reviews__author-name">Трэвис Баркер</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
              </div>
              <div class="reviews__author-picture"><img alt="Фото Трэвиса Баркера" class="reviews__author-image" height="33" src="img/reviews/persona-1.jpg" width="50"></div>
              <p class="reviews__text">Спасибо за лысину! Был проездом в Москве, заскочил побриться, чтобы было видно новую татуировку!</p>
            </blockquote>
            <blockquote class="reviews__item">
              <div class="header-title">
                <cite class="header-title__title reviews__author-name">Джон Смит</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
              </div>
              <div class="reviews__author-picture"><img alt="Фото Джона Смита" class="reviews__author-image" height="33" src="img/reviews/persona-2.jpg" width="50"></div>
              <p class="reviews__text">Отличную стрижку мне сделали ребята.</p>
            </blockquote>
            <blockquote class="reviews__item">
              <div class="header-title">
                <cite class="header-title__title reviews__author-name">Иван Бородайло</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
              </div>
              <div class="reviews__author-picture"><img alt="Фото Ивана Бородайло" class="reviews__author-image" height="33" src="img/reviews/persona-3.jpg" width="50"></div>
              <p class="reviews__text">В Бородинском ваша борода в надёжных руках!</p>
            </blockquote>
          </div>
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
</body>

</html>
