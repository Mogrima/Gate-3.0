<?php require_once('../business/session.php');
  require_once('../business/appvars.php');
  require_once(BUS_с. '/pagevars_c.php');
  require_once(BUS_с. 'connectvars.php');
  // подключение к базе данных
  require_once(BUS_с. 'mysql__connect.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    $website_title = 'Новости';
    require_once '../blocks/head.php' ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <header class="page-header">
      <div class="page-header__wrapper <?=$user_header_class?>">
        <a href="index.php" class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54" src="../../img/Logo.png"></a>
        <?php
        require_once('../business/menu_links.php');
        if (isset ($_SESSION['username'])) {
          $session_id = $_SESSION['user_id'];
      $userquery = "SELECT * FROM user WHERE `user_id` = :session_id";
      $userData = $pdo->prepare($userquery);
      $userData->execute([':session_id' => $session_id]);
    while($row = $userData->fetch(PDO::FETCH_OBJ)) {

      $avatar1 = $row->avatar;
      $loginCurrent = $row->username;
      $emailCurrent = $row->user_email;
      if(!$user_page) {
        ?>
        <nav class="profile-menu profile-menu--nojs">
          <button class="profile-menu__button" type="button">
              <img class="profile-menu__icon" src="../../img/user/<?php echo $avatar1?>" width="70" height="70" alt="меню пользователя">
              <span class="profile__name"><?php echo ''.$_SESSION['username'].'' ?></span>
              <span class="visually-hidden">Открыть</span>
          </button>
          <ul class="profile-menu__list">
            <li class="profile-menu__item">
              <a class="profile-menu__link" href="/user.php">Перейти в личный кабинет</a>
            </li>
            <li class="profile-menu__item">
              <a class="profile-menu__link profile-menu__link--bottom" href="<?=$logout_php?>">Выйти</a>
            </li>
          </ul>
      </nav>
      <?php } }
    } else {
      ?>
        <nav class="page-header__user-block user-navigation user-navigation--nojs user-navigation--closed">
          <button class="user-navigation__toggle" type="button"><span class="visually-hidden">Открыть</span>
          </button>
          <ul class="user-navigation__list">
            <li class="user-navigation__item">
              <a class="user-navigation__link registration-link" href="<?=$reg_php?>">Оформить читательский билет</a>
            </li>
            <li class="user-navigation__item user-navigation__item--bottom">
              <a class="user-navigation__link login-link" href="<?=$login_php?>">Представиться</a>
            </li>
          </ul>
        </nav>
        <?php } ?>
      </div>
    </header>
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <a href="receiver.php" class="button">Назад</a>
      <form class="form-addnews" action="submitNews.php" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> -->
        <label for="news_title">Название новости</label>
        <input class="input input__title" id="news_title" type="text" name="news_title" value="<?php if(!empty($title)) echo $title; ?>">
        <label for="news_intro">Превью новости</label>
        <textarea class="input input__preview" id="news_intro" type="text" name="news_intro"><?php if(!empty($preview)) echo $preview; ?></textarea>
        <label for="news-text">Текст новости</label>
        <textarea class="input news_text" id="news_text" type="text" name="news_text"><?php if(!empty($text)) echo $text; ?></textarea>
        <!-- <label for="screenshot">Файл изображения:</label>
        <input class="input" id="screenshot" type="file" name="screenshot"> -->
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
        <a class="button addnews-button" href="index.php">на главную</a>
        </form>
        <h2>Все новости</h2>
        <?php

        $sql = 'SELECT * FROM `news` ORDER BY `date` DESC';
        $query = $pdo->query($sql);
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo "<h2>$row->title</h2>
                  <p>$row->intro</p>
                  <p><b>Автор статьи: </b><mark>$row->author</mark></p>
                  <p><time>$row->date</time></p>
                  <a class='btn btn-warning mb-5'>Прочитать больше</a>";
        }
        ?>
      </div>
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>