<?php
  require_once('appvars.php');
  require_once(BUS . 'connectvars.php');
  // подключение к базе данных
  require_once(BUS.'/mysql__connect.php');
  if(isset($_POST['submit'])) {
    // Извлечение данных профиля из суперглобального массива $_POST
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = trim(filter_var($_POST['userpass'], FILTER_SANITIZE_STRING));
    $password2 = trim(filter_var($_POST['userpass2'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL));

    if(!empty($username) && !empty($password) && !empty($email) && ($password == $password2)) {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE username=?");
      $stmt->execute(array($username));
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $username_count = $row["count"];
      }
      if ($username_count > 0) {
         echo "<p class='attention attention--modal'>Это имя уже кем-то занято</p>";
      }
      else {
        $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE user_email=?");
        $stmt->execute(array($email));
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          $email_count = $row["count"];
          if ($email_count > 0) {
            echo "<p class='attention attention--modal'>Этот адрес электронной почты уже используется</p>";
          }
          else {
            $password = md5($password);
            $sql = "INSERT INTO user(username, user_email, password) VALUES('$username', '$email', '$password')";
            $query = $pdo->prepare($sql);
            $query->execute([$username, $email, $password]);
            echo "Вы успешно зарегистрировались! Теперь вы можете <a class='link link--profile' href='login.php'>представиться</a>";
            exit();
          }
        }
      }
    }
    else {
      echo "<p class='attention attention--modal'>Вы заполнили не все поля, либо указали данные неверно. Не получается зарегистрироваться? Напишите нам: <a class='link link--profile' href='mailto:VRATAproject@yandex.ru'>VRATAproject@yandex.ru</a></p>";
    }
  }
 ?>
