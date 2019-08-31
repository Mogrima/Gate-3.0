<?php require_once('../business/session.php');
if(isset($_POST['submit'])) {
    // Прописываем переменные из данных форм и фильтруем их от ненужных символов
  $news_title = trim(filter_var($_POST['news_title'], FILTER_SANITIZE_STRING));
  $news_intro = trim(filter_var($_POST['news_intro'], FILTER_SANITIZE_STRING));
  $news_text = trim(filter_var($_POST['news_text'], FILTER_SANITIZE_STRING));

  require_once('../business/appvars.php');
    require_once('../'.BUS.'/mysql__connect.php');
  
  // $error = '';
  
  // if(strlen($title) <= 3) {
  //     $error = 'Введите название статьи'; }
  // else if(strlen($intro) <= 15) {
  //         $error = 'Введите интро для статьи'; }
  // else if(strlen($text) <= 20) {
  //     $error = 'Введите текст статьи'; }
  
  // если переменная error не пустая, то передаем ее через echo в ajax запрос и выходим из программы
  // if($error != '') {
  //     echo $error;
  //     exit();
  // }
  
  // sql - запрос на внесение данных в таблицу
  
  $sql = "INSERT INTO news(date, title, intro, text, author) VALUES(NOW(), ?, ?, ?, ?)";
  // $data = mysqli_query($dbc, $sql);
  
  // if ($data) {
  //     echo 'Вы успешно зарегистрирвались';
  // }
  
  // else {
  //     echo 'данные не были отправлены';
  // }
  // подготовка запроса
  $query = $pdo->prepare($sql);
  // выполнение запроса
  $query->execute([$news_title, $news_intro, $news_text, $_SESSION['username']]);
  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/_adNews.php';
                header('Location: ' . $home_url);
                die('Переадресация не состоялась.');
  // echo 'OK';
  // mysqli_close($dbc);
  }
  ?>