<?php
    require_once('appvars.php');
    require_once('connectvars.php');
  
     // Соединение с базой данных
     $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
     
     if(isset($_POST['submit'])) {
         // Извлечение данных профиля из суперглобального массива $_POST
         $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
         $password = mysqli_real_escape_string($dbc, trim($_POST['userpass']));
         $password2 = mysqli_real_escape_string($dbc, trim($_POST['userpass2']));
         $email = mysqli_real_escape_string($dbc, trim($_POST['useremail']));
  
         if(!empty($username) && !empty($password) && !empty($email) && ($password == $password2)) {
             // Проверка того, что никто из уже зарегистрированных пользователей не пользуется таким же именем,
             // как то, которое ввел новый пользователь
  
             $query = "SELECT * FROM user WHERE username = '$username' OR user_email = '$email'";
             $data = mysqli_query($dbc, $query);
             $row = mysqli_fetch_array($data);
             if (mysqli_num_rows($data) == 0) {
                 // Имя, введеное пользователем, не используется, поэтому добавляем данные в базу
                 $query = "INSERT INTO user (username, password, user_email) VALUES ('$username', SHA('$password'), '$email')";
                  mysqli_query($dbc, $query);
  
                  // Вывод подтверждения пользователю
                  echo '<p>Ваша учетная запись успешно создана. Вы можете войти в приложение и <a href="index.php">отредактировать свой профиль</a>.</p>';
  
                  mysqli_close($dbc);
                  exit();
             }
             // Учетная запись с таким именем уже существует в базе данных, поэтому выводится сообщение об ошибке
             else {
                 if ($row['username'] == $username) {
                    echo '<p class="error">Учетная запись с таким именем уже существует. Введите, пожалуйста, другое имя.</p>';
                    $username = "";
                 }
                 else {
                    echo '<p class="error">Учетная запись с такой электронной почтой уже существует. Введите, пожалуйста, другую почту.</p>';
                 }
             }
         }
         else {
             echo '<p class="error">Вы должны ввести все данные для создания учетной записи, в том числе пароль дважды</p>';
  
         }
     }
     
     mysqli_close($dbc);
  ?>