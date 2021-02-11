<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="css/album-slider.css" rel="stylesheet">
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Галерея</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Галерея</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Рисование будоражило меня с незапамятных лет, часто открывая моей памяти дорогу к истокам.
             При помощи графического планшета и вдохновенного настроя светлой грусти порой возможно совершить чудо - воссоздать 
             живых и мертвых, пробудить историю, да и просто дать полную волю вымыслу.</p>
          <p class="page-description page-description--flex">Этот раздел разбит на альбомы, 
             в каждом из которых – иллюстрации к разным книгам, а так же просто рисунки, ссылающиеся на разных упомянутых во 
             Вратах персонажей.</p>
          <p class="page-description page-description--flex">Приятного просмотра!</p>
        </div>
        <p class="attention"><i>P.S.:</i> Делитесь своими впечатлениями, оставляйте свои комментарии – это легко и быстро можно сделать под каждым альбомом в Галерее! Только Вы способны помочь в совершенствовании своим откликом – это столь ценно для нас.</p>
        <section class="filters">
          <h2 class="visually-hidden">Фильтр рисунков</h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="filter" method="POST">
            <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
                  <ul class="filter__list filter__list--center">
                    <div class="filter__wrapper-gallery">
                    <li class="filter__item-gallery"><input class="checkbox" id="ill_of_books" name="filter[]" type="checkbox" value="ill_of_books" checked> <label class="checkbox__name" for="ill_of_books"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="color" name="filter[]" type="checkbox" value="color"> <label class="checkbox__name" for="color"><span class="checkbox__indicator"></span> Цветные</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="b_a_w" name="filter[]" type="checkbox" value="b_a_w"> <label class="checkbox__name" for="b_a_w"><span class="checkbox__indicator"></span> Черно-белые</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="history" name="filter[]" type="checkbox" value="history"> <label class="checkbox__name" for="history"><span class="checkbox__indicator"></span> Истории</label></li>
                    </div>
                  </ul>
            </fieldset><button class="filter__button filter__button--center" type="submit" value="sort" name="sort">Применить</button>
          </form>
        </section>
        <?php 
         $title = 'works_title';
         $src = 'works_image';
         $type = 'album_arts';

        function get_Filtred_works($filters, $title, $src, $type) {
          $count_filtres_checked = count($filters);
          $filter_sql = "SELECT  $title, $src FROM $type WHERE ";
          for($i = 0; $i < $count_filtres_checked; $i++) {
            $filters[$i] = $filters[$i] . " = 1 OR ";
            $filter_sql = $filter_sql . $filters[$i];
          }
          $filter_sql = substr($filter_sql, 0, -4);
          $filter_sql = $filter_sql . " ORDER BY `id` DESC";
          return $filter_sql;
          }
  
        if(isset($_POST['sort'])) {
          $filters = $_POST['filter'];
          $filter_sql = get_Filtred_works($filters, $title, $src, $type);


          $query = $pdo->query($filter_sql);
          ?>
           <section class="gallery gallery-no-js">
              <div class="slider__container"> 
                <ul class="slider__list"> 
                <?php
                $album_name = array();
                $album_src = array();
                while($row = $query->fetch(PDO::FETCH_OBJ)) {

                  $title_works = $row->$title;
                  $title_src = $row->$src;
                  $album_name[] = $row->$title;
                    $album_src[] = $row->$src;                    
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
             <a class="filter__button filter__button--center" href="./gallery.php">Сбросить фильтр</a>
     </section>
     <?php 
         } // конец Post sort
      else {
    ?>
        <?php $works_title = 'Список альбомов и рисунков';
        // выключаем (прячем) заголовок
        $sectionTitleOn = false;
        $works_link = 'album.php?id=';
        $src_stat = 'img/';
        
        // --------------------- пагинация ---------------------------------------------- //
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $on_page = 6;
        $shift = ($page - 1) * $on_page;
        // запрос на вывод данных каталога произведений из бд в порядке убывания по id
        $sql = "SELECT * FROM `album_list` WHERE `nested` = 0 ORDER BY `id` DESC LIMIT $shift, $on_page";
        $query = $pdo->query($sql);
        $stmt = $pdo->query("SELECT COUNT(*) FROM album_list");
        $row = $stmt->fetch();
        $c=$row[0];
        $countPage = ceil($c / $on_page);
        // подключение самого шаблона католога, в котором уже прописан цикл для вывода данных
        require(BLOCKS .'works_section.php');
        $link = '/gallery.php';
        $link_add = "";
        $anchor = '#anchor';
        require_once(BLOCKS . 'pagination.php');
       } // конец else после if sort ?>
      </div><!-- Подложка -->
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