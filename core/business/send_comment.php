<?php
$succeful = false;
  if(isset($_POST['submit'])) {
    $captcha;
  if(!empty($_POST['token'])) {
    $captcha = $_POST['token'];
  }

  $url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LfJljAaAAAAAFIhLmC7P3TuzFd0UkrjWiqYx_DG&response=' . $captcha;

  $response = file_get_contents($url);
  $responseKey = json_decode($response, true);
  header('Content-type: application/json');

  if($responseKey['success'] && $responseKey['score'] >= 0.5){
    if($_POST['reviews'] != '') {
      if(mb_strlen($_POST['reviews'], 'utf-8') <= 600) {
        $username = $_SESSION['username'];
        $mess = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
        $article_id = $_GET["id"];
        $author_id = $_SESSION['user_id'];

        $sql = "INSERT INTO $comments_table(author, author_id, comment, article_id) VALUES('$username', '$author_id', '$mess', '$article_id')";
        $query = $pdo->prepare($sql);
        $query->execute(['username' => $username, 'author_id' => $author_id, 'mess' => $mess, 'article_id' => $article_id]);
        $user_msg = 'Ваше впечатление опубликовано';
        $succeful = true;
        // $err_info =$query->errorInfo();
        // var_dump($err_info);
      }
      else {
        $user_msg = 'Ваш отзыв превысил 600 знаков';
      }
  }
  else { 
    $user_msg = 'Вы ничего не написали';
    }
  } else {
     $user_msg = 'Валидация на проверку капчи на стороне сервера не прошла';
  }
  }
?>