<?php
$succeful = false;
  if(isset($_POST['submit'])) {
    if($_POST['reviews'] != '') {
      if(mb_strlen($_POST['reviews'], 'utf-8') <= 600) {
        $username = $_SESSION['username'];
        $mess = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
        $article_id = $_GET["id"];

        $sql = "INSERT INTO $comments_table(author, comment, article_id) VALUES('$username', '$mess', '$article_id')";
        $query = $pdo->prepare($sql);
        $query->execute(['username' => $username, 'mess' => $mess, 'article_id' => $article_id]);
        $user_msg = 'Ваше впечатление опубликовано';
        $succeful = true;
      }
      else {
        $user_msg = 'Ваш отзыв превысил 600 знаков';
      }
  }
  else { 
    $user_msg = 'Вы ничего не написали';
    }
  }
?>