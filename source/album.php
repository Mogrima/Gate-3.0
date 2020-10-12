<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $id = $_GET["id"];
    // вывод информации об альбоме
    $album_list = "SELECT `works_title`, `works_desc`, `nested` FROM `album_list` WHERE id = $id";
    $query = $pdo->query($album_list);
    $album = $query->fetch(PDO::FETCH_OBJ);
    $album_title = $album->works_title;
    $album_desc = $album->works_desc;
    $nested = $album->nested;
    $website_title = 'Галерея: ' . $album_title;
    // вывод рисунков
    $album_arts = "SELECT * FROM `album_arts` WHERE album_id = $id ORDER BY `id` DESC";
    $query = $pdo->query($album_arts);
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="css/album-slider.css" rel="stylesheet">
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); 
  ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title"><?=$album_title?></h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="gallery.php">Галерея</a>
            </li>
            <?php if($nested == 1) { ?>
              <li class="breadcrumb__item"><a class="breadcrumb__link" href="inner-album.php">Легенды</a></li>
            <?php } ?>
            <li class="breadcrumb__item breadcrumb__item--current"><?=$album_title?></li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description"><?=$album_desc?></p>
          </div>
          <section class="gallery gallery-no-js">
         <div class="slider__container"> 
                <!-- <li id="slide_slice"> --> 
                <ul class="slider__list"> 
                <?php
                $album_name = array();
                $album_src = array();
                  while($art = $query->fetch(PDO::FETCH_OBJ)) {
                    $album_name[] = $art->works_title;;
                    $album_src[] = $art->works_image;
                  } 
                  $arts_count = count($album_name);
                  for($i = 0; $i < $arts_count; $i++) {
                     ?>
                    <li class="slider__item">
                      <h3 class="works__title album-slider__title"><?=$album_name[$i]?></h3>
                      <img class="slider__img" src="img/<?=$album_src[$i]?>.jpg" width="768px" alt="<?=$album_name[$i]?>">
                      <div class="count count-no-js"><span>1/7</span></div>
                    </li> 
                  <?php }?>
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
                 <?php
                 for($i = 0; $i < $arts_count; $i++) { ?>
                    <li class="slider__item-preview">
                      <img class="slider__img-nav" src="img/<?=$album_src[$i]?>-preview.jpg" width="150" alt="<?=$album_name[$i]?>">
                    </li> 
                 <?php } ?>
                </ul> 
               </div> 
               <ul class="slider__dots"> 
               </ul> 
              
     </section>
     <?php require_once(BLOCKS .'rules-comment.php'); ?>
        <section>
        <?php 
         $book_id = $_GET['id'];
         $type = 'album';
         $get_id = $book_id;
        $link_comment = '/album.php';
        $link_comment_get = "?id=$get_id";
        $comments_table = 'comments_art';
         require_once(BLOCKS .'comment.php');
         $link = 'album.php';
         $link_add = "&amp;id=$book_id";

          // получение полного количества новостей
          $stmt = $pdo->query("SELECT COUNT(*) FROM $comments_table WHERE article_id = $book_id");
          $row = $stmt->fetch();
          $c=$row[0]; //количество строк

          $countPage = ceil($c / $on_page);
         require_once(BLOCKS . 'pagination.php'); ?>
        </section>
    </div>
    </main>
    <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
  <script src="js/album-slider.js"></script>
  <script>
  let totalCountLetter = 600;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCountLetter - countInput.value.length;
  });

//   function $_GET(id) {
//     var p = window.location.search;
//     p = p.match(new RegExp(key + '=([^&=]+)'));
//     return p ? p[1] : false;
// }

  $('#reviews__form').submit(function(event) {
    event.preventDefault();
    var reviews = $('#reviews').val();
    var user = $('#user').val();
    var article_id = $('#article_id').val();
    var author_id = $('#author_id').val();
    var page = 1;

    $.ajax({
      url: "./core/business/send_comment.php",
      type: 'POST',
      cache: false,
      data: {
        'reviews': reviews,
        'user': user,
        'article_id': article_id,
        'author_id': author_id
      },
      dataType: 'html',
      success: function(data) {
        if (data) {
          // $('.attention--user_msg').hide();
          $('.attention--user_msg').text(data);
          $('.feedback__button').text('Загрузка..');
          // document.location.reload(true); // перезагрузка страницы
          // window.location.replace(newUrl);

          $.ajax({
      url: "./core/blocks/reviews.php",
      type: 'POST',
      cache: false,
      data: {
        'page': page
      },
      dataType: 'html',
      success: function(data) {
        if (data) {
          // $('.attention--user_msg').hide();
          $('.attention--user_msg').text(data);
          $('.feedback__button').text('Загрузка..');
          // document.location.reload(true); // перезагрузка страницы
          // window.location.replace(newUrl);
        } else {
          console.log(data);
          console.log(reviews, user, article_id, author_id);
          // $('.attention--user_msg').show();
          $('.attention--user_msg').text(data);
        }
      },
      error: function(xhr, str){ //ошибка выводит соответствующее сообщение 
        console.log('Возникла ошибка: ' + xhr.responseCode);
         }
    });

        } else {
          console.log(data);
          console.log(reviews, user, article_id, author_id);
          // $('.attention--user_msg').show();
          $('.attention--user_msg').text(data);
        }
      },
      error: function(xhr, str){ //ошибка выводит соответствующее сообщение 
        console.log('Возникла ошибка: ' + xhr.responseCode);
         }
    });
  });

  // $(function() {
  //     $('#reviews__form').submit(function(e) {
  //       var $form = $(this);
  //       $.ajax({
  //         type: 'POST',
  //         url: './core/business/send_comment.php',
  //         data: $form.serialize()
  //       }).done(function() {
  //         console.log('success');
  //       }).fail(function() {
  //         console.log('fail');
  //       });
  //       //отмена действия по умолчанию для кнопки submit
  //       e.preventDefault(); 
  //     });
  //   });
  </script>
    </body>
    </html>