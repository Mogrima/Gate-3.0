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
    $contents = $_GET["contents"];
    $website_title = 'Наследники богов двух миров';
    // вывод рисунков
    $album_arts = "SELECT * FROM `manga` WHERE manga_title = 'Наследники богов двух миров' AND num_of_Head = $contents ORDER BY `id` ASC";
    $query = $pdo->query($album_arts);
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="fotorama/fotorama.css" rel="stylesheet">
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); 
  ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head page-main__head--mb">
          <h1 class="title">Глава 1</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./gallery.php">Галерея</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="./endlessStory.php">Бесконечная история</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Наследники богов двух миров</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          </div>
          <div class="fotorama" data-width="800"  data-max-width="100%" data-allowfullscreen="native">
            <?php 
            while($art = $query->fetch(PDO::FETCH_OBJ)) { ?>
            <img class="fotorama__img" src="./img/manga/<?=$art->manga_src?><?=$art->works_image?>.jpg">
           <?php } ?>
          </div>
          <section>
        <?php 
         $book_id = 1;
         $get_id = $book_id;
        $link_comment = "/manga.php?contents=$contents";
        $link_comment_get = "";
        $comments_table = 'comments_art';
        require_once(BLOCKS .'comment.php');
         $link = "/manga.php?contents=$contents";
         $link_add = "";

          // получение полного количества новостей
          $stmt = $pdo->query("SELECT COUNT(*) FROM $comments_table WHERE article_id = $book_id");
          $row = $stmt->fetch();
          $c=$row[0]; //количество строк

          $countPage = ceil($c / $on_page);
      
        if ($countPage > 1) {
          ?>
        <ul class="pagination">
          <?php if($page > 1) { ?>
          <li class="pagination__item"><a href="<?=$link?>&amp;page=1<?=$anchor?>"
              class="pagination__arrow  pagination__arrow--prev pagination__arrow--start"><span class="visually-hidden">в
                начало</span></a></li>
          <li class="pagination__item"><a href="<?=$link?>&amp;page=<?=$page-1;?><?=$anchor?>"
              class="pagination__arrow pagination__arrow--prev"><span class="visually-hidden">на предыдущую страницу</span></a>
          </li>
          <?php } 
        $numberOfLinks = 1;
        $startLink = $page - $numberOfLinks;
        ($startLink <= 0) ? $startLink = 1 : $startLink;
        ($page == 1) ? $numberOfLinks = 2 : $numberOfLinks;
        $finaltLink = $page + $numberOfLinks;
        ($finaltLink >= $countPage) ? $finaltLink = $countPage : $finaltLink;
        for($i = $startLink; $i<= $finaltLink; $i++) { 
        ?>
          <li class="pagination__item"> <a <?=($i == $page) ? "" : "href='$link&amp;page=$i$anchor'";?>
              <?=($i == $page) ? 'class="pagination__link pagination__link--current"' : 'class="pagination__link"';?>><?=$i;?></a>
          </li>
          <?php }

        if($page < $countPage) { ?>
          <li class="pagination__item"><a href="<?=$link?>&amp;page=<?=$page+1;?><?=$anchor?>"
              class="pagination__arrow pagination__arrow--next"><span class="visually-hidden">на следующую страницу</span></a>
          </li>
          <li class="pagination__item"><a href="<?=$link?>&amp;page=<?=$countPage;?><?=$anchor?>"
              class="pagination__arrow pagination__arrow--next pagination__arrow--finish"><span class="visually-hidden">в
                конец</span></a></li>
          <?php } ?>
        </ul>
        <?php } 
        ?>
        </section>
        </div>
    </div>
    </main>
    <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <script src="./js/jquery.min.js"></script>
  <script src="fotorama/fotorama.js"></script>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
  <script>
  let totalCountLetter = 600;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCountLetter - countInput.value.length;
  });
  </script>
</body>
</html>