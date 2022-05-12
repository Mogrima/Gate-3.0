<?php require_once('../business/session.php');
 if(isset($_POST['submit'])) {
           
    $title = trim(filter_var($_POST['works_title'], FILTER_SANITIZE_STRING));
    $desc = trim(filter_var($_POST['works_desc'], FILTER_SANITIZE_STRING));
    $image = trim(filter_var($_FILES['works_image']['name'], FILTER_SANITIZE_STRING));
    $image_type = $_FILES['works_image']['type'];
    $image_size = $_FILES['works_image']['size'];
    $author = $_SESSION['username'];

    require_once('../business/appvars.php');
    require_once('../'.BUS.'/connectvars.php');
    require_once('../'.BUS.'/mysql__connect.php');

    if(iconv_strlen($desc) > 200) {
        echo 'вы ввели больше 200 символов в описание произведения';
        exit();
    }

    $error = false;

    // echo 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/adWorks.php';

    if(!empty($title)) {
      if(!empty($image)) {
          if ((($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png')) && ($image_size > 0) && ($image_size <= MM_MAXFILESIZE)) {
              if ($_FILES['works_image']['error'] == 0) {
                  $target = WORKS . basename($image);
                  if (move_uploaded_file($_FILES['works_image']['tmp_name'], $target)) {
                      if(!empty($desc)) {
                          $sql = "INSERT INTO works_catalog(works_title, works_desc, works_image, works_author) VALUES('$title', '$desc', '$image', '$author')";
                          $query = $pdo->prepare($sql);
                          $query->execute([$title, $desc, $image, $author]);
                      } else {
                          $sql = "INSERT INTO works_catalog(works_title, works_image, works_author) VALUES('$title', '$image', '$author')";
                          $query = $pdo->prepare($sql);
                          $query->execute([$title, $image, $author]);
                      }
                  } else {
                      $error = true;
                      echo 'что то пошло не так';
                  }
              } else {
                  $error = true;
                  echo 'ошибка при загрузки изображения';
              }
          } else {
              $error = true;
              echo '<p> Файл, подтверждающий рейтинг, должен быть файлом изображения в форматах GIF, JPEG или PNG, и его размер не должен превыmать ' . (MM_MAXFILESIZE / 1024) . ' KB.</p>';
          }
      } else {
          if(!empty($desc)) {
              $sql = "INSERT INTO works_catalog(works_title, works_desc, works_author) VALUES('$title', '$desc', '$author')";
              $query = $pdo->prepare($sql);
              $query->execute([$title, $desc, $author]);
          } else {
              $sql = "INSERT INTO works_catalog(works_title, works_author) VALUES('$title', '$author')";
              $query = $pdo->prepare($sql);
              $query->execute([$title, $author]);
          }
      }
    } else {
        $error = true;
        echo 'нужно заполнить заголовок';
    }
    if($error === false) {
        $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/adWorks.php';
                header('Location: ' . $home_url);
                die('Переадресация не состоялась.');
    }
    }
?>