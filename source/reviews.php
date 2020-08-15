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
          <p class="page-description">Здесь Вы можете поделиться своим общим впечатлением от посещения Врат. Вам что-то пришлось по душе и/или что-то вызывает лютое раздражение? Расскажите об этом! С помощью отзывов мы сможем совершенствовать ресурс для Вас. Так же, отзывы помогают ориентироваться гостям – выражают суть сайта порой лучше всяких описаний. Это очень важно.</p>
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