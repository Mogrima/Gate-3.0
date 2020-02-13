<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
<?php
    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    $massage = trim(filter_var($_POST['massage'], FILTER_SANITIZE_STRING));

  $to = 'VRATAproject@yandex.ru';
  $subject = 'Обратная связь с сайта';
  $msg = "$name отправил(а) следующее обращение:\n" .
    "$massage";
  mail($to, $subject, $msg, 'From:' . $email);
?>
</body>

</html>
