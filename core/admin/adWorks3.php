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

      // $point = "<h2>наташа</h2> ... <h2>даша</h2> ... <h2>настя</h2> ...";
      //     // var_dump($point);
      //     if(preg_match_all('|<h2>(.+)</h2>|isU', $point, $arr)) {
      //       echo "Глава" .$arr[0][0];
      //     }

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
            <br>количество глав в книге = $countChapters
            <br>".$contents['***'][1]."
            <br>".count($page_arr)." - количество страниц</p>";
      
      function counterPage($page_arr, $n) {
        echo $page_arr[$n];
      }
      function iterat($n, $num, $lines, $contents, $titleChapterCurrent) {
        global $y;
        global $titleChapter;
        $y = $n;
        $count = 6; // по умолчанию создается внутри ф-ции
        $count += $n; // постепенно наращивается
        echo " $y до итерации равен y.<br>" . $contents[$titleChapterCurrent][1] . "<br>";
        echo " $count до итерации равен count. ";
      
        if (($n - $contents[$titleChapterCurrent][1]) == 0) {
          echo "num меньше 6 " . $contents[$titleChapterCurrent][1];
          for ($i = $y; $i < $count; $i++) {
            $y = $i;
            echo '<p style="color: red">'.$y.'</p>';
            echo $lines[$i];
            if(preg_match_all('|<h2 class="section-book__title">(.+)</h2>|isU', $chapter, $arr)) {
              // echo "Глава" .$arr[0][0];
              $titleChapter = $arr[1][0];
            }
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
            $titleChapter = $arr[1][0];
          }
          
        }
        echo " После итерации $y равен y. <br>";
        echo " $count После итерации равен count. ";
        return $y;
      }
      // сохраняем текущее значение $n до функции
      $current_n = $n;
      counterPage($page_arr, $n);
      // iterat($n, $num, $lines, $contents, $titleChapterCurrent);

//       echo $titleChapter;
//       // $titleChapter = $titleChapterCurrent;
//       echo $titleChapterCurrent;
//       if($titleChapter == '') {
//         echo "Привет";
//         $titleChapter = $titleChapterCurrent;
//       }
//       else {
//         echo "Не привет";
//       }


      // $n = $y + 1;
      // $x = $n - 6 * 2;
//////////////Нумерация страниц/////////////////////////////////////////////////////////////////
      // счетчик страниц
      $pages = $n + 1;
      $pages_next = $pages + 1;
      $pages_prev = $pages - 1;
/////////////Конец нумерации страниц////////////////////////////////////////////////////////////     
      echo "n - $n <br>";
      if ($n == 0) {
        echo "<a href='adWorks3.php?n=".++$n."'>Вперед на ". $pages_next ." страницу</a> ";
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
      </div>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>