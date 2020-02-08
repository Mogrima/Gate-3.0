<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Новость';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!-- Подложка -->
        <?php require_once BLOCKS .'search-block.php' ?>
        <arcticle class="article">
          <div class="article__body">
            <img class='article__picture' alt='Рисунок новости' src='./img/defaultnews.jpg' width='214' height='216'>
            <h1 class="article__title">Где ваш веб-сайт должен располагаться на вашем
              компьютере?</h1>
            <p class='article__text'>Когда вы работаете на веб-сайте локально на вашем компьютере, вы должны держать все
              связанные файлы в одной папке, которая отражает файловую структуру опубликованного веб-сайта на сервере.
              Эта папка может располагаться где угодно, но вы должны положить её туда, где вы сможете легко её найти,
              может быть, на ваш рабочий стол, в домашнюю папку или в корень вашего жесткого диска.

              Выберите место для хранения проектов веб-сайта. Здесь, создайте новую папку с именем web-projects (или
              аналогичной). Это то место, где будут располагаться все ваши проекты сайтов.
              Внутри этой первой папки, создайте другую папку для хранения вашего первого веб-сайта. Назовите ее
              test-site (или как-то более творчески).</p>
          </div>
          <div class='article__footer'>
            <a href="./index.php"><span>Назад</span></a>
            <time class='article__date' datetime='2016-01-11'>2019-05-08 07:28:10</time>
          </div>
        </arcticle>
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
