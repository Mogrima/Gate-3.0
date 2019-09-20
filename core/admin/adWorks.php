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
 
$filename = "text.txt";
 

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

if (file_exists($filename) && is_readable ($filename)) {
  $fp = @fopen($filename, 'r');
  if ($fp) {
    echo '<p style="color: red;">'.filesize($filename).'</p>';
    $lines = str_split_unicode(fread($fp, filesize($filename)), 4500);
      // $lines = explode("f", fread($fp, filesize($filename)));
      
      echo '<p style="color: red;">'.$lines[109].' переменная lines</p>';
      foreach($lines as $res) {
        $sql = "INSERT INTO test(title, text) VALUES('Истории тысячи миров', '$res')";
        $query = $pdo->prepare($sql);
        $query->execute(['Истории тысячи миров', $res]);
      }
  }
}
// помещаем номер страницы из массива GET в переменую $page
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;

// количество статей на страницу
$on_page = 1;

// (номер страницы - 1) * статей на страницу
$shift = ($page - 1) * $on_page;

$sql = "SELECT * FROM `test` LIMIT $shift, $on_page";
$result = $pdo->query($sql);

// выводим заголовок и контент
// foreach ($result as $row) {
//     echo "<h1>" . $row["title"] . "</h1>";
//     echo "<p>" . $row["text"] . "</p>";
// }

while($row = $result->fetch(PDO::FETCH_OBJ)) {
  echo "<h1>" . $row->title . "</h1>";
    echo "<p>" . $row->text . "</p>";
}

// получаем количество статей и сохраняем как элемент массива "all_articles"
// $result = $this->db->select("SELECT count(*) AS all_articles FROM `articles`");
$sql = 'SELECT `text` FROM `test`';
$result = $pdo->query($sql);

$count = 108;
$pages = ceil($count / $on_page);

echo "<a href='adWorks?page=".++$page."'>Вперед</a> ";

// for ($i = 1; $i <= $pages; $i++) {
//     // если текущая старница
//     if($i == $page){
//         echo " [$i] ";
//     } 
//     echo "<a href='adWorks?page=".++$i."'>Вперед</a> ";
// }
?>
      <a href="/admin/administrator.php" class="button">Назад</a>
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