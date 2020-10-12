<?php
//  require_once('appvars.php');
 require_once('connectvars.php');
require_once('mysql__connect.php');
$succeful = false;
  // if(isset($_POST['submit'])) {
    $reviews = trim(filter_var($_POST['reviews'], FILTER_SANITIZE_STRING));
    $user = trim(filter_var($_POST['user'], FILTER_SANITIZE_STRING));
    $article_id = trim(filter_var($_POST['article_id'], FILTER_SANITIZE_STRING));
    $author_id = trim(filter_var($_POST['author_id'], FILTER_SANITIZE_STRING));
    if(!empty($reviews)) {
      if(mb_strlen($reviews, 'utf-8') <= 600) {

        // echo $user . '<br>';
        // echo $author_id . '<br>';
        // echo $reviews . '<br>';
        // echo $article_id;
        $comments_table = 'comments_art';
        $sql = "INSERT INTO $comments_table(author, author_id, comment, article_id) VALUES('$user', '$author_id', '$reviews', '$article_id')";
        $query = $pdo->prepare($sql);
        $query->execute(['user' => $user, 'author_id' => $author_id, 'reviews' => $reviews, 'article_id' => $article_id]);
        $user_msg = 'Ваше впечатление опубликовано';
        $succeful = true;
        echo 'Ваше впечатление опубликовано';
        // $home_url = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $_SERVER["REQUEST_URI"];
        // header('Location: ' . $home_url);
        // $user_msg = $home_url;
      }
      else {
        $user_msg = 'Ваш отзыв превысил 600 знаков';
        echo 'Ваш отзыв превысил 600 знаков';
      }
  }
  else { 
    $user_msg = 'Вы ничего не написали';
    echo 'Вы ничего не написали';
    }

    // $user_msg = 'Было нажато submit';
    // echo 'Было нажато submit';
  //} // else {
    //  echo 'submit';
   //}
?>