<?php
$succeful = false;
  if(isset($_POST['submit'])) {
    if($_POST['reviews'] != '') {
      if(mb_strlen($_POST['reviews'], 'utf-8') <= 600) {
        $username = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
        $mess = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
        echo $username, $email, $mess;

        $sql = "INSERT INTO reviews(author, email, comment) VALUES('$username', '$email', '$mess')";
        $query = $pdo->prepare($sql);
        $query->execute(['username' => $username, 'email' => $email, 'mess' => $mess]);
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