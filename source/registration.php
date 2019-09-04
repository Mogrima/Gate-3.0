<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once('./core/business/appvars.php');
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
  <?php require_once BLOCKS .'main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Регистрация</h1>
          <!-- <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.html.html">На главную</a>
            </li>
          </ul> -->
          <?php require_once BLOCKS .'search-block.php' ?>
          </div>
          <section class="login login--page">
          <?php
          require_once('./core/business/appvars.php');
          require_once(BUS . 'signup2.php'); ?>
          <?php
            if (!empty($_SESSION['user_id'])) {
              echo '<p>Вы вошли как ' . $_SESSION['username'] . '</p>';
            }
            else {
            ?>
            <h2 class="visually-hidden">Здесь можно зарегистрироваться</h2>
            <p class="section-header login__title">Добро пожаловать</p>
            <form id="form-reg" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <p class="input__wrapper">
                <label for="user-name" class="visually-hidden">Ваше имя...</label>
                <input id="user-name" class="input login__input login__input--page" type="text" name="username" placeholder="Ваше имя...">
              </p>
              <p class="input__wrapper">
                <label for="user-email" class="visually-hidden">Ваш почтовый ящик...</label>
                <input id="user-email" class="input login__input login__input--page" type="email" name="useremail" placeholder="Ваш почтовый ящик...">
              </p>
              <p class="input__wrapper">
                <label for="user-pass" class="visually-hidden">Придумайте пароль</label>
                <input id="user-pass" class="input login__input login__input--page" type="password" name="userpass" placeholder="Придумайте пароль">
              </p>
              <p class="input__wrapper">
                <label for="user-pass2" class="visually-hidden">Повторите пароль</label>
                <input id="user-pass2" class="input login__input login__input--page" type="password" name="userpass2" placeholder="Повторите пароль">
              </p>
              <div class="login__info login__info--start">
                <input id="remember" class="checkbox login__info-checkbox" type="checkbox" name="remember"> <label for="remember" class="checkbox__name login__checkbox-name"><span class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
              </div>
              <div class="alert alert-danger mt-2" id="errorBlock"></div>
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
  <script type="text/javascript" src="jquery.min.js"></script>
  <script>
//   $('#form-reg').submit(function (event) {
//       event.preventDefault();
//       var name = $('#user-name').val();
//       var email = $('#user-email').val();
//       var password2 = $('#user-pass').val();
//       var password = $('#user-pass2').val();
//       var error = document.getElementById('errorBlock');
//       console.log(error);
//       $.ajax({
//           url: "business/signup.php",
//           type: 'POST',
//           cache: false,
//           data: {'username' : name, 'email' : email, 'password' : password, 'password2' : password2},
//           dataType: 'html',
//           success: function(data) {

//               error.innerHTML = data;
//               // $('#form-reg').text('Вы зарегистрировались');

//               // else {
//               //     $('#errorBlock').show();
//               //     $('#errorBlock').text(data);
//               // }
//           }
//       });
//   });
// </script>
</body>
</html>
