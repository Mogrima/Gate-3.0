<?php require_once('./core/business/session.php'); require_once('./core/business/appvars.php');
require_once(BUS . 'connectvars.php');
require_once(BUS.'/mysql__connect.php');?>
<?php
    if (!isset($_SESSION['user_id'])) {
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/login.php';
      header('Location: ' . $home_url);
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
  <?php require_once BLOCKS .'header.php';?>
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
