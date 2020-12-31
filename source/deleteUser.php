<?php require_once('./core/business/session.php'); require_once('./core/business/appvars.php');
require_once(BUS . 'connectvars.php');
require_once(BUS.'/mysql__connect.php');?>
<?php
    if (!isset($_SESSION['user_id'])) {
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/login.php';
      header('Location: ' . $home_url);
    } else {
      $session_id = $_SESSION['user_id'];
      $userquery = "SELECT avatar FROM user WHERE `user_id` = :session_id";
      $userData = $pdo->prepare($userquery);
      $userData->execute([':session_id' => $session_id]);
         while($row = $userData->fetch(PDO::FETCH_OBJ)) {
             $avatar = $row->avatar;
        }
      }

    if (isset($_POST['submit'])) {
    $deleteAvatar = "delete.jpg";
    $sql = "DELETE FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";

    $query = $pdo->prepare($sql);
    $query->execute([$session_id]);

    $sql = "UPDATE comments_book SET dead = '$deleteAvatar' WHERE author_id = '" . $_SESSION['user_id'] . "'
            UNION
            UPDATE comments_art SET dead = '$deleteAvatar' WHERE author_id = '" . $_SESSION['user_id'] . "'";
    
    $query = $pdo->prepare($sql);
    $query->execute([$deleteAvatar, $session_id]);

    if($avatar != 'default.png' && $avatar != 'delete.jpg') {
      @unlink(MM_UPLOADPATH . $avatar);
    }

    $_SESSION = array();
    setcookie(session_name(), '', time() - 3600);
    session_destroy();
    setcookie('user_id', '', time() - 3600);
    setcookie('username', '', time() - 3600);

    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/index.php';
    header('Location: ' . $home_url);

    $pdo = null;
    }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    $website_title = 'Удаление профиля';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>

<body class="page">
  <div class="background-header"></div>
  <header class="page-header">
      <div class="page-header__wrapper">
        <a href="index.php" class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54" src="img/Logo.png"></a>
        <nav class="profile-menu profile-menu--nojs">
          <button class="profile-menu__button" type="button">
              <img class="profile-menu__icon" src="./img/user/<?php echo $avatar?>" width="70" height="70" alt="меню пользователя">
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
      </div>
    </header>
  <?php require_once BLOCKS .'main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title">Удаление профиля <?php echo ''.$_SESSION['username'].'' ?></h1>
          <?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <p class="page-description page-description--flex">Вы уверены, что хотите удалить свой профиль? Восстановить
        его будет невозможно.</p>
        <form class="form-settings profile__delete-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <a class="button works__button profile__delete-btn" href="./user.php">Нет, вернуться</a>
        <button class="button works__button profile__delete-btn" type="submit" value="enter" name="submit">Да, удалить</button>
        </form>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS . 'scripts-include.php'); ?>
</body>

</html>
