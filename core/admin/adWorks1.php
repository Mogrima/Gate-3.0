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
  <?php require_once '../blocks/main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <form enctype="multipart/form-data" class="form-settings" method="POST" action="./adWorks1.php">
      <label for="title">Название книги</label>
      <input id="title" type="title" name="title" maxlength= "50" required>
      <input type="file" name="file">
      <button class="profile__btn" type="submit" name="submit" value="submit">Загрузить</button>
      </form>
      <div>
      <?php
      if (isset($_POST['submit'])) {
        $file_src = trim(filter_var($_FILES['file']['name'], FILTER_SANITIZE_STRING));
        if (!empty($file_src)) {
          if ($_FILES['file']['error'] == 0) {
            $target = __DIR__ . "/" . basename($file_src);
            move_uploaded_file($_FILES['file']['tmp_name'], $target);
            // $text = htmlentities(file_get_contents($target));
            $text = file_get_contents($target);
            $title_works = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
            // echo var_dump($str);
            $lines = explode("</p>", $text);
            // $search_code = array('<chapter>', '</chapter>', '<p>', '</p>', '<h3>', '</h3>', '<i>', '</i>');
            // $replace_code = array('<chapter>', '</chapter>', '<p>', '</p>', '<h3>', '</h3>', '<i>', '</i>');
            // $lines_str = str_replace($search_code, $replace_code, $lines);
            $chapterPages = count($lines) - 1;
            $chapters = explode("</chapter>", $text);
            $chapters_count = count($chapters) - 1;

            $transformed_text = wordwrap($text, 130, "	&shy\n");
            // $works_desc = 'desc';
            // $works_image = '';
            // $works_author = 'Roger';
            //  var_dump($transformed_text);
            //  $sql = "INSERT INTO works_catalog(works_title, works_desc, text) VALUES('$work_title', '$works_desc', '$works_image', '$works_author', '$transformed_text')";
            //  $sql = "INSERT INTO works_catalog(works_title, text) VALUES('$work_title', '$transformed_text')";

            //  $query = $pdo->prepare($sql);
            //  $query->execute([$work_title, $transformed_text]);
            echo $title_works;
          }
        }
        echo "<span style='color: red;'>dsdsdsd" . $target . "</span>";
      }

      $n = isset($_GET["n"]) ? (int) $_GET["n"] : 0;

      $sql = "SELECT * FROM `works_catalog` WHERE works_title = '1 книга'";
      $result = $pdo->query($sql);
      $row = $result->fetch(PDO::FETCH_OBJ);
      $id = $row->id;
      $text = $row->text;
      // $lines = explode("</,>", $text);
      // $chapterPages = count($lines) - 1;
      // $chapters = explode("</chapter>", $text);
      // $chapters_count = count($chapters) - 1;

      // $transformed_text = wordwrap($text, 130, "	&shy\n");
      // var_dump($transformed_text);
      // echo html_entity_decode($text);

        // получаем массив с страницами
        $page_arr = array();
        $count = (ceil($chapterPages/6)) * 6;
        for($c = 0; $c <= $chapters_count; $c++) {
          $chapters_line = explode("</p>", $chapters[$c]);
          $chapters_line_count = (count($chapters_line) - 1);
          $num_page = ceil($chapters_line_count / 6) * 6;
          // echo  "<br> $chapters_line_count - кол-во параграфов и $num_page - кол-во страниц и $c - номер итерации";
          for($i = 6, $e = 0; $i <= $num_page; $i = $i + 6, $e = $e + 6) {
              for($w = $e; $w < $i; $w++) {
                $s = $chapters_line[$w];
                $page_x = $page_x . $s;
              }
            
            $page_arr[] = $page_x;
            $page_x = '';
          }
        }
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
      <a href="administrator.php" class="button">Назад</a>
      </div>
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once('../blocks/footer.php'); ?>
 </body>
</html>