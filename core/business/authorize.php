<?php
   require_once('appvars.php');
   require_once(BUS . 'connectvars.php');
   // подключение к базе данных
   require_once(BUS.'/mysql__connect.php');

  session_start();
  
  $error_msg = "";

  if(!isset($_SESSION['user_id'])) {

    if(isset($_POST['submit'])) {

    // Получение введеных пользователем данных для аутентификации
      $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
      $password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
      if (!empty($username) && !empty($password)) {
        $password = md5($password);
        // Поиск имени пользователя и его пароля в базе данных
        $sql = 'SELECT `user_id`, `user_email`, `username` FROM `user` WHERE `username` =:username && `password` =:password || `user_email` =:username && `password` =:password';
        $query = $pdo->prepare($sql);
        $query->execute(['username' => $username, 'password' => $password]);
        
        $user = $query->fetch(PDO::FETCH_OBJ);
        if($user->user_id == 0) {
          $error_msg = 'Введенных данных не существует, либо они введены неверно';
        }
        else {
          $user_id = $user->user_id;
          $username = $user->username;
          $_SESSION['user_id'] = $user_id;
          $_SESSION['username'] = $username;
          $_SESSION['user_email'] = $user->user_email;
          setcookie('user_id', $user_id, time() + (60 * 60 * 24 * 30));
          setcookie('username', $username, time() + (60 * 60 * 24 * 30));
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/index.php';
          header('Location: ' . $home_url);
        }
      }
      else {
        // Имя пользователя/его пароль не введены, создание сообщения об ошибке
        $error_msg = 'Для того, чтобы представиться, нужно ввести данные.';
      }
    }

  }
?>