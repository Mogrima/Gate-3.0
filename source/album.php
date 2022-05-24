<?php require_once('./core/business/session.php');
$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once('./core/business/appvars.php');
require_once(BUS . 'connectvars.php');
// подключение к базе данных
require_once(BUS.'/mysql__connect.php');  
// получение id альбома
$id = $_GET["id"];

// вывод рисунков
$album_arts = "SELECT * FROM `album_arts` WHERE album_id = $id ORDER BY `id` DESC";
$arts_query = $pdo->query($album_arts);

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
<!DOCTYPE html>
<html xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" lang="ru">

<head>
  <?php
   $url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    // вывод информации об альбоме
    $album_list = "SELECT `works_title`, `works_desc`, `works_image`, `nested`, `meta_html` FROM `album_list` WHERE id = $id";
    $query = $pdo->query($album_list);
    $album = $query->fetch(PDO::FETCH_OBJ);
    $album_title = $album->works_title;
    $album_desc = $album->works_desc;
    $cover_album = $album->works_image;
    $nested = $album->nested;
    $meta = $album->meta_html;
    $metas = explode('&shy', $meta);
    $website_title = $metas[0];
    $metadesription =  $metas[1];
    
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <meta property="og:site_name" content="Intogate" />
    <meta property="og:title" content="<?=$website_title?>"/>
    <meta property="og:description" content="<?=$metadesription?>"/>
    <meta property="og:image" content="https://intogate.net/img/<?=$cover_album?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content= "<?=$url?>" />
    <meta name="twitter:creator" content="@Vse_vidim">
  <meta name="twitter:card" content="summary_large_image">
  <link href="css/album-slider.css" rel="stylesheet">
  </head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); 
  ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate substrate__album">
        <!--  Подложка -->
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
        <section id="gallery" class="gallery gallery-no-js">
          <div class="gallery__wrapper">
            <div class="slider">
              <ul class="slider__list">
                <?php
                $album_name = array();
                $album_src = array();
                  while($art = $arts_query->fetch(PDO::FETCH_OBJ)) {
                    $album_name[] = $art->works_title;;
                    $album_src[] = $art->works_image;
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
                    $image = explode('.', $album_src[$i]);
                    if($image[1] != NULL) {
                      $src = $image[0];
                      $type = $image[1];
                    } else {
                      $type = 'jpg';
                    }
                     ?>
                     
                <li class="slider__item">

                  <h3 class="album-slider__title"><?=$album_name[$i]?></h3><a class="album__item-achor gallery-no-js" name="<?=$i?>"></a>
                  <img class="slider__img" src="img/<?=$image[0]?>.<?=$type?>" width="768px" alt="<?=$album_name[$i]?>">
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
                for($i = 0; $i < $arts_count; $i++) { 
                  $image = explode('.', $album_src[$i]);
                  if($image[1] != NULL) {
                    $src = $image[0];
                    $type = $image[1];
                  } else {
                    $type = 'jpg';
                  }
                  ?>
                <li class="slider__item-preview">
                  <img class="slider__img-nav" src="img/<?=$image[0]?>-preview.<?=$type?>" width="150"
                    alt="<?=$album_name[$i]?>">
                </li>
                <?php } ?>
              </ul>
              <!-- Подсчет слайдов -->
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
        </section>
        <?php require_once(BLOCKS .'rules-comment.php'); ?>
        <section>
          <?php 
         $book_id = $_GET['id'];
         $image = 'album';
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
  <script>
    let totalCountLetter = 600;
    let countInput = document.querySelector('.countInput');
    let count = document.querySelector('.count-letter_symbol');
    if (countInput != null) {
      countInput.addEventListener('input', function () {
        count.innerHTML = totalCountLetter - countInput.value.length;
      });
    };

    document.addEventListener('DOMContentLoaded', (event) => {
      let tk = '';
      grecaptcha.ready(function () {
        grecaptcha.execute('6LfJljAaAAAAAHHrGwm6lU1CcfQUs9CK4IOHzF_p', {
          action: 'homepage'
        }).then(function (token) {
          tk = token;
          document.getElementById('token2').value = token;
        });
      });
    });
  </script>
</body>
</html>