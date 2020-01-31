<?php require_once('session.php');
require_once('appvars.php');
require_once('connectvars.php');
// подключение к базе данных
require_once(BUS.'/mysql__connect.php');
  if(isset($_POST['submit'])) {
    if($_POST['reviews'] != '') {
      if(mb_strlen($_POST['reviews'], 'utf-8') <= 600) {
        $username = $_SESSION['username'];
        $mess = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
        $article_id = $_GET["id"];
        $page = $type;

        $sql = "INSERT INTO comments(page, author, comment, article_id) VALUES('$page', '$username', '$mess', '$article_id')";
        $query = $pdo->prepare($sql);
        $query->execute(['page' => $page, 'username' => $username, 'mess' => $mess, 'article_id' => $article_id]);
        $query->execute(['username' => $username, 'password' => $password]);
        $user_msg = 'Данные отправлены!';
      }
      else {
        $user_msg = 'Количество введенных символов превышает 300 знаков';
      }
  }
  else { 
    $user_msg = 'Напишите комментарий';
  }
  }
?>