<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    $website_title = 'Страница не найдена';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <style>
      html {
        max-height: 1450px;
        overflow: hidden;
      }
      body {
        padding-left: 20px;
        padding-right: 10px;
        font-family: "Book Antiqua", "Times New Roman", sans-serif;
        color: #fffefe;
      }
      h1 {
        font-weight: normal;
      }

      p {
        font-size: 18px;
      }

      a {
        font-family: "Book Antiqua", "Times New Roman", sans-serif;
        color: #fffefe;
        border-bottom: 2px solid #fffefe;
      }

      @media (min-width: 768px) {
        body {
          padding-left: 182px;
          padding-right: 20px;
          letter-spacing: 3px;
        }

        h1 {
          margin-top: 40px;
          font-size: 40px;
        }
      }

      @media (min-width: 1200px) {
        body {
          padding-left: 382px;
          font-size: 24px;

        }

        h1 {
          margin-top: 80px;
          font-size: 55px;
        }
      }
    </style>
</head>

<body class="page page--404">
  <h1>404 - Путь потерян</h1>
  <p>Ссылка по которой вы перешли <br> сломана, либо не существует.</p>
  <a href="./index.php">Возвращайтесь назад...</a>
</body>

</html>
