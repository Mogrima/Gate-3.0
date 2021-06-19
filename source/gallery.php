<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея персонажей: легенды демонов, ангелов, богов. Врата | Intogate.net';
    require_once(BUS.'/pagevars.php');
    $metadesription = "Порой возможно при помощи вдохновенного настроя воссоздать живых и мертвых, пробудить историю, открывая дорогу к истокам памяти.";
    require_once(BLOCKS .'head.php');
    if(isset($_POST['favorite'])) {
      $favorite = trim(filter_var($_POST['favorite'], FILTER_SANITIZE_STRING));
      $works_title = trim(filter_var($_POST['works_title'], FILTER_SANITIZE_STRING));
      $user_id = trim(filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT));
      $works_id = trim(filter_var($_POST['works_id'], FILTER_SANITIZE_STRING));
  
      $favorite_sql = "INSERT INTO favorite(user_id, works_title, works_image) VALUES ('$user_id', '$works_title', '$favorite')";
      $favorite_query = $pdo->prepare($favorite_sql);
      $favorite_query->execute(['favorite' => $favorite, 'works_title' => $works_title, 'favorite' => $favorite]);
      
      Header('Location: '. $current_url . '#' . $works_id);
    }
  
  if(isset($_POST['favorite_delete'])) {
    $favorite_delete = trim(filter_var($_POST['favorite_delete'], FILTER_SANITIZE_STRING));
    $user_id = trim(filter_var($_SESSION['user_id'], FILTER_SANITIZE_NUMBER_INT));
    $works_id = trim(filter_var($_POST['works_id'], FILTER_SANITIZE_STRING));
  
    $favorite_sql = "DELETE FROM favorite WHERE user_id = '$user_id' AND works_image = '$favorite_delete'";
    $favorite_query = $pdo->prepare($favorite_sql);
    $favorite_query->execute([$favorite_delete, $user_id]);
    Header('Location: '. $current_url . '#' . $works_id);
  }
  ?>
  <meta property="og:site_name" content="Intogate" />
  <meta property="og:title" content="<?=$website_title?>"/>
  <meta property="og:description" content="<?=$metadesription?>"/>
  <meta property="og:image" content="https://intogate.net/img/Ill_of_Hell/картаНижнегомира1.jpg"/>
  <meta property="og:type" content="website"/>
  <meta property="og:url" content= "https://intogate.net/gallery.php" />
  <meta name="twitter:creator" content="@Vse_vidim">
  <meta name="twitter:card" content="summary_large_image">
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
          <p class="page-description">Рисование будоражило меня с незапамятных лет, часто открывая моей памяти дорогу к
            истокам.
            При помощи графического планшета и вдохновенного настроя светлой грусти порой возможно совершить чудо -
            воссоздать
            живых и мертвых, пробудить историю, да и просто дать полную волю вымыслу.</p>
          <p class="page-description page-description--flex">Этот раздел разбит на альбомы,
            в каждом из которых – иллюстрации к разным книгам, а так же просто рисунки, ссылающиеся на разных упомянутых
            во
            Вратах персонажей.</p>
          <p class="page-description page-description--flex">Приятного просмотра!</p>
        </div>
        <p class="attention"><i>P.S.:</i> Делитесь своими впечатлениями, оставляйте свои комментарии – это легко и
          быстро можно сделать под каждым альбомом в Галерее! Только Вы способны помочь в совершенствовании своим
          откликом – это столь ценно для нас.</p>
        <section class="filters">
          <h2 class="visually-hidden">Фильтр рисунков</h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="filter" method="POST">
            <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
              <ul class="filter__list filter__list--center">
                <div class="filter__wrapper-gallery">
                  <li class="filter__item-gallery"><input class="checkbox" id="ill_of_books" name="filter[]"
                      type="checkbox" value="ill_of_books" checked> <label class="checkbox__name"
                      for="ill_of_books"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="color" name="filter[]" type="checkbox"
                      value="color"> <label class="checkbox__name" for="color"><span class="checkbox__indicator"></span>
                      Цветные</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="b_a_w" name="filter[]" type="checkbox"
                      value="b_a_w"> <label class="checkbox__name" for="b_a_w"><span class="checkbox__indicator"></span>
                      Черно-белые</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="history" name="filter[]" type="checkbox"
                      value="history"> <label class="checkbox__name" for="history"><span
                        class="checkbox__indicator"></span> Истории</label></li>
                </div>
              </ul>
            </fieldset><button class="filter__button filter__button--center" type="submit" value="sort"
              name="sort">Применить</button>
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
        <section id="gallery" class="gallery gallery-no-js">
          <div class="gallery__wrapper">
            <div class="slider">
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
                  $favorite_array = array();
                  for($i = 0; $i < $arts_count; $i++) {
                    $toggle_favorite = '';
                    $works_image = $album_src[$i];
                    $favoritequery = "SELECT works_image FROM favorite WHERE user_id = '$session_id' AND works_image = '$works_image'";
                    $favoriteData = $pdo->prepare($favoritequery);
                    $favoriteData->execute([$session_id, $works_image]);
                    while($favoriterow = $favoriteData->fetch(PDO::FETCH_OBJ)) {
                      $toggle_favorite = $favoriterow->works_image;
                    }
                    
                    if (!empty($toggle_favorite)) {
                      $favorite_array[] = false;
                    } else {
                      $favorite_array[] = true;
                    }
                    unset($toggle_favorite);
                  }
                  for($i = 0; $i < $arts_count; $i++) {
                     ?>
                <li class="slider__item">
                  <h3 class="works__title album-slider__title"><?=$album_name[$i]?></h3>
                  <img class="slider__img" src="img/<?=$album_src[$i]?>.jpg" width="768px" alt="<?=$album_name[$i]?>">
                  <?php
                          if (isset($_SESSION['user_id'])) {
                              if($favorite_array[$i]) {
                          ?>
                  <form action="<?php echo $current_url ?>" method="POST">
                    <input type="hidden" name="works_id" value="<?=$i?>" readonly>
                    <input type="hidden" name="works_title" value="<?=$album_name[$i]?>" readonly>
                    <button class="icon-favorite icon-favorite--close" type="submit" value="<?=$album_src[$i]?>"
                      name="favorite">
                      <span class="visually-hidden">Добавить в любимое</span>
                    </button>
                  </form>
                  <?php } else { ?>
                  <form action="<?php echo $current_url ?>" method="POST">
                    <input type="hidden" name="works_id" value="<?=$i?>" readonly>
                    <button class="icon-favorite icon-favorite--open" type="submit" value="<?=$album_src[$i]?>"
                      name="favorite_delete">
                      <span class="visually-hidden">Удалить из любимого</span>
                    </button>
                  </form>
                  <?php  }
                          }
                          ?>
                </li>
                <?php }?>
              </ul>
              <ul class="slider__list-preview">
                <?php
                for($i = 0; $i < $arts_count; $i++) { ?>
                <li class="slider__item-preview">
                  <img class="slider__img-nav" src="img/<?=$album_src[$i]?>-preview.jpg" width="150"
                    alt="<?=$album_name[$i]?>">
                </li>
                <?php } ?>
              </ul>
              <div class="count">
                <span class="count__current">1</span> из
                <span class="count__total">5</span>
              </div>

            </div>
            <div class="slider__ctrl">
              <button class="slider__prev album-slider__prev" type="button" data-shift="prev">
                <!-- Предыдущий--></button>
              <button class="slider__next album-slider__next" type="button" data-shift="next">
                <!-- Следущий --></button>
            </div>
            <div class="slider__wrapper-dots">
              <ul class="slider__dots"></ul>
            </div>

          </div>
          <a class="filter__button filter__button--center" href="./gallery.php">Сбросить фильтр</a>
        </section>
        <?php 
         } // конец Post sort
      else {
    ?>
        <?php $works_title = 'Список альбомов и рисунков';
        // выключаем (прячем) заголовок
        $sectionTitleOn = false;
        $descOff = false;
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
  <script src="js/slider.function.js"></script>
  <script>
    var gallery = new Gallery('gallery', {
      dots: true,
      keyControl: true,
      responsive: true,
      adaptive: {
        320: {
          widthSlider: 320,
          margin: 20,
          visibleItems: 1
        },
        768: {
          widthSlider: 480,
          margin: 20,
          preview: true
        },
        1199: {
          widthSlider: 800,
          preview: true
        }
      }
    });

  </script>
</body>

</html>
