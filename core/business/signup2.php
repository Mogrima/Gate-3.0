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
      // Проверка того, что никто из уже зарегистрированных пользователей не пользуется таким же именем,
      // как то, которое ввел новый пользователь
      $sql = "SELECT * FROM user WHERE `username` = ? OR `user_email` = ?";
      $data = $pdo->prepare($sql);
      $data->execute([$username, $email]);
      $query = $data->fetch(PDO::FETCH_OBJ);
      $name = $query->usename;
      $dataemail = $query->user_email;
      if(($name != $username) && ($dataemail != $email)) {
        echo "Блаблабла";
      }
      else {
        echo "Все нормально";
      }
    }
  }
 ?>