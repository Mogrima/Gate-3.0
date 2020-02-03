<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея: Сюжетные';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="css/album-slider.css" rel="stylesheet">
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Протреты</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="gallery.php">Галерея</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Портреты</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Лица, а то и переданные полностью образы знакомых и просто припомнившихся персон.</p>
          </div>
          <section class="gallery gallery-no-js">
         <div class="slider__container"> 
                <!-- <li id="slide_slice"> --> 
                <ul class="slider__list"> 
                 <li class="slider__item">
                    <h3 class="works__title album-slider__title">Азазель</h3>
                    <picture>
                     <source srcset="img/portraits/Azazel@320.jpg" media="(max-width: 767px)">
                     <img class="slider__img" src="img/portraits/Azazel@620.jpg" width="460px" alt="Азазель">
                    </picture>
                    <div class="count count-no-js"><span>1/7</span></div>
                 </li> 
                 <li class="slider__item">
                    <h3 class="works__title album-slider__title">Сыновья Моря</h3>
                    <img class="slider__img" width="800px" src="img/portraits/Сыновья Моря.jpg" alt="Сыновья Моря">
                    <div class="count count-no-js"><span>2/7</span></div>
                 </li> 
                 <li class="slider__item">
                    <h3 class="works__title album-slider__title">Сатана</h3>
                    <img class="slider__img" width="325px" src="img/portraits/Сатана.jpg" alt="Сатана">
                    <div class="count count-no-js"><span>3/7</span></div>
                 </li> 
                 <li class="slider__item">
                     <h3 class="works__title album-slider__title">Аид</h3>
                    <img class="slider__img" src="img/portraits/Аид.jpg" width="450px" alt="Аид">
                    <div class="count count-no-js"><span>4/7</span></div>
                 </li> 
                 <li class="slider__item">
                     <h3 class="works__title album-slider__title">Астарот</h3>
                    <img class="slider__img" src="img/portraits/Астарот.jpg" width="512px" alt="Астарот">
                    <div class="count count-no-js"><span>5/7</span></div>
                 </li> 
                 <li class="slider__item">
                     <h3 class="works__title album-slider__title">Басманов</h3>
                    <img class="slider__img" src="img/portraits/Басманов.jpg" width="460px" alt="Басманов">
                    <div class="count count-no-js"><span>6/7</span></div>
                 </li> 
                 <li class="slider__item">
                     <h3 class="works__title album-slider__title">Вельзевул</h3>
                    <img class="slider__img" src="img/portraits/Вельзевул.jpg" width="494px" alt="Вельзевул">
                    <div class="count count-no-js"><span>7/7</span></div>
                 </li> 
                </ul> 
                <!-- </div> --> 
                 <!-- Подсчет слайдов --> 
               <div class="count count-js"> 
                  <span class="count__current">1</span> из 
                  <span class="count__total">5</span> 
               </div>
               
               </div> 
               <button class="slider__next album-slider__next"><!-- Следущий --></button> 
               <button class="slider__prev album-slider__prev"><!-- Предыдущий--></button> 
               <div class="slider__container-preview"> 
                <ul class="slider__list-preview"> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Азазель-preview.jpg" width="150" alt="Азазель">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Сыновья Моря-preview.jpg" width="150" alt="Сыновья Моря">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Сатана-preview.jpg" width="150" alt="Сатана">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Аид-preview.jpg" width="150" alt="Аид">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Астарот-preview.jpg" width="150" alt="Астарот">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Басманов-preview.jpg" width="150" alt="Басманов">
                 </li> 
                 <li class="slider__item-preview">
                    <img class="slider__img-nav" src="img/portraits/Вельзевул-preview.jpg" width="150" alt="Вельзевул">
                 </li> 
                </ul> 
               </div> 
               <ul class="slider__dots"> 
               </ul> 
              
     </section>
     <div class="substrate substrate__album substrate__album--down">
        <section>
            <h2 class="section-header">Оставить отзыв</h2>
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
                <label class="input__sign input__sign--left" for="reviews-massage">Здесь вы можете оставить свой отзыв:</label> 
                <textarea class="input reviews__massage" id="reviews-massage" name="reviews">ваш отзыв...</textarea>
              </p>
              <button class="button feedback__button">Выразить мнение</button>
            </form>
            <div class="reviews__list">
              <blockquote class="reviews__item">
                <div class="header-title">
                  <cite class="header-title__title reviews__author-name">Трэвис Баркер</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
                </div>
                <div class="reviews__author-picture"><img alt="Фото Трэвиса Баркера" class="reviews__author-image" height="33" src="../img/reviews/persona-1.jpg" width="50"></div>
                <p class="reviews__text">Спасибо за лысину! Был проездом в Москве, заскочил побриться, чтобы было видно новую татуировку!</p>
              </blockquote>
              <blockquote class="reviews__item">
                <div class="header-title">
                  <cite class="header-title__title reviews__author-name">Джон Смит</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
                </div>
                <div class="reviews__author-picture"><img alt="Фото Джона Смита" class="reviews__author-image" height="33" src="../img/reviews/persona-2.jpg" width="50"></div>
                <p class="reviews__text">Отличную стрижку мне сделали ребята.</p>
              </blockquote>
              <blockquote class="reviews__item">
                <div class="header-title">
                  <cite class="header-title__title reviews__author-name">Иван Бородайло</cite> <time class="reviews__time" datetime="2016-01-11">11 января</time>
                </div>
                <div class="reviews__author-picture"><img alt="Фото Ивана Бородайло" class="reviews__author-image" height="33" src="../img/reviews/persona-3.jpg" width="50"></div>
                <p class="reviews__text">В Бородинском ваша борода в надёжных руках!</p>
              </blockquote>
            </div>
        </section>
     </div>
    </div>
    </main>
    <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
      <script src="js/album-slider.js"></script>
    </body>
    </html>