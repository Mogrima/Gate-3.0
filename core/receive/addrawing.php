<?php require_once('../business/session.php');
  require_once('../business/appvars.php');
  require_once(BUS_с. '/pagevars_c.php');
  require_once(BUS_с. 'connectvars.php');
  // подключение к базе данных
  require_once(BUS_с. 'mysql__connect.php');

  if(isset($_POST['submit'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $album = (int)trim(filter_var($_POST['album_list'], FILTER_SANITIZE_STRING));
    $ill_of_books = (trim(filter_var($_POST['ill_of_books'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $b_a_w = (trim(filter_var($_POST['b_a_w'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $color = (trim(filter_var($_POST['color'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;
    $history = (trim(filter_var($_POST['history'], FILTER_SANITIZE_STRING)) == "") ? 0 : 1;

  $name_file=($_FILES['screenshot']['name']); 
  $uploadfile = '../../img/' . $name_file; 

    if(!empty($title) && !empty($album)) {
      if(($_FILES['screenshot']['type'] == 'image/gif' || $_FILES['screenshot']['type'] == 'image/jpeg' || 
      $_FILES['screenshot']['type'] == 'image/png') && ($_FILES['screenshot']['size'] != 0)) { 
        move_uploaded_file($_FILES['screenshot']['tmp_name'], $uploadfile);
}      
      $sql = "INSERT INTO album_arts(album_id, works_title, works_image, ill_of_books, b_a_w, color, history) VALUES('$album', '$title', '$name_file', '$ill_of_books', '$b_a_w', '$color', '$history')";

      $query = $pdo->prepare($sql);
      $query->execute([$album, $title, $name_file, $ill_of_books, $b_a_w, $color, $history]);
      
      Header('Location: '.$_SERVER['PHP_SELF']);
    }
    
  }
  
?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    $website_title = 'Администратор';
    require_once(BLOCKS_c. 'head.php'); ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php // require_once(BLOCKS_c. 'header.php'); ?>

  <header class="page-header">
      <div class="page-header__wrapper <?=$user_header_class?>">
        <a href="index.php" class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164" height="54" src="../../img/Logo.png"></a>
        <?php
        require_once('../business/menu_links.php');
        if (isset ($_SESSION['username'])) {
          $session_id = $_SESSION['user_id'];
      $userquery = "SELECT * FROM user WHERE `user_id` = :session_id";
      $userData = $pdo->prepare($userquery);
      $userData->execute([':session_id' => $session_id]);
    while($row = $userData->fetch(PDO::FETCH_OBJ)) {

      $avatar1 = $row->avatar;
      $loginCurrent = $row->username;
      $emailCurrent = $row->user_email;
      if(!$user_page) {
        ?>
        <nav class="profile-menu profile-menu--nojs">
          <button class="profile-menu__button" type="button">
              <img class="profile-menu__icon" src="../../img/user/<?php echo $avatar1?>" width="70" height="70" alt="меню пользователя">
              <span class="profile__name"><?php echo ''.$_SESSION['username'].'' ?></span>
              <span class="visually-hidden">Открыть</span>
          </button>
          <ul class="profile-menu__list">
            <li class="profile-menu__item">
              <a class="profile-menu__link" href="/user.php">Перейти в личный кабинет</a>
            </li>
            <li class="profile-menu__item">
              <a class="profile-menu__link profile-menu__link--bottom" href="<?=$logout_php?>">Выйти</a>
            </li>
          </ul>
      </nav>
      <?php } }
    } else {
      ?>
        <nav class="page-header__user-block user-navigation user-navigation--nojs user-navigation--closed">
          <button class="user-navigation__toggle" type="button"><span class="visually-hidden">Открыть</span>
          </button>
          <ul class="user-navigation__list">
            <li class="user-navigation__item">
              <a class="user-navigation__link registration-link" href="<?=$reg_php?>">Оформить читательский билет</a>
            </li>
            <li class="user-navigation__item user-navigation__item--bottom">
              <a class="user-navigation__link login-link" href="<?=$login_php?>">Представиться</a>
            </li>
          </ul>
        </nav>
        <?php } ?>
      </div>
    </header>

  <?php require_once(BLOCKS_c. 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS_с. '/adminSession.php'); ?>
      <?php
      $sql = "SELECT * FROM `album_list` ORDER BY `id` DESC";
      $query = $pdo->query($sql);

       ?> 
      <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <!-- <input type="hidden" name="MAX_FILE_SIZE" value="1000000"> -->
        <label for="news_title">Название рисунка</label>
        <input class="input input__title" id="news_title" type="text" name="title" value="<?php if(!empty($title)) echo $title; ?>">
        <label for="album_list">Альбом рисунка</label>
        <select id="album_list" name="album_list">
        <?php 

    while($row = $query->fetch(PDO::FETCH_OBJ)) { ?>
                    <option value="<?=$row->id?>"><?=$row->works_title?></option>
          <?php } ?>

        </select>
        

        <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
              <ul class="filter__list filter__list--center">
                <div class="filter__wrapper-gallery">
                  <li class="filter__item-gallery"><input class="checkbox" id="ill_of_books" name="ill_of_books"
                      type="checkbox" value="1"> <label class="checkbox__name"
                      for="ill_of_books"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="color" name="color" type="checkbox"
                      value="1"> <label class="checkbox__name" for="color"><span class="checkbox__indicator"></span>
                      Цветные</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="b_a_w" name="b_a_w" type="checkbox"
                      value="1"> <label class="checkbox__name" for="b_a_w"><span class="checkbox__indicator"></span>
                      Черно-белые</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="history" name="history" type="checkbox"
                      value="1"> <label class="checkbox__name" for="history"><span
                        class="checkbox__indicator"></span> Истории</label></li>
                </div>
              </ul>
            </fieldset>


        <label for="screenshot">Файл изображения:</label>
        <input class="input" id="screenshot" type="file" name="screenshot">
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
        </form>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS_c. 'footer.php'); ?>
  <div class="overlay"></div>
  <script src="../../js/scripts.min.js"></script>
 </body>
</html>