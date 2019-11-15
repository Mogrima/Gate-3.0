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

      $sql = "SELECT * FROM `test`";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $text = $row->text;
      $chapter = $row->chapter;
      $lines = explode("</p>", $text);
      $chapterPages = count($lines) - 1;
      $num = $chapterPages - $n;
      echo "<p style='color: grey'>chapterPages = $chapterPages - кол-во параграфов в главе $chapter.
            <br>n = $n - увеличивается при перелистывании страниц
            <br>num = $num - уменьшается при перелистывании страниц, счетчик оставшихся параграфов
                             которые не были выведены еще.</p>";

      function iterat($n, $num, $lines) {
        global $y;
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
          echo '<p style="color: red">'.$y.'</p>';
          
        }
        echo " После итерации $y равен y. <br>";
        echo " $count После итерации равен count. ";
        return $y;
      }
      iterat($n, $num, $lines);
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
        $lines = explode("</p>", $text);
      $countParagraphs = count($lines) - 1;
      // количество страниц прибавляем уже к существующим, это нужно для счетчика страниц
      $countPage += floor($countParagraphs / 6);
      $countPage2 = floor($countParagraphs / 6);
      }
      // количество страниц прибавляем уже к существующим, это нужно для счетчика страниц
      $countPage += floor($countParagraphs / 6);
      // счетчик страниц
      echo "(($y + 1) / 6) + $countParagraphs";
      $pages = (($y + 1) / 6) + $countParagraphs;
      $pages_next = $pages + 1;
      $pages_prev = $pages - 1;
/////////////Конец нумерации страниц////////////////////////////////////////////////////////////     

      echo "<a href='adWorks2.php?n=".$n."'>Вперед на ". $pages_next ." страницу</a> ";
      $n = $n - 6 * 2;
      if ($n >= 0) echo "<a href='adWorks2.php?n=".$n."'>Назад на ". $pages_prev ." страницу</a> ";
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
echo "<h3><a href='adWorks2.php?page=".$i."cursor=".$count."&amp;n=".$n."&amp;id=".$content->id."'>" . $content->chapter . "</a></h3>";
}
?>
      <a href="administrator.php" class="button">Назад</a>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
  <script>
  let totalCount = 200;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.countSymbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCount - countInput.value.length;
  });
  </script>
 </body>
</html>