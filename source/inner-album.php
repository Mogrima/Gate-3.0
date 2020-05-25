<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея: Легенды';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php $menu_active[2] = "page-navigation__item--active";
        require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album"> <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Легенды</h1>
          <ul class="breadcrumb page-main__breadcrumb">
          <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="gallery.php">Галерея</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Легенды</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php');?>
          </div>
          <section class="works works--bg-blue">
            <h2 class="visually-hidden">Легенды</h2>
            <div class="works__wrapper works__wrapper--album">
              <?php
              $sql = "SELECT * FROM `album_list` WHERE `nested` = 1 ORDER BY `id`";
              $query = $pdo->query($sql);
              $src_stat = "img/";
              $works_link = 'album.php?id=';
              while($row = $query->fetch(PDO::FETCH_OBJ)) {
                $works_image_src = $src_stat.$row->works_image;
                $works_linkAlbum = $works_link.$row->id ?>
              <figure class="works__item works__item--pb">
                <figcaption class="works__title works__title--mt works__title--album">
                <?=$row->works_title?>
                </figcaption><img alt="История Мефистофеля" class="works__image" height="347" src="<?=$works_image_src?>" width="258">
                <p class="works__description works__description--album"><?=$row->works_desc?></p><a class="button works__button works__button--album" href="<?=$works_linkAlbum?>">Открыть</a>
              </figure>
              <?php 
              }    
              ?>
            </div>
          </section>
      </div> <!--  Подложка -->
    </div>
    </main>
    <?php require_once(BLOCKS .'footer.php'); ?>
    <?php require_once(BLOCKS .'modal-login.php'); ?>
    <?php require_once(BLOCKS .'modal-registration.php'); ?>
    <div class="overlay"></div>
    <?php require_once(BLOCKS .'scripts-include.php'); ?>
    </body>
    </html>