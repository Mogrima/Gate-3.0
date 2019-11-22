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
  <?php require_once '../blocks/header.php' ?>
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <div>
      <?php require_once(BUS_с. '/adminSession.php'); 
      $n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;
      $titleChapterCurrent = isset($_GET["chapter"]) ? (string) $_GET["chapter"] : "";

      $title = 'Истории тысячи миров';

      $sql = "SELECT * FROM `test` WHERE title = 'Истории тысячи миров 2'";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $text = $row->text;
      $chapter = $row->chapter;
      $lines = explode("</p>", $text);
      $chapterPages = count($lines) - 1;
      $num = $chapterPages - $n;

        // получаем массив с страницами
        $page_arr = array();
        $count1 = (ceil($chapterPages/6)) * 6;
        for($i = 6, $e = 0; $i <= $count1; $i = $i + 6, $e = $e + 6) {
          // echo $i . "<br>";
          for($w = $e; $w < $i; $w++) {
            // $page_x = '';
            $s = $lines[$w];
            $page_x = $page_x . $s;
          }
          $page_arr[] = $page_x;
          $page_x = '';
        }
        // print_r($page_arr);
      //////////////////////////////////////////////////////////////
      echo "<p style='color: grey'>chapterPages = $chapterPages - кол-во параграфов в главе $chapter.
            <br>n = $n - увеличивается при перелистывании страниц
            <br>num = $num - уменьшается при перелистывании страниц, счетчик оставшихся параграфов
                             которые не были выведены еще.
            <br>page - $page - номер текущей главы.
            <br>количество глав в книге = $countChapters
            <br>".$contents['***'][1]."
            <br>".count($page_arr)." - количество страниц</p>";
      
      function counterPage($page_arr, $n) {
        echo $page_arr[$n];
      }
      $numbering = array();
      // function counterContent($page_arr, $numbering) {
        $z = 0;
        foreach ($page_arr as $page) {
          if(preg_match_all('|<h2 class="section-book__title">(.+)</h2>|isU', $page, $arr)) {
            // echo "Глава" .$arr[0][0];
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
      counterPage($page_arr, $n);
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
        echo "<a href='adWorks3.php?n=".--$n."&amp;chapter=".$titleChapter."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      else {
        $x = $n + 1;
        echo "<a href='adWorks3.php?n=".$x."&amp;chapter=".$titleChapter."'>Вперед на ". $pages_next ." страницу</a> ";
        echo "<a href='adWorks3.php?n=".--$n."&amp;chapter=".$titleChapter."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      echo " Текущая страница $pages";
      ?>

<h3>Содержание</h3>
<?php
echo "<br> Текущая глава $nameContent";
$i = 0;
$contents = array();
foreach ($page_arr as $page) {
  if(preg_match_all('|<h2 class="section-book__title">(.+)</h2>|isU', $page, $arr)) {
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