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
    require_once(BLOCKS . 'head.php'); ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title">Истории тысячи миров 18+</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.html.html">Новости</a>
            </li>
            <li class="breadcrumb__item">Книги</li>
            <li class="breadcrumb__item breadcrumb__item--current">Истории тысячи миров</li>
          </ul>
          <section>
          <h2 class="visually-hidden">Описание книги Истории тысячи миров</h2>
          <div class="preview__wrapper">
          <div class="preview__content">
            <img class="preview__content-img" src="./img/works-catalog/01.jpg" alt="" srcset="">
            <a class="preview__button button" href="#">Читать</a></div>
          <div class="preview__desc">
          <div class="preview__genre">
            <h3>Жанр:</h3> Сказки для взрослых
          </div>
          <p class="preview__attention attention">Предупреждения: Сцены жестокости и насилия, нетрадиционные отношения</p>
          <h3>Описание:</h3>
          <p class="preview__text">Диана спит и видит необычные сны. Время ложится перед ее взором точно полотно, а жизни проносятся одна за другой. И каждую ночь ей предстают все новые места, где каждый герой живет своей непростой жизнью, сталкивается со своими страшными истинами, готовится сделать решающий шаг. И пускай Диана еще слишком мала, с каждой ночью она становится мудрее многих взрослых, открывая для себя то, что не под силу узнать никому – мудрость из мрачных историй тысяч миров. </p>
          </div>
          </div>
          </section>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
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
