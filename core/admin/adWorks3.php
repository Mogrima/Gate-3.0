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
      <?php require_once(BUS_с. '/adminSession.php'); 
      $n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;
      // $pages = isset($_GET["pages"]) ? (int) $_GET["pages"] : 0;
      $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
      $titleChapterCurrent = isset($_GET["chapter"]) ? (string) $_GET["chapter"] : "";

      // количество статей на страницу
      $on_page = 1;
      // (номер страницы - 1) * статей на страницу
      $shift = ($page - 1) * $on_page;
      $title = 'Истории тысячи миров';

      $sql = "SELECT * FROM `test` WHERE title = 'Истории тысячи миров 2' LIMIT $shift, $on_page";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $text = $row->text;
      $chapter = $row->chapter;
      $lines = explode("</p>", $text);
      $chapterPages = count($lines) - 1;
      $num = $chapterPages - $n;

      $point = "<h2>наташа</h2> ... <h2>даша</h2> ... <h2>настя</h2> ...";
          // var_dump($point);
          if(preg_match_all('|<h2>(.+)</h2>|isU', $point, $arr)) {
            echo "Глава" .$arr[0][0];
          }
      
      
      //////////////////////////////////////////////////////////////
      // получаем общее количество строк
      $stmt = $pdo->query("SELECT COUNT(*) FROM test WHERE title = 'Истории тысячи миров 2'");
      $row = $stmt->fetch();
      $countChapters=$row[0]; //количество строк
      //////////////////////////////////////////////////////////////
      echo "<p style='color: grey'>chapterPages = $chapterPages - кол-во параграфов в главе $chapter.
            <br>n = $n - увеличивается при перелистывании страниц
            <br>num = $num - уменьшается при перелистывании страниц, счетчик оставшихся параграфов
                             которые не были выведены еще.
            <br>page - $page - номер текущей главы.
            <br>количество глав в книге = $countChapters</p>";

      function iterat($n, $num, $lines) {
        global $y;
        global $titleChapter;
        $y = $n;
        $count = 6; // по умолчанию создается внутри ф-ции
        $count += $n; // постепенно наращивается
        echo " $y до итерации равен y. <br>";
        echo " $count до итерации равен count. ";
      
        if ($num < 6) {
          echo "num меньше 6<br>";
          for ($i = $y; $i < $count; $i++) {
            $y = $i;
            echo '<p style="color: red">'.$y.'</p>';
            echo $lines[$i];
          }
        }
        for ($i = $y; $i < $count; $i++) {
          echo $lines[$i];
          $y = $i;
          $chapter = $lines[$i];
          // var_dump($chapter);
          echo '<p style="color: red">'.$y.'</p>';
          if(preg_match_all('|<h2 class="section-book__title">(.+)</h2>|isU', $chapter, $arr)) {
            // echo "Глава" .$arr[0][0];
            $titleChapter = $arr[0][0];
          }
          
        }
        echo " После итерации $y равен y. <br>";
        echo " $count После итерации равен count. ";
        return $y;
      }
      // сохраняем текущее значение $n до функции
      $current_n = $n;
      iterat($n, $num, $lines);
      echo $titleChapter;
      // $titleChapter = $titleChapterCurrent;
      echo $titleChapterCurrent;
      if($titleChapter == '') {
        echo "Привет";
        // $titleChapter = $titleChapterCurrent;
      }
      else {
        echo "Не привет";
      }

      $filename = "history.txt";
     if (file_exists($filename) && is_readable ($filename)) {
  echo 'работает';
  $fp = @fopen($filename, 'r');
  echo 'работает 2';
  if ($fp) {
    echo '<p style="color: red;">'.filesize($filename).'</p>';
    // $lines = str_split_unicode(fread($fp, filesize($filename)), 2360);
    $lines = fread($fp, filesize($filename));
    // var_dump($lines);
    $div = [1, 4, 5, 4];
    var_dump($div);
      // $lines = explode("f", fread($fp, filesize($filename)));
  }
}
else {
  echo 'НЕ работает  1';
}

//       $sContent = "... <h2>наташа</h2> ... <h2>даша</h2> ... <h2>настя</h2> ...";
// if (preg_match_all('|<h2>(.+)</h2>|isU', $lines, $arr)) { 

//   echo $arr[0][0]." ".$arr[0][1]." ".$arr[0][2];
//   echo "<br />";
//   echo $arr[1][0]." ".$arr[1][1]." ".$arr[1][2];

// }

// var_dump($sContent);


      $n = $y + 1;
      $x = $n - 6 * 2;
//////////////Нумерация страниц/////////////////////////////////////////////////////////////////
      // второй sql запрос берет все записи, у который id до текущей, чтобы посчитать
      // кол-во пройденных страниц
      $sql2 = "SELECT * FROM test WHERE `id`< $id";
      $query = $pdo->query($sql2);
      $paragraphs = $query->fetchAll(PDO::FETCH_OBJ);
      $countPage = 0;
      foreach ($paragraphs as $paragraph) {
        $text = $paragraph->text;
        $lines = explode("</div>", $text);
      $countParagraphs = count($lines) - 1;
      // количество страниц прибавляем уже к существующим, это нужно для счетчика страниц
      $countPage += floor($countParagraphs / 6);
      $countPageCurrent = floor($countParagraphs / 6);
      }
      // счетчик страниц
      $pages = (($y + 1) / 6) + $countPage;
      $pages_next = $pages + 1;
      $pages_prev = $pages - 1;
/////////////Конец нумерации страниц////////////////////////////////////////////////////////////     

      if ($num <= 6) {
        echo "<p style='color:violet'>Условие 4 $countPage $countPageCurrent</p>";
        $miniVar = 0;
        $d_page = $page + 1;
        echo "<a href='adWorks3.php?n=".$miniVar."&amp;page=".$d_page."'>Вперед на ". $pages_next ." страницу</a> ";
        $n = $n - 6 * 2;
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".$page."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      else if ($num > 6 && $pages != 1 && $current_n != 0) {
        echo "<p style='color:violet'>Условие 3 $countPage $countPageCurrent</p>";
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".$page."&amp;chapter=".$titleChapter."'>Вперед на ". $pages_next ." страницу</a> ";
        $n = $n - 6 * 2;
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".$page."&amp;chapter=".$titleChapter."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      else if ($current_n >= 0 && $pages = 1) {
        echo "<p style='color:violet'>Условие 1</p>";
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".$page."&amp;chapter=".$titleChapter."'>Вперед на ". $pages_next ." страницу</a> ";
      }
      else if ($current_n >= 0 && $page != 1) {
        echo "<p style='color:violet'>Условие 2 $countPage $countPageCurrent</p>";
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".$page."'>Вперед на ". $pages_next ." страницу</a> ";
        echo "<a href='adWorks3.php?n=".$n."&amp;page=".--$page."'>Назад на ". $pages_prev ." страницу</a> ";
      }
      echo " Текущая страница $pages";
      ?>

<h3>Содержание</h3>
<?php
$sql = "SELECT * FROM `test` WHERE title = 'Истории тысячи миров'";
$query = $pdo->query($sql);
$contents = $query->fetchAll(PDO::FETCH_OBJ);
$i = 0;
foreach ($contents as $content) {
  if ($comment->id == $id) {
    // echo "текущее произведение страниц $textid = $i";
    // return $i;
  }
  $i++;
$n = 0;
$count = 0;
echo "<h3><a href='adWorks2.php?page=".$i."&amp;n=".$n."'>" . $content->chapter . "</a></h3>";
}
?>
      <a href="administrator.php" class="button">Назад</a>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>