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
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <?php
      
 clearstatcache();
$filename = "songAttic.txt";
 

// $string = 'The foreach construct provides an easy way to iterate over arrays. foreach ... In PHP 5, when foreach first starts executing, the internal array pointer is automatically reset to the first element of the array. This means that you do not need to call reset';
// $result = str_split($string, 10);

// foreach($result as $res) {
//   echo $res . '<br>';
// }
function str_split_unicode($str, $l = 0) {
  if ($l > 0) {
      $ret = array();
      $len = mb_strlen($str, "UTF-8");
      for ($i = 0; $i < $len; $i += $l) {
          $ret[] = mb_substr($str, $i, $l, "UTF-8");
      }
      return $ret;
  }
  return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
}

$s = "Диана лежала в своей пастели и всматривалась в тени вокруг. В эти уродливые очертания невиданных, безликих чудовищ, притаившихся в темноте, безмолвно ждущих когда она закроет глаза… Иногда краем глаза она видела их перемещения, когда они думали будто их никто не видит. Они, бесспорно, ходили по дому совершенно свободно, как настоящие хозяева едва свет во всех комнатах затухал, а люди – их соседи засыпали. Эти тени не трогают ее пока она спит, но Диана уверена, что когда-нибудь их ледяные пальцы разбудят ее посреди ночи. Когда-нибудь… может даже сегодня. Они ждут заветной ночи, но какая именно эта самая ночь?"; // Mild milk

// $results = str_split_unicode($s, 3);
// foreach($results as $res) {
//   echo $res . '<br>';
// }

// Начало загрузки книги в БД
// Если держать код разкомментированным в таком виде, что загрузка заново
// будет происходить каждый раз при перезагрузки страницы, тем самым
// База данных будет все заполняться и заполняться

// if (file_exists($filename) && is_readable ($filename)) {
//   echo 'работает';
//   $fp = @fopen($filename, 'r');
//   echo 'работает 2';
//   if ($fp) {
//     echo '<p style="color: red;">'.filesize($filename).'</p>';
//     // $lines = str_split_unicode(fread($fp, filesize($filename)), 2360);
//     $lines = fread($fp, filesize($filename));
//     echo $lines;
//       // $lines = explode("f", fread($fp, filesize($filename)));
      
//       // echo '<p style="color: red;">'.$lines[109].' переменная lines</p>';
//       // foreach($lines as $res) {
//         // $sql = "INSERT INTO test(title, text) VALUES('Истории тысячи миров', 'Певчий чердак', '$res')";
//         $sql = "INSERT INTO test(title, chapter, text) VALUES('Истории тысячи миров', 'Певчий чердак', '$lines')";
//         $query = $pdo->prepare($sql);
//         $query->execute(['Истории тысячи миров', 'Певчий чердак', $lines]);
//       // }
//   }
// }

// конец загрузки книги в БД

// $sql = "SELECT * FROM `test`";
// $result = $pdo->query($sql);
// $row = $result->fetch(PDO::FETCH_OBJ);
// $text = $row->text;
// $lines = explode("</p>", $text);
// echo $text;
// echo count($lines);
// $chapterPage = count($lines);

// $i = 1;

// foreach($lines as $res) {
//   echo $res;
//   echo $i;
//   $i++;
// }


// if (fopen($filename, "r")) echo "File exists!";
// помещаем номер страницы из массива GET в переменую $page
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
$cursor = isset($_GET["cursor"]) ? (int) $_GET["cursor"] : 6;
$n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;
$pages = isset($_GET["pages"]) ? (int) $_GET["pages"] : 0;
// количество статей на страницу
$on_page = 1;

// (номер страницы - 1) * статей на страницу
$shift = ($page - 1) * $on_page;

if (false) {
  $textid = $_GET["textid"];
  $sql = "SELECT * FROM `test` WHERE `id` = $textid LIMIT $shift, $on_page";
  // $result = $pdo->query($sql);
  // $row = $result->fetch(PDO::FETCH_OBJ);
  // $text = $row->text;
  // $lines = explode("</p>", $text);
}
else {
  $sql = "SELECT * FROM `test` LIMIT $shift, $on_page";
  // $sql = "SELECT * FROM `test`";
}

// $sql = "SELECT * FROM `test`";
$result = $pdo->query($sql);
$row = $result->fetch(PDO::FETCH_OBJ);
$text = $row->text;
$id = $row->id;
$lines = explode("</p>", $text);
$joker = explode("</p>", $text);
// joker1 это размер массива разбиение текста по абзацам
$joker1 = count($joker);
// echo $lines[2];
$chapterPages = count($lines) - 1;
echo $chapterPages;
echo '<p style="color: red">'. floor($chapterPages / 6) .'</p>';
$num = $chapterPages - $n;
echo '<p style="color: pink">'. $num .'</p>';
echo '<p style="color: green">'. $x .'</p>';
// echo $n . '<b>Итерация</b>';
// для ссылки на страницу назад
$x = $n - 6;

function iterat($n, $num, $lines) {
  global $y;
  $y = $n;
  $count = 6;
  $count += $n;
  echo " $y до итерации равен y. <br>";
  echo " $count до итерации равен count. ";

  if ($num < 6) {
    echo "num меньше 6<br>";
    for ($i = $y; $i < $count; $i++) {
      $y = $i;
      echo '<p style="color: red">'.$y.'</p>';
      
      echo $lines[$i];
      // echo '<p style="color: red">'.$i.'</p>';
      // return $i;
      // $n += $i;
      
      
    }
  }
  for ($i = $y; $i < $count; $i++) {
    echo $lines[$i];
    // echo '<p style="color: red">'.$i.'</p>';
    // return $i;
    // $n += $i;
    $y = $i;
    echo '<p style="color: red">'.$y.'</p>';
    
  }
  echo " После итерации $y равен y. <br>";
  echo " $count После итерации равен count. ";
 return $y;
}
iterat($n, $num, $lines);

// $id =$_GET['id'];

$sql1 = "SELECT * FROM test WHERE `id`< $id";
$query = $pdo->query($sql1);
$pages1 = $query->fetchAll(PDO::FETCH_OBJ);
$countPage = 0;
foreach ($pages1 as $page1) {
  $text = $page1->text;
  $lines = explode("</p>", $text);
$chapterPages = count($lines) - 1;
// количество страниц прибавляем уже к существующим, это нужно для счетчика страниц
$countPage += floor($chapterPages / 6);
$countPage2 = floor($chapterPages / 6);
}
$n = $y + 1;
echo '<p style="color: red">' . count($joker) . '</p>';
echo "<hr>";
// счетчик страниц
$pages = (($y + 1) / 6) + $countPage;
$pages_next = $pages + 1;
$pages_prev = $pages - 1;

// iterat($n, $num, $lines);
// $n = $y + 1;
echo '<br> '.$y . '<b>После Итерация и </b> ' .$n;
echo "<p style='color: red'>$countPage2</p>";
// echo $n . '<b>y После Итерация</b>';


// function iterat($i) {
//   for ($i; $i < 6; $i++) {
//     echo $i;
//   }
// }

// iterat(2);

// выводим заголовок и контент
// foreach ($result as $row) {
//     echo "<h1>" . $row["title"] . "</h1>";
//     echo "<p>" . $row["text"] . "</p>";
// }

// while($row = $result->fetch(PDO::FETCH_OBJ)) {
//   echo "<h1>" . $row->title . "</h1>";
//     echo "<p>" . $row->text . "</p>";
// }

// получаем количество статей и сохраняем как элемент массива "all_articles"
// $result = $this->db->select("SELECT count(*) AS all_articles FROM `articles`");
// $sql = 'SELECT `text` FROM `test`';
// $result = $pdo->query($sql);
// получаем общее количество строк
$stmt = $pdo->query('SELECT COUNT(*) FROM test');
$row = $stmt->fetch();
$c=$row[0]; //количество строк
echo 'количество строк' . $c .'<br>';

$count = 1;
// $pages = ceil($count / $on_page);

// $cursor += $cursor;
// переход к другому рассказу/главе
if (($num <= 6) && (($c - $page) > 0)) {
  echo "условие if 1 и $page - $c";
  echo "/// ($pages - $countPage) == 1<br>";
  echo "<br>Текущее состояние: page = $page; x = $x, countPage = $countPage, id = $id;<br>";
  echo "<a href='adWorks.php?page=".$page."&amp;n=".$x."&amp;pages=".$pages."&amp;id=".$id."'>Назад на ". $pages_prev ." страницу</a> ";
  $n = 0;
  $count = 0;
  echo "<a href='adWorks.php?page=".++$page."&amp;cursor=".$count."&amp;n=".$n."&amp;pages=".$pages."&amp;id=".$id."'>Вперед на ". $pages_next ." страницу</a> ";
  
}
// else if (($num - $num) == 0) {
//   echo "<a href='adWorks.php?page=".$page."&amp;n=".$x."&amp;pages=".$pages."&amp;id=".$id."'>Назад на ". $pages_prev ." страницу</a> ";
// }
// переходы по страницам в пределах одного рассказа или главы
else if ($x >= 0 || $n >= 0) {
  echo "условие if 2 и $n - $joker1. $c - $page";
  echo "<a href='adWorks.php?page=".$page."&amp;cursor=".$count."&amp;n=".$n."&amp;pages=".$pages."&amp;id=".$id."'>Вперед на ". $pages_next ." страницу</a> ";
  echo "<a href='adWorks.php?page=".$page."&amp;cursor=".$count."&amp;n=".$x."&amp;pages=".$pages."&amp;id=".$id."'>Назад на ". $pages_prev ." страницу</a> ";
} 
// переходы по страницам между рассказами или главами
// выяснить что это первая страница следующего рассказа
else if ((($pages - $countPage) == 1) && (($c - $page) > 0)) {
  echo "/// ($pages - $countPage) == 1<br>";
  echo 'условие if 3';
  echo "<br>($countPage * 5) - 1 = ;<br>";
  echo "<br>Текущее состояние: page = $page; x = $x, countPage = $countPage, id = $id;<br>";
  $x = ($countPage * $countPage2) - 1;
  echo '$x значит' . $x;
  echo "<a href='adWorks.php?page=".$page."&amp;cursor=".$count."&amp;n=".$n."&amp;pages=".$pages."&amp;id=".$id."'>Вперед на ". $pages_next ." страницу</a> ";
  echo "<a href='adWorks.php?page=".--$page."&amp;cursor=".$count."&amp;n=".$x."&amp;pages=".$pages."&amp;id=".$id."'>Назад на ". $pages_prev ." страницу</a> ";
} 
// последняя страница
else if ((($page - $c) <= 0) && (($n - $joker1) == 0)) {
  echo "условие if 4 $page - $c и $n - $joker1. countPage = $countPage";
  echo "<br>($countPage * 5) - 1 = ;<br>";
  echo "<br>x = $x<br>";
  $x = $countPage2 * 6;
  echo "<br>Текущее состояние: page = $page; x = $x, countPage = $countPage, id = $id;<br>";
  --$id;
  // --$pages;
  echo "<a href='adWorks.php?page=".--$page."&amp;cursor=".$count."&amp;n=".$x."&amp;pages=".$pages."&amp;id=".$id."'>Назад на ". $pages_prev ." страницу</a> ";
}
 else {
  // первая страница
  echo "условие else и $c - $page и $pages - $countPage. x = $x";
  echo "<a href='adWorks.php?page=".$page."&amp;cursor=".$count."&amp;n=".$n."&amp;pages=".$pages."&amp;id=".$id."'>Вперед на ". $pages_next ." страницу</a> ";
}
echo "Текущая страница $pages";

echo "<hr>";
// echo "<a href='adWorks.php?page=".++$page."'>Вперед на ". $page ." страницу</a> ";

// if ($page > 2) {
//   --$page;
//   echo "<a href='adWorks.php?page=".--$page."'>Назад на ". $page ." страницу</a> ";
// }
// <a href='/news.php?id=$row->id' title='$row->title' class='btn btn-warning mb-5'>Прочитать больше</a>";

// for ($i = 1; $i <= $pages; $i++) {
//     // если текущая старница
//     if($i == $page){
//         echo " [$i] ";
//     } 
//     echo "<a href='adWorks?page=".++$i."'>Вперед</a> ";
// }
?>

<h3>Содержание</h3>
<?php
// while($row = $query->fetch(PDO::FETCH_OBJ)) {
//     echo "<h4><a href='adWorks.php?textid=".$row->id."'>$row->chapter</a></h4>";
// }
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
echo "<h3><a href='adWorks.php?page=".$i."cursor=".$count."&amp;n=".$n."&amp;id=".$content->id."'>" . $content->chapter . "</a></h3>";
}
?>
      <a href="administrator.php" class="button">Назад</a>
      <?php
       
        // php код для отправки данных формы
      //  require_once('submitWorks.php');?>
      <form class="form-addnews" action="submitWorks.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="327680">
        <label for="works_title">Название произведения</label>
        <input class="input input__title" id=works_title" type="text" name="works_title" value="">
        <label for="works_text">Описание произведения</label>
        <textarea class="input news_text countInput" id="works_text" type="text" name="works_desc"></textarea>
        <label for="works_image">Обложка произведения</label>
        <p><span class="countSymbol"></span></p>
        <input class="input" id="works_image" type="file" name="works_image">
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
        <a class="button addnews-button" href="index.php">на главную</a>
        </form>
        <!-- <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <textarea name="workText" id="text" cols="130" rows="100"></textarea>
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
        </form> -->
        
        <!-- Вывод из бд всех произведений -->
        <?php $sql = 'SELECT * FROM `works_catalog` ORDER BY `id` DESC';
        // запрос в бд
        $query = $pdo->query($sql);
        // присваивания переменной значения для заголовка секций
        $works_title = 'Все произведения';
        // вывод непосредственно секций с работами
        require('../blocks/works_section.php');?>
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