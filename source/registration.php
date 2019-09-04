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
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Регистрация на сайте</title>
  <link href="img/favicon.png" rel="apple-touch-icon" sizes="180x180">
  <link href="img/favicon.png" rel="icon" sizes="32x32" type="image/png">
  <link href="img/favicon.png" rel="icon" sizes="16x16" type="image/png">
  <link href="/site.webmanifest" rel="manifest">
  <link color="#5bbad5" href="img/favicon.png" rel="mask-icon">
  <meta content="#da532c" name="msapplication-TileColor">
  <meta content="#ffffff" name="theme-color">
  <link href="css/style.min.css" rel="stylesheet">
</head>
<body class="page">
  <div class="background-header"></div>
  <header class="page-header">
      <div class="page-header__wrapper container">
        <a class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54" src="img/Logo.png" width="164"></a>
      </div>
    </header>
  <nav class="page-navigation page-navigation--closed page-navigation--nojs">
    <button class="page-navigation__toggle" type="button"><span class="visually-hidden">Открыть меню</span></button>
      <ul class="page-navigation__list">
        <li class="page-navigation__item page-navigation__item--active">
          <a class="page-navigation__link" href="index.html">Новости</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--green" href="works-catalog.html">Книги</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--yellow" href="gallery.html">Галерея</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--peach" href="about.html">О нас</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--lilac" href="reviews.html">Отзывы</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--purple" href="FAQ.html">FAQ</a>
        </li>
      </ul>
  </nav>
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
          <div class="search-block">
            <input class="search-block__input" placeholder="Поиск..." type="text"> <span class="search-block__icon"></span>
          </div>
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
          <p class="login__text">Уже регистрировались? <a class="login__link-to-reg" href="login.html">Тогда вам сюда</a></p>
      </div><!-- Подложка -->
    </div>
  </main>
  <footer class="page-footer">
    <div class="page-footer__wrapper">
      <nav class="footer-navigation">
        <ul class="footer-navigation__list">
          <li class="footer-navigation__item">
            <a class="footer-navigation__link footer-navigation__link--current"><img alt="Врата" height="30" src="img/Logo.png" width="100"></a>
          </li>
          <li class="footer-navigation__item">
            <a class="footer-navigation__link" href="works-catalog.html">Книги</a>
          </li>
          <li class="footer-navigation__item">
            <a class="footer-navigation__link" href="gallery.html">Галерея</a>
          </li>
          <li class="footer-navigation__item">
            <a class="footer-navigation__link" href="about.html">О нас</a>
          </li>
          <li class="footer-navigation__item">
            <a class="footer-navigation__link" href="feedback.html">Отзывы</a>
          </li>
          <li class="footer-navigation__item">
            <a class="footer-navigation__link" href="FAQ.html">FAQ</a>
          </li>
        </ul>
      </nav>
      <p class="page-footer__copyright copyright"><b class="copyright__developers">Разработано: Ro&Mo</b><br>
          <span class="copyright__reserved">© Все права защищены. 2018</span></p>
      <div class="footer-social">
            <b class="footer-social__title">Контакты для связи:</b>
            <ul class="footer-social__list">
              <li class="footer-social__item">
                <a href="#"><span class="visually-hidden">Вконтакте</span> <svg aria-hidden="true" class="svg-inline--fa fa-vk fa-w-18" data-icon="vk" data-prefix="fab" height="44" role="img" viewbox="0 0 576 512" width="44" xmlns="http://www.w3.org/2000/svg">
                <path class="footer-social__icon-color" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" fill="currentColor"></path></svg></a>
              </li>
              <li class="footer-social__item">
                <a href="#"><span class="visually-hidden">Фейсбук</span> <svg aria-hidden="true" class="svg-inline--fa fa-facebook-f fa-w-9" data-icon="facebook-f" data-prefix="fab" height="35" role="img" viewbox="0 0 264 512" width="40" xmlns="http://www.w3.org/2000/svg">
                <path class="footer-social__icon-color" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229" fill="currentColor"></path></svg></a>
              </li>
              <li class="footer-social__item">
                <a href="#"><span class="visually-hidden">Твиттер</span> <svg aria-hidden="true" class="svg-inline--fa fa-twitter fa-w-16" data-icon="twitter" data-prefix="fab" height="32" role="img" viewbox="0 0 512 512" width="32" xmlns="http://www.w3.org/2000/svg">
                <path class="footer-social__icon-color" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" fill="currentColor"></path></svg></a>
              </li>
              <li class="social-list__item">
                <a href="#"><span class="visually-hidden">Девианарт</span> <svg aria-hidden="true" class="svg-inline--fa fa-deviantart fa-w-10" data-icon="deviantart" data-prefix="fab" height="35" role="img" viewbox="0 0 320 512" width="35" xmlns="http://www.w3.org/2000/svg">
                <path class="footer-social__icon-color" d="M320 93.2l-98.2 179.1 7.4 9.5H320v127.7H159.1l-13.5 9.2-43.7 84c-.3 0-8.6 8.6-9.2 9.2H0v-93.2l93.2-179.4-7.4-9.2H0V102.5h156l13.5-9.2 43.7-84c.3 0 8.6-8.6 9.2-9.2H320v93.1z" fill="currentColor"></path></svg></a>
              </li>
            </ul>
          </div>
    </div>
  </footer>
  <script type="text/javascript" src="jquery.min.js"></script>
  <!-- <script src="js/scripts.min.js"></script> -->
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
