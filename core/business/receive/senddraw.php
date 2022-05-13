<?php
 require_once('../appvars.php');
 require_once('../connectvars.php');
 // подключение к базе данных
 require_once('../mysql__connect.php');
  if(isset($_POST['submit'])) {
    // Извлечение данных профиля из суперглобального массива $_POST
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $album = (int)trim(filter_var($_POST['album_list'], FILTER_SANITIZE_STRING));
    $ill_of_books = (trim(filter_var($_POST['ill_of_books'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $b_a_w = (trim(filter_var($_POST['b_a_w'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $color = (trim(filter_var($_POST['color'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $history = (trim(filter_var($_POST['history'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $image = 'dsds';
    var_dump($ill_of_books);

    if(!empty($title) && !empty($album)) {
      
              $sql = "INSERT INTO album_arts(album_id, works_title, works_image, ill_of_books, b_a_w, color, history) VALUES('$album', '$title', '$image', '$ill_of_books', '$b_a_w', '$color', '$history')";
echo $sql;
              $query = $pdo->prepare($sql);
              $query->execute([$album, $title, $image, $ill_of_books, $b_a_w, $color, $history]);
              
              // $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/index.php';
              // header('Location: ' . $home_url);
    }
    else {
      echo "<p class='attention attention--reg-page'>Вы заполнили не все поля, либо указали данные неверно. Не получается зарегистрироваться? Напишите нам: <a class='link link--profile' href='mailto:VRATAproject@yandex.ru'>VRATAproject@yandex.ru</a></p>";
    }
  }
 ?>