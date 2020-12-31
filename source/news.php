<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $id = $_GET["id"];
    $page = $_GET["page"];
    $sql = "SELECT * FROM `news` WHERE id = $id";
    $result = $pdo->query($sql);
    $row = $result->fetch(PDO::FETCH_OBJ);
    $title = $row->title;
    $text = $row->text;
    $news_img = $row->screenshot;
    $date = $row->date;
    $date = date('d-m-Y', strtotime($date));
    $website_title = "$title";
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');
    ?>
</head>

<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!-- Подложка -->
        <?php require_once BLOCKS .'search-block.php' ?>
        <arcticle class="article">
          <div class="article__body">
            <img class='article__picture' alt='Рисунок новости' src='img/news/<?=$news_img?>' width='214'>
            <h1 class="article__title"><?=$title?></h1>
            <p class='article__text'><?=$text?></p>
            <p class="attention attention--msg attention--succeful-comment">
            <b>Присоединяйтесь к обсуждению в соц.сети:</b>
            <a href="https://vk.com/gate_art_project" target="_blank"><span class="visually-hidden">Вконтакте</span> 
              <svg aria-hidden="true" data-icon="vk" data-prefix="fab" height="44" role="img" viewbox="0 0 576 512" width="44" xmlns="http://www.w3.org/2000/svg">
                <path class="icon-color icon-color--dark" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" fill="currentColor"></path>
              </svg>
            </a>
          </p>
          </div>
          <div class='article__footer'>
            <a class="article__to-back" href="index.php?page=<?=$page?>#news"><span class="visually-hidden">Назад</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></svg>
          </a>
            <time class='article__date' datetime='2016-01-11'><?=$date?></time>
            
          </div>

        </arcticle>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>

</html>
