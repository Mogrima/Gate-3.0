<?php require_once('./core/business/session.php');
  require_once('./core/business/appvars.php');
  require_once(BUS.'/pagevars.php');
  require_once(BUS . 'connectvars.php');
  // подключение к базе данных
  require_once(BUS.'/mysql__connect.php')
?>
      <?php
      $book_id = $_GET["id"];
      $n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;

      $sql = "SELECT * FROM `works_catalog` WHERE id = $book_id";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $title = $row->works_title;
      $text = $row->text;
      $lines = explode("</p>", $text);
      $chapterPages = count($lines) - 1;
      $chapters = explode('</chapter>', $text);
      $chapters_count = count($chapters) - 1;

        // получаем массив с страницами
        $page_arr = array();
        $count = (ceil($chapterPages/6)) * 6;
        for($c = 0; $c <= $chapters_count; $c++) {
          $chapters_line = explode("&shy", $chapters[$c]);
          $chapters_line_count = (count($chapters_line) - 1);
          $num_page = ceil($chapters_line_count / 36) * 36;
          for($i = 36, $e = 0; $i <= $num_page; $i = $i + 36, $e = $e + 36) {
              for($w = $e; $w < $i; $w++) {
                $s = $chapters_line[$w];
                $page_x = $page_x . $s;
              }
            
            $page_arr[] = $page_x;
            $page_x = '';
          }
        }

      function counterPage($page_arr, $n) {
        echo $page_arr[$n];
      }
      $numbering = array();
      // function counterContent($page_arr, $numbering) {
        $z = 0;
        foreach ($page_arr as $page) {
          if(preg_match_all('|<h3>(.+)</h3>|isU', $page, $arr)) {
            $titleChapter = $arr[1][0];
          }
          $numbering[$z] = $titleChapter;
          $z++;
        }
        // return $numbering;
      // }
      // print_r($numbering);
      // Сохраняем название главы в переменную
      $nameContent = $numbering[$n];
      
//////////////Нумерация страниц/////////////////////////////////////////////////////////////////
      // счетчик страниц
      $pages = $n + 1;
      $pages_next = $pages + 1;
      $pages_prev = $pages - 1;
/////////////Конец нумерации страниц////////////////////////////////////////////////////////////     
      ?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <title><?=$title?></title>
  <link href="img/favicon.png" rel="apple-touch-icon" sizes="180x180">
  <link href="img/favicon.png" rel="icon" sizes="32x32" type="image/png">
  <link href="img/favicon.png" rel="icon" sizes="16x16" type="image/png">
  <link href="/site.webmanifest" rel="manifest">
  <link color="#5bbad5" href="img/favicon.png" rel="mask-icon">
  <meta content="#da532c" name="msapplication-TileColor">
  <meta content="#ffffff" name="theme-color">
  <link rel="stylesheet" href="css/book.css">
</head>
<body>
	<input type="checkbox" id="content-nav__toggle" hidden>
	<header class="book-header">
		<h1 class="title book-header__title"><?=$title?></h1>
		<a class="link-book link-book--to-back" href="works-catalog.php">К другим книгам</a>
	</header>
			<nav class="content-nav">
				<label for="content-nav__toggle" class="content-nav__toggle" onclick></label>
				<h2 class="content-nav__title">Оглавление</h2>
				<ul class="content-nav__list">
          <?php
          $i = 0;
          $contents = array();
          foreach ($page_arr as $page) {
            if(preg_match_all('|<h3>(.+)</h3>|isU', $page, $arr)) {
              $titleChapter = $arr[1][0];
              $contents[$i] = $titleChapter;
            }
            $i++;
          }
          foreach ($contents as $content => $post) {
            echo "<li class'content-nav__item'><a class='content-nav__link' href='book.php?id=$book_id&amp;n=".$content."'>" . $post . "</a></li>";
            $i++;
          }?>
		        </ul>
		    </nav>
	    <div class="mask-content"></div>
	<main class="book-main">
		<article class="section-book">
			<h2 class="section-book__title"><?=$numbering[$n]?></h2>
			<div class="book-columns">
				<div class="book-columns__column book-columns__column--left">
					<div class="paragraph-wrapper">
					<?php counterPage($page_arr, $n);?>
					</div>
					<div class="number-page"><span><?=$pages?></span></div>
				</div>
				<div class="book-columns__column book-columns__column--right">
					<div class="paragraph-wrapper">
          <?php 
          $n_x = $n + 1;
          counterPage($page_arr, $n_x);?>
					</div>
					<div class="number-page number-page--right"><span><?=++$pages?></span></div>
				</div>
			</div>
			<div class="page-navigation">
        <?php
        if ($n == 0) {
        ?>
        <a class="link-book page-navigation__link" href="book.php?id=<?=$book_id?>&amp;n=<?=++$n_x?>"><span class="visually-hidden">Следующая страница</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><g id="Слой_2" data-name="Слой 2"><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></g></g></svg>
        </a>
        <?php
      }
      else if (count($page_arr) - $n <= 3) {
        $x_2 = $n - 2;
        ?>
        <a class="link-book page-navigation__link page-navigation__link--prev" href="book.php?id=<?=$book_id?>&amp;n=<?=$x_2?>"><span class="visually-hidden">Предыдущая страница</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><g id="Слой_2" data-name="Слой 2"><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></g></g></svg>
        </a>
        <?php
      }
      else {
        $x = $n + 1;
        $x_2 = $n - 2;
        ?>
        <a class="link-book page-navigation__link page-navigation__link--prev" href="book.php?id=<?=$book_id?>&amp;n=<?=$x_2?>"><span class="visually-hidden">Предыдущая страница</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><g id="Слой_2" data-name="Слой 2"><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></g></g></svg>
        </a>
        <a class="link-book page-navigation__link" href="book.php?id=<?=$book_id?>&amp;n=<?=++$n_x?>"><span class="visually-hidden">Следующая страница</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="100" viewBox="0 0 106.5 17.79"><defs><style>.cls-1{fill:#1a172a;}</style></defs><g id="Слой_2" data-name="Слой 2"><g id="Layer_2" data-name="Layer 2"><path class="cls-1" d="M106.1,8.17a.88.88,0,0,0-.5-.17A76.24,76.24,0,0,1,83.65,5.14a42.32,42.32,0,0,1-4.81-1.75,2.14,2.14,0,1,0-3.31.2l0,.05.06,0a.65.65,0,0,0,.17.16h0l.11.06s0,0,0,0A42.37,42.37,0,0,0,87.65,8H19.42a2.5,2.5,0,0,0-4.66,0h-1.3A3.56,3.56,0,0,0,6.57,8H4.83a2.51,2.51,0,1,0,0,1.79H6.57a3.55,3.55,0,0,0,6.89,0h1.3a2.49,2.49,0,0,0,4.66,0H87.65c-8,1.73-11.78,4.1-11.86,4.15a.9.9,0,0,0-.2.19h0l-.06.07a2.15,2.15,0,1,0,3.32.19c3.7-1.63,12.4-4.61,26.76-4.61a1,1,0,0,0,.35-.07.91.91,0,0,0,.55-.82A.89.89,0,0,0,106.1,8.17ZM10,10.68a1.79,1.79,0,1,1,1.75-2.15.91.91,0,0,0-.08.37.86.86,0,0,0,.08.36A1.79,1.79,0,0,1,10,10.68Z"/></g></g></svg>
        </a>
        <?php
      }
        ?>
			</div>
		</article>
	</main>
</body>
</html>