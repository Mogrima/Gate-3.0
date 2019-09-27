<?php
  require_once('appvars.php');
  require_once(BUS . 'connectvars.php');
  // подключение к базе данных
  require_once(BUS.'/mysql__connect.php');
  session_start();
  if(isset($_POST['submit'])) {
    // Извлечение данных профиля из суперглобального массива $_POST
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = trim(filter_var($_POST['userpass'], FILTER_SANITIZE_STRING));
    $password2 = trim(filter_var($_POST['userpass2'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL));

    if(!empty($username) && !empty($password) && !empty($email)) {
      if($password == $password2) {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE username=?");
        $stmt->execute(array($username));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $username_count = $row["count"];
        }
        if ($username_count > 0) {
           echo "<p class='attention attention--reg-page'>Это имя уже кем-то занято</p>";
        }
        else {
          $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE user_email=?");
          $stmt->execute(array($email));
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $email_count = $row["count"];
            if ($email_count > 0) {
              echo "<p class='attention attention--reg-page'>Этот адрес электронной почты уже используется</p>";
            }
            else {
              $password = md5($password);
              $sql = "INSERT INTO user(username, user_email, password) VALUES('$username', '$email', '$password')";
              $query = $pdo->prepare($sql);
              $query->execute([$username, $email, $password]);
             
  
              $sql = 'SELECT `user_id`, `user_email`, `username` FROM `user` WHERE `username` =:username || `user_email` =:username && `password` =:password';
              $query = $pdo->prepare($sql);
              $query->execute(['username' => $username, 'password' => $password]);
  
              $user = $query->fetch(PDO::FETCH_OBJ);
  
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
        }
      }
      else {
        echo "<p class='attention attention--reg-page'>Повтор пароля введён не верно</p>";
      }
    }
    else {
      echo "<p class='attention attention--reg-page'>Вы заполнили не все поля, либо указали данные неверно. Не получается зарегистрироваться? Напишите нам: <a class='link link--profile' href='mailto:VRATAproject@yandex.ru'>VRATAproject@yandex.ru</a></p>";
    }
  }
 ?>
