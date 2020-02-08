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
            <a class="article__to-back" href="./index.php"><span class="visually-hidden">Назад</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></svg>
          </a>
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
