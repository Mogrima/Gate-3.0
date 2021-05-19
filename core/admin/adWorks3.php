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
    $website_title = 'Произведения';
    require_once '../blocks/head.php' ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php // require_once '../blocks/header.php' ?>
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <div>
      <?php require_once(BUS_с. '/adminSession.php'); 
      $n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;

      $sql = "SELECT * FROM `works_catalog` WHERE works_title = 'Сборник стихов «Компас ветров»'";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $text = $row->text;
      $lines = explode("</p>", $text);
      $chapterPages = count($lines) - 1;
      $chapters = explode("</chapter>", $text);
      $chapters_count = count($chapters) - 1;

      $transformed_text = wordwrap($text, 130, "	&shy\n");
      var_dump($transformed_text);

        // получаем массив с страницами
        $page_arr = array();
        $count = (ceil($chapterPages/6)) * 6;
        for($c = 0; $c <= $chapters_count; $c++) {
          $chapters_line = explode("</p>", $chapters[$c]);
          $chapters_line_count = (count($chapters_line) - 1);
          $num_page = ceil($chapters_line_count / 6) * 6;
          echo  "<br> $chapters_line_count - кол-во параграфов и $num_page - кол-во страниц и $c - номер итерации";
          for($i = 6, $e = 0; $i <= $num_page; $i = $i + 6, $e = $e + 6) {
              for($w = $e; $w < $i; $w++) {
                $s = $chapters_line[$w];
                $page_x = $page_x . $s;
              }
            
            $page_arr[] = $page_x;
            $page_x = '';
          }
        }
        // for($i = 6, $e = 0; $i <= $count; $i = $i + 6, $e = $e + 6) {
        //   for($w = $e; $w < $i; $w++) {
        //     $s = $lines[$w];
        //     $page_x = $page_x . $s;
        //   }
        //   $page_arr[] = $page_x;
        //   $page_x = '';
        // }
        // print_r($page_arr);
      //////////////////////////////////////////////////////////////
      echo "<p style='color: grey'>chapterPages = $chapterPages - кол-во параграфов.
            <br>n = $n
            <br>".count($page_arr)." - количество страниц
            <br> $chapters_count - количество глав</p>";
      
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
      // counterPage($page_arr, $n);
//////////////Нумерация страниц/////////////////////////////////////////////////////////////////
      // счетчик страниц
      $pages = $n + 1;
      $pages_next = $pages + 1;
      $pages_prev = $pages - 1;
/////////////Конец нумерации страниц////////////////////////////////////////////////////////////     
      if ($n == 0) {
        echo "<a href='adWorks3.php?n=".++$n."'>Вперед на ". $pages_next ." страницу</a> ";
      }
      else if (count($page_arr) - $n == 1) {
        echo "<a href='adWorks3.php?n=".--$n."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      else {
        $x = $n + 1;
        echo "<a href='adWorks3.php?n=".$x."'>Вперед на ". $pages_next ." страницу</a> ";
        echo "<a href='adWorks3.php?n=".--$n."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      echo " Текущая страница $pages";
      ?>

<h3>Содержание</h3>
<?php
echo "<br> Текущая глава $nameContent";
// Два цикла. 1 - создает массив с названиям глав и номерами их первых страниц
// 2 - перебирает первый массив и выводит содержание по главам с ссылками
$i = 0;
$contents = array();
foreach ($page_arr as $page) {
  if(preg_match_all('|<h3>(.+)</h3>|isU', $page, $arr)) {
    $titleChapter = $arr[1][0];
    $contents[$i] = $titleChapter;
  }
  $i++;
}
// print_r($contents);
foreach ($contents as $content => $post) {
  echo "<h3><a href='adWorks3.php?n=".$content."'>" . $post . "</a></h3>";
  $i++;
}
?>
      <a href="administrator.php" class="button">Назад</a>
      </div>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>