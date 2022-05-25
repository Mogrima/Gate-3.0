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
    $website_title = 'Администратор';
    require_once(BLOCKS_c. 'head.php'); ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php // require_once(BLOCKS_c. 'header.php'); ?>

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

  <?php require_once(BLOCKS_c. 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <?php
      $sql = "SELECT * FROM `album_arts` ORDER BY `id` DESC";
      $query = $pdo->query($sql);

       ?> 
       <ul>
        <?php 

    while($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                   <li>
                      <a href="" title="<?=$row->id?>"><?=$row->works_title?></a>
                    </li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS_c. 'footer.php'); ?>
  <div class="overlay"></div>
  <script src="../../js/scripts.min.js"></script>
 </body>
</html>