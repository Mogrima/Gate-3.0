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
                
              </div>
              <div class="preview__desc">
                <div class="preview__genre">
                  <h3 class="preview__caption">Жанр:</h3> Сказки для взрослых
                </div>
                <p class="attention preview__attention"><strong class="preview__caption">Предупреждения:</strong> Сцены жестокости и насилия, нетрадиционные
                  отношения</p>
                <h3 class="preview__caption">Сюжет:</h3>
                <p class="preview__text">Диана спит и видит необычные сны. Время ложится перед ее взором точно полотно,
                  а жизни проносятся одна за другой. И каждую ночь ей предстают все новые места, где каждый герой живет
                  своей непростой жизнью, сталкивается со своими страшными истинами, готовится сделать решающий шаг. И
                  пускай Диана еще слишком мала, с каждой ночью она становится мудрее многих взрослых, открывая для себя
                  то, что не под силу узнать никому – мудрость из мрачных историй тысяч миров. </p>
              </div>
              <a class="preview__button button" href="#">Читать</a>
            </div>
          </section>
          <section class="reviews">
          <h2 class="reviews__form-title">Поделиться впечатлениями</h2>
          <form action="#" class="reviews__form" method="post">
            <div class="reviews__form-wrapper">
              <p class="input__wrapper input__wrapper--flex">
                <label class="input__sign input__sign--left" for="reviews-name">Назовитесь:</label>
                <input class="input reviews__input" id="reviews-name" type="text" name="name" placeholder="имя..." required>
              </p>
              <p class="input__wrapper input__wrapper--flex">
                <label class="input__sign input__sign--left" for="reviews-email">Ваша почта:</label>
                <input class="input reviews__input" id="reviews-email" type="email" name="email" placeholder="почтовый ящик..." required>
              </p>
            </div>
            <p class="input__wrapper input__wrapper--flex">
              <label class="visually-hidden" for="reviews-massage">Здесь вы можете оставить свой отзыв:</label> 
              <textarea class="input reviews__massage" id="reviews-massage" name="reviews">ваш отзыв...</textarea>
            </p>
            <button class="button feedback__button">Выразить мнение</button>
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
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>

</html>
