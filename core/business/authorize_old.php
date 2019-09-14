<?php
  require_once('connectvars.php');

  session_start();
  
  $error_msg = "";

  if(!isset($_SESSION['user_id'])) {

    if(isset($_POST['submit'])) {
      // Соединение с базой данных
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    // Получение введеных пользователем данных для аутентификации
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
      if (!empty($user_username) && !empty($user_password)) {
        // Поиск имени пользователя и его пароля в базе данных
        $query = "SELECT user_id, user_email, username FROM user WHERE username = '$user_username' OR user_email = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);
        if (mysqli_num_rows($data) == 1) {
          // Процедура входа прошла нормально, сохранение в куки имени пользователя и его пароль
          // Переход на главную страницу
          $row = mysqli_fetch_array($data);
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          $_SESSION['user_email'] = $row['user_email'];
          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30)); // срок действия 30 дней 
          setcookie('username', $row['username'], time() + (60 * 60 * 24 * 30)); // срок действия 30 дней
          // Переадресация на главную страницу
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/index.php';
          header('Location: ' . $home_url);
        }
        else {
          // Имя пользователя/его пароль введены неверно, создание сообщения об ошибке
          $error_msg = 'Извините, для того чтобы войти в приложение, вы должны ввести правильное имя и пароль';
        }
      }
      else {
        // Имя пользователя/его пароль не введены, создание сообщения об ошибке
        $error_msg = 'Извините, для того чтобы войти в приложение, вы должны ввести имя и пароль';
      }
    }

  }
?>