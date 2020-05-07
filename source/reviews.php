<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Отзывы';
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
        <div class="page-main__head page-main__head--set">
          <h1 class="title">Отзывы</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Отзывы</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Здесь Вы можете поделиться своим общим впечатлением от посещения Врат. Вам что-то пришлось по душе, а что-то вызывает лютое раздражение? Расскажите об этом! С помощью отзывов мы сможем совершенствовать ресурс для Вас. Так же, отзывы помогают ориентироваться гостям ресурса – выражают суть сайта порой лучше всяких описаний. Это очень важно.</p>
          <p class="attention"><i>P.S.:</i> Прежде чем оставить свой отзыв, пожалуйста, ознакомьтесь с <a class="link link--reviews" href="#">правилами комментирования</a>. Только корректно написанные отзывы остаются на этой странице. Спасибо за понимание!</p>
        </div>
        <section class="reviews">
        <?php require_once(BUS . 'reviews.php');?>
          <h2 class="visually-hidden">Отзывы о нас</h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="reviews__form" method="post">
            <div class="reviews__form-wrapper">
              <p class="input__wrapper input__wrapper--flex">
                <label class="input__sign input__sign--left" for="reviews-name">Назовитесь:</label>
                <input class="input reviews__input" id="reviews-name" type="text" name="name" maxlength="20" placeholder="имя..." value="<?=$loginCurrent?>" required>
              </p>
              <p class="input__wrapper input__wrapper--flex">
                <label class="input__sign input__sign--left" for="reviews-email">Ваша почта:</label>
                <input class="input reviews__input" id="reviews-email" type="email" name="email" maxlength="30" placeholder="почтовый ящик..." value="<?=$emailCurrent?>" required>
              </p>
            </div>
            <p class="input__wrapper input__wrapper--flex">
              <label class="input__sign input__sign--left" for="reviews-massage">Здесь вы можете оставить свой отзыв:</label> 
              <textarea class="input reviews__massage" id="reviews-massage" name="reviews" maxlength="600" placeholder="ваш отзыв..."></textarea>
            </p>
            <button class="button feedback__button">Выразить мнение</button>
          </form>
          <div class="reviews__list">
            <?php
            $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
            $on_page = 3;
            $shift = ($page - 1) * $on_page;
            $sql = "SELECT * FROM reviews ORDER BY `date` DESC LIMIT $shift, $on_page";
            $result = $pdo->query($sql);
            while($row = $result->fetch(PDO::FETCH_OBJ)) {
              $user_id = $row->author_id;
              $queryUser = "SELECT username, avatar FROM user WHERE `user_id` = $user_id";
              $resultUser = $pdo->query($queryUser);
              $rowUser = $resultUser->fetch(PDO::FETCH_OBJ);
              $userPic = $rowUser->avatar;
              echo "<blockquote class='reviews__item'>
                        <div class='header-title'>
                          <cite class='header-title__title reviews__author-name'>$rowUser->username</cite><time class='reviews__time' datetime='$row->date'>$row->date</time>
                        </div>
                        <div class='reviews__author-picture'><img alt='Фото $rowUser->username' class='reviews__author-image' src='/$userPic' width='70' height='70'></div>
                        <p class='reviews__text'>$row->comment</p>
                        </blockquote>";;
            }
            $stmt = $pdo->query("SELECT COUNT(*) FROM reviews");
            $row = $stmt->fetch();
            $c=$row[0]; //количество строк

            $countPage = ceil($c / $on_page);
          require_once(BLOCKS . 'pagination.php');?>
        </div>
        </section>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>
</html>