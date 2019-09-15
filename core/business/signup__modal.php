<?php
   require_once('appvars.php');
   require_once('../business/connectvars.php');
   // подключение к базе данных
  require_once('../business/mysql__connect.php');
  // Извлечение данных профиля из суперглобального массива $_POST
  $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
  $password = trim(filter_var($_POST['userpass'], FILTER_SANITIZE_STRING));
  $password2 = trim(filter_var($_POST['userpass2'], FILTER_SANITIZE_STRING));
  $email = trim(filter_var($_POST['useremail'], FILTER_SANITIZE_EMAIL));

  // echo $username . '<br>';
  // echo $password . '<br>';
  // echo $password2 . '<br>';
  // echo $email;

  if(!empty($username) && !empty($password) && !empty($email) && ($password == $password2)) {
    $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE username=?");
    $stmt->execute(array($username));
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $username_count = $row["count"];
    }
    if ($username_count > 0) {
        echo "Это имя уже кем-то занято";
    }
    else {
      $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM `user` WHERE user_email=?");
      $stmt->execute(array($email));
      while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $email_count = $row["count"];
        if ($email_count > 0) {
          echo "Этот адрес электронной почты уже используется";
        }
        else {
          $password = md5($password);
          $sql = "INSERT INTO user(username, user_email, password) VALUES('$username', '$email', '$password')";
          $query = $pdo->prepare($sql);
          $query->execute([$username, $email, $password]);
          // echo "Вы успешно зарегистрировались! Теперь вы можете <a href='login.php'>представиться</a>";
          exit();
        }
      }
    }
  }
  else {
    echo "Вы оставили какие-то поля пустыми или пароли не совпадают. Если возникают ошибки с регистрацией, пожалуйста, напишите нам: VRATAproject@yandex.ru";
  }
 ?>
