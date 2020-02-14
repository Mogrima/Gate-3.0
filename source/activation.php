<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Подтверждение аккаунта';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');
    $activation = $_GET["activation"];?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <?php
        if(!empty($activation)) {
          $sql = "UPDATE users SET status='1' WHERE activation='$activation' AND status='0'";
          $query = $pdo->prepare($sql);
          $query->execute([$activation]);
          ?>
          <p class="attention attention--user_msg attention--succeful-comment">Ваша почта подтверждена. Регистрация завершена успешно.</p>
       <?php }
        ?>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>

</html>
