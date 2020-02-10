<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Оглавление манги: Бесконечная история';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Бесконечная история</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="gallery.php">Галерея</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Бесконечная история</li>
          </ul>
          <?php require_once BLOCKS .'search-block.php' ?>
          <p class="attention page-main__attention"><strong><span class="attention__restriction">Возрастное ограничение: 18+ </span></strong>
         <strong>Предупреждение:</strong> ненормативная лексика, сцены насилия и жестокости, нетрадиционные отношения, отклонение от религиозных канонов.</p>

        </div>
        <p class="page-description">Память подобна клочкам разорванной картины, на которой было отображено нечто крайне важное. Но даже эти клочки не всегда удается сохранить. Стараясь собрать картину воедино, Рождер и Могрим нередко оказываются во власти заблуждений. События прошлого искажаются порой до неузнаваемости. Столь важно знать: кто же на самом деле был верным другом, а кто стоит за нескончаемой пыткой?</p>
        <p class="page-description">Сколько пройдет времени, прежде чем прошлое раскроет все свои тайны? Откроется ли в поисках финала вся пройденная жизнь целиком в ее первозданном виде? Долгая нечеловеческая жизнь наполнена метаниями и сомнениями, но именно за ними, возможно, им предстоит долгожданный покой.</p>
        <p class="page-description">На середине долгого пути волей Создателя, уставшего от своей жизни, пути двух беспокойных душ снова пересекутся. Могриму и Роджеру волей случая суждено стать наследниками старых, причудливых владык Мироздания. </p>
          <section class="contents">
            <div class="contents__wrapper">
              <p class="contents__title"><span class="contents__underline">Глава 1: Наследники</span></p>
              <h2 class="section-header">Оглавление</h2>
             <ol class="contents__list">
               <li class="contents__item"><a class="contents__link" href="./manga.php?contents=1">1: Наследники Богов двух миров</a></li>
               <li class="contents__item contents__link contents__link--disabled">2: Поезд на Восток</li>
               <li class="contents__item contents__link contents__link--disabled">3: Южный Лорд</li>
               <li class="contents__item contents__link contents__link--disabled">4: Лазарет</li>
               <li class="contents__item contents__link contents__link--disabled">5: Казармы</li>
               <li class="contents__item contents__link contents__link--disabled">6: Ошибка</li>
               <li class="contents__item contents__link contents__link--disabled">7: Лицо нового мира</li>
             </ol>
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
  </body>
  </html>