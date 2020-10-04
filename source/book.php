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
    require_once(BLOCKS . 'head.php'); 
    
    $book_id = $_GET["id"];
    $sql = "SELECT * FROM `works_catalog` WHERE id = $book_id";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $title = $row->works_title;
      $desc = $row->works_desc;
      $works_image_src = '../img/works-catalog/'.$row->works_image;
      $genre = $row->genre;
      $warning = $row->warning;
      $NC = $row->NC;
      $text = $row->text;
      $extra = $row->extra;?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title title--work"><span><?=$title?></span> <img src="img/icons/<?=$NC?>.png" alt="<?=$NC?>+" width="65" height="100"></h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
            <a class="breadcrumb__link" href="works-catalog.php">Книги</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current"><?=$title?></li>
          </ul>
          <section class="preview">
            <h2 class="visually-hidden">Описание книги <?=$title?></h2>
            <div class="preview__wrapper">
              <div class="preview__content">
                <img class="preview__content-img" src="<?=$works_image_src?>" alt="<?=$title?>">
                
              </div>
              <div class="preview__desc">
                <div class="preview__genre">
                  <h3 class="preview__caption">Жанр:</h3> <?=$genre?>
                </div>
                <?php if ($warning != '') { ?>
                <p class="attention preview__attention"><strong class="preview__caption">Предупреждения: </strong><?=$warning?></p>
                <?php } ?>
                <h3 class="preview__caption">Сюжет:</h3>
                <p class="preview__text"><?=$desc?> </p>
                  <?=$extra?>
              </div>
              <?php if ($text != '') { ?>
              <a class="preview__button button" href="reader.php?id=<?=$id?>">Читать</a>
              <?php } ?>
            </div>
          </section>
          <div class="attention"><details class="rules"><summary><i>P.S.:</i> Прежде чем оставить свой отзыв, пожалуйста, ознакомьтесь с <span class="link link--reviews">правилами комментирования</span>. Только корректно написанные отзывы остаются на этой странице. Спасибо за понимание!</summary>
          <section class="rules-comment">
            <h2 class="section-header rules-comment__title">Правила комментирования</h2>
            <p class="rules-comment__text">При комментировании тех или иных материалов запрещены:</p>
            <ul class="page-main__intro-list rules-comment__list">
              <li class="page-main__intro-item">Призывы к войне, свержению существующего строя, терроризму (в т.ч. хакерским атакам), экстремизму.</li>
              <li class="page-main__intro-item">Пропаганда фашизма, геноцида, нацизма. Посягательства на историческую память в отношении событий, имевших место в период Второй мировой войны, отрицание фактов, установленных приговором Международного военного трибунала для суда и наказания главных военных преступников европейских стран оси, одобрение преступлений, установленных указанным приговором, а также распространение заведомо ложных сведений о деятельности СССР в годы Второй мировой войны.</li>
              <li class="page-main__intro-item">Разжигание межнациональной, межрелигиозной, социальной розни, грубые высказывания в адрес представителей любых национальностей, рас и вероисповеданий.</li>
              <li class="page-main__intro-item">Угрозы физической расправы, убийства, сексуального насилия. Описание средств и способов суицида, любое подстрекательство к его совершению.</li>
              <li class="page-main__intro-item">Переход на личности, оскорбления в адрес официальных и публичных лиц (в т.ч. умерших), грубые выражения, оскорбления и принижения других участников комментирования, их родных или близких.</li>
            </ul>
            <p><strong>Комментарии, нарушающие правила поведения на сайте Intogate.net, удаляются без предупреждения. При вторичном размещении уже удалённого сообщения, модератор вправе заблокировать («забанить») пользователя.</strong></p>
            <p>Оставляя комментарий, вы автоматически соглашаетесь с тем, что озанкомились с правилами комментирования и несете ответственность за свои комментарии.</p>
          </section>
          </details></div>
          <section class="reviews">
          <?php 
          $get_id = $book_id;
          $link_comment = '/book.php';
          $link_comment_get = "?id=$get_id";
          $comments_table = 'comments_book';
          require_once(BLOCKS .'comment.php');
          $link = '/book.php';
          $link_add = "&amp;id=$book_id";
          // получение полного количества новостей
          $stmt = $pdo->query("SELECT COUNT(*) FROM $comments_table WHERE article_id = $book_id");
          $row = $stmt->fetch();
          $c=$row[0]; //количество строк

          $countPage = ceil($c / $on_page);

          require_once(BLOCKS . 'pagination.php'); ?>
        </section>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
        </div>
        </div>
      </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
  <script>
  let totalCount = 600;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCount - countInput.value.length;
  });
  </script>
</body>

</html>
