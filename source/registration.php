<?php
require_once('./core/business/appvars.php');
require_once(BUS .'signup.php'); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Регистрация';
    require_once BLOCKS .'head.php' ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <header class="page-header">
      <div class="page-header__wrapper container">
        <a class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54" src="img/Logo.png" width="164"></a>
      </div>
    </header>
    <?php $menu_active[0] = "page-navigation__item--active";  
          require_once(BLOCKS .'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Регистрация</h1>
          <?php require_once BLOCKS .'search-block.php' ?>
          </div>
          <section class="login login--page">
          <?php
            if (!empty($_SESSION['user_id'])) {
              echo '<p>Вы вошли как ' . $_SESSION['username'] . '</p>';
            }
            else {
            ?>
            <h2 class="visually-hidden">Здесь можно зарегистрироваться</h2>
            <p class="section-header login__title">Добро пожаловать</p>
            <p id="errorReg" class="attention attention--modal"></p>
            <form id="reg-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <p class="input__wrapper">
                <label for="user-name" class="visually-hidden">Ваше имя...</label>
                <input id="username" class="input login__input" type="text" name="username" placeholder="Ваше имя..." required>
              </p>
              <p class="input__wrapper">
                <label for="user-email" class="visually-hidden">Ваш почтовый ящик...</label>
                <input id="useremail" class="input login__input" type="email" name="useremail" placeholder="Ваш почтовый ящик..." required>
              </p>
              <p class="input__wrapper">
                <label for="user-pass" class="visually-hidden">Придумайте пароль</label>
                <input id="userpass" class="input login__input" type="password" name="userpass" placeholder="Придумайте пароль" required>
              </p>
              <p class="input__wrapper">
                <label for="user-pass2" class="visually-hidden">Повторите пароль</label>
                <input id="userpass2" class="input login__input login__input--page" type="password" name="userpass2" placeholder="Повторите пароль" required>
              </p>
              <div class="login__info login__info--start">
                <input id="remember" class="checkbox login__info-checkbox" type="checkbox" name="remember"> <label for="remember" class="checkbox__name login__checkbox-name"><span class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
              </div>
              <button class="button login__button" value="submit" name="submit" type="submit">Зарегистрироваться</button>
            </form>
            <!-- <button>Закрыть</button> -->
            <?php } ?>
          </section>
          <p class="login__text">Уже регистрировались? <a class="login__link-to-reg" href="login.php">Тогда вам сюда</a></p>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/scripts.min.js"></script>
  <?php require_once(BLOCKS .'signup-ajax.php'); ?>
</body>
</html>
