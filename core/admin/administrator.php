<?php
  session_start();
  require_once('../business/appvars.php');
  require_once('../'.BUS.'/connectvars.php');
  // подключение к базе данных
  require_once('../'.BUS.'/mysql__connect.php');
  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    $website_title = 'Администратор';
    require_once '../blocks/head.php' ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once '../blocks/header.php' ?>
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php
        if (!isset($_SESSION['user_id'])) {
            if ($_SESSION['user_id'] != '14') {
            echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
            exit();
            }
          }
          else {
            echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="../logout.php">Log out</a>.</p>');
          }
      ?>
      <a href="/admin/_adNews.php" class="button">Новости</a>
      <a href="/admin/adWorks.php" class="button">Произведения</a>
        <!-- Подложка -->
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>