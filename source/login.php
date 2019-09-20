<?php
require_once('./core/business/appvars.php');
require_once(BUS .'authorize.php'); ?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Авторизация';
    require_once BLOCKS .'head.php' ?>
</head>

<body class="page">
  <div class="background-header"></div>
  <header class="page-header">
    <div class="page-header__wrapper container">
      <a class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54"
          src="img/Logo.png" width="164"></a>
    </div>
  </header>
  <?php require_once BLOCKS .'main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Авторизация</h1>
          <!-- <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.html.html">На главную</a>
            </li>
          </ul> -->
          <?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <section class="login login--page">
          <h2 class="visually-hidden">Здесь можно представиться</h2>
          <p class="section-header login__title">Здравствуйте</p>
          <?php
            if (empty($_SESSION['user_id'])) {
              echo '<p class="error">' . $error_msg . '</p>';
          ?>
          <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <p class="input__wrapper">
              <label for="user-name" class="visually-hidden">Ваше имя или электронная почта</label>
              <input id="user-name" class="input login__input login__input--page" type="text" name="username"
                placeholder="Ваше имя или электронная почта..."">
            </p>
            <p class=" input__wrapper">
              <label for="user-pass" class="visually-hidden">Ваш пароль</label>
              <input id="user-pass" class="input login__input login__input--page" type="password" name="password"
                placeholder="Ваш ключ...">
            </p>
            <div class="login__info">
              <input id="remember" class="checkbox login__info-checkbox" type="checkbox" name="remember"> <label
                for="remember" class="checkbox__name login__checkbox-name"><span
                  class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
              <a class="login__restore" href="#">Я забыл(а) пароль!</a>
            </div>
            <button class="button login__button" type="submit" value="enter" name="submit">Представиться</button>
          </form>
          <?php
            }
          else {
            // подтверждение успешного входа в приложение
            echo('<p class="login">Вы вошли как ' . $_SESSION['username'] . '</p>');
          }
          ?>
        </section>
        <p class="login__text">Не зарегистрированы? <a class="login__link-to-reg" href="registration.php">Тогда вам
            сюда</a></p>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <script src="js/scripts.min.js"></script>
</body>

</html>
