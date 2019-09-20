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
<?php
    $website_title = 'Новости';
    require_once '../blocks/head.php' ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once '../blocks/header.php' ?>
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <a href="/admin/administrator.php" class="button">Назад</a>
      <form class="form-addnews" action="submitNews.php" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> -->
        <label for="news_title">Название новости</label>
        <input class="input input__title" id="news_title" type="text" name="news_title" value="<?php if(!empty($title)) echo $title; ?>">
        <label for="news_intro">Превью новости</label>
        <textarea class="input input__preview" id="news_intro" type="text" name="news_intro"><?php if(!empty($preview)) echo $preview; ?></textarea>
        <label for="news-text">Текст новости</label>
        <textarea class="input news_text" id="news_text" type="text" name="news_text"><?php if(!empty($text)) echo $text; ?></textarea>
        <!-- <label for="screenshot">Файл изображения:</label>
        <input class="input" id="screenshot" type="file" name="screenshot"> -->
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
        <a class="button addnews-button" href="index.php">на главную</a>
        </form>
        <h2>Все новости</h2>
        <?php

        $sql = 'SELECT * FROM `news` ORDER BY `date` DESC';
        $query = $pdo->query($sql);
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo "<h2>$row->title</h2>
                  <p>$row->intro</p>
                  <p><b>Автор статьи: </b><mark>$row->author</mark></p>
                  <p><time>$row->date</time></p>
                  <a class='btn btn-warning mb-5'>Прочитать больше</a>";
        }
        ?>
      </div>
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>