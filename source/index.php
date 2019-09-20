<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Врата. Версия 6';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once BLOCKS .'header.php' ?>
  <?php require_once BLOCKS .'main-navigation.php' ?>
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
            разных его формах авторства <a class="link link--reviews" href="#">Роджера</a> и <a
              class="link link--reviews" href="#">Могримы</a>.</p>
          <p class="page-main__intro-text">Здесь Вы найдёте:</p>
          <ul class="page-main__intro-list">
            <li class="page-main__intro-item"> книги: <span class="grey">проза и стихотворения</span>;</li>
            <li class="page-main__intro-item"> рассказы;</li>
            <li class="page-main__intro-item"> сценарии;</li>
            <li class="page-main__intro-item"> иллюстрации;</li>
            <li class="page-main__intro-item"> а так же комикс «Бесконечная история», <span class="grey">выпуск которого
                только начался</span>.</li>
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
          <?php } ?>
          </p>
          <?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <!--$works_title заголовок section works  -->
        <?php $works_title = 'Популярные произведения';
        // включаем заголовки
        $sectionTitleOn = true;
        // запрос на вывод данных каталога произведений из бд в порядке убывания по id
        $sql = 'SELECT * FROM `works_catalog` ORDER BY `id` DESC';
        $query = $pdo->query($sql);
        // подключение самого шаблона католога, в котором уже прописан цикл для вывода данных
        $newHtmlClassON = true;
        $newHtmlClass = ' works__wrapper--popular';
        require(BLOCKS .'works_section.php');
        // ------------------------------------------------------------------------------------- //
        $works_title = 'Популярные иллюстрации';
        $sql = 'SELECT * FROM `works_catalog` ORDER BY `id` DESC';
        $query = $pdo->query($sql);

        require(BLOCKS .'works_section.php');
        ?>
        <!-- ----------------------------------------------------------------------------------- -->
        <?php $news_title = 'Новости';
        $sql = 'SELECT * FROM `news` ORDER BY `date` DESC';
        $query = $pdo->query($sql);
        require_once(BLOCKS . 'news.php'); ?>
        <!-- <ul class="pagination">
            <div class="pagination__wrapper">
              <li class="pagination__item"><a class="pagination__link pagination__link--current">1</a>
              </li>
              <li class="pagination__item"><a class="pagination__link" href="#">2</a>
              </li>
              <li class="pagination__item"><a class="pagination__link" href="#">3</a>
              </li>
              <li class="pagination__item"><a class="pagination__link" href="#">4</a>
              </li>
            </div>
          </ul> -->
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <script src="js/jquery.min.js"></script>
  <script src="js/scripts.min.js"></script>
  <script>
    $('#login-form').submit(function (event) {
      event.preventDefault();
      var username = $('#login-name').val();
      var password = $('#login-pass').val();

      $.ajax({
        url: "./core/business/auth_modal.php",
        type: 'POST',
        cache: false,
        data: {
          'username': username,
          'password': password
        },
        dataType: 'html',
        success: function (data) {
          if (data == 'OK') {
            $('#errorLogin').hide();
            $('.login__button').text('Загрузка..');
            document.location.reload(true); // перезагрузка страницы
          } else {
            $('#errorLogin').show();
            $('#errorLogin').text(data);
          }
        }
      });
    });
    $('#reg-form').submit(function (event) {
      event.preventDefault();
      var username = $('#username').val();
      var userpass = $('#userpass').val();
      var userpass2 = $('#userpass2').val();
      var useremail = $('#useremail').val();

      // $('#errorReg').show();
      // $('#errorReg').text(password2);

      $.ajax({
        url: "./core/business/signup__modal.php",
        type: 'POST',
        cache: false,
        data: {
          'username': username,
          'userpass': userpass,
          'userpass2': userpass2,
          'useremail': useremail
        },
        dataType: 'html',
        success: function (data) {
          if (data == 'OK') {
            $('#errorReg').hide();
            $('.login__button').text('Загрузка..');
            document.location.reload(true); // перезагрузка страницы
          } else {
            $('#errorReg').show();
            $('#errorReg').text(data);
          }
        }
      });
    });
  </script>
</body>

</html>