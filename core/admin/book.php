<?php require_once('../business/session.php');
  require_once('../business/appvars.php');
  require_once(BUS_с. '/pagevars_c.php');
  require_once(BUS_с. 'connectvars.php');
  // подключение к базе данных
  require_once(BUS_с. 'mysql__connect.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="robots" content="noindex, nofollow"/>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="format-detection" content="telephone=no">
  <title>Книга</title>
  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-32x32.png">
  <link rel="manifest" href="favicon/site.webmanifest">
  <link rel="mask-icon" href="favicon/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <link rel="stylesheet" href="./book.css">
  <?php
  $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;

  // количество статей на страницу
  $on_page = 1;
  
  // (номер страницы - 1) * статей на страницу
  $shift = ($page - 1) * $on_page;
  
  $sql = "SELECT * FROM `test` LIMIT $shift, $on_page";
  $result = $pdo->query($sql);
  
  // выводим заголовок и контент
  foreach ($result as $row) {
      echo "<h1>" . $row["title"] . "</h1>";
      echo "<p>" . $row["text"] . "</p>";
  }

  echo "<a href='book.php?page=".++$page."'>Вперед на ". $page ." страницу</a> ";

if ($page > 2) {
  --$page;
  echo "<a href='book.php?page=".--$page."'>Назад на ". $page ." страницу</a> ";
}
  ?>
</head>
