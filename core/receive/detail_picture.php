<?php require_once('../business/session.php');
  require_once('../business/appvars.php');
  require_once(BUS_с. '/pagevars_c.php');
  require_once(BUS_с. 'connectvars.php');
  // подключение к базе данных
  require_once(BUS_с. 'mysql__connect.php');

  if (isset($_POST['delete'])) {
    $id_picture = $_POST['id'];
    $sql = "DELETE FROM `album_arts` WHERE id = $id_picture";

    $query = $pdo->prepare($sql);
    $query->execute();
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/list_pictures.php';
    header('Location: ' . $url);
  }

  if (isset($_POST['edit_album'])) {
    $id_album = $_POST['album_list'];
    $id_picture = $_POST['id'];
    $sql = "UPDATE album_arts SET album_id = '$id_album' WHERE id = $id_picture";
    $query = $pdo->prepare($sql);
    $query->execute([$id_album, $id_picture]);
    Header('Location: '.$_SERVER['PHP_SELF'] . '?id=' . $id_picture);
  }

  if (isset($_POST['edit_picture'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $id_picture = $_POST['id'];
    $sql = "UPDATE album_arts SET works_title = '$title' WHERE id = $id_picture";
    $query = $pdo->prepare($sql);
    $query->execute([$title, $id_picture]);
    Header('Location: '.$_SERVER['PHP_SELF'] . '?id=' . $id_picture);
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
      $id = $_GET["id"];
      $sql = "SELECT * FROM `album_arts` WHERE id = $id";
      $query = $pdo->query($sql);

       ?> 
       <ul>
        <?php 

    while($row = $query->fetch(PDO::FETCH_OBJ)) {
      $image = explode('.', $row->works_image);

      $album_id = $row->album_id;
      $picture_title = $row->works_title;
      $ill_of_books = $row->ill_of_books;
      $b_a_w = $row->b_a_w;
      $color = $row->color;
      $history = $row->history;
      if($image[1] != NULL) {
        $src = $image[0];
        $type = $image[1];
      } else {
        $type = 'jpg';
      }

      $dinamyc_link = $row->id;
      $stat_link = 'picture.php?id=';
      $dinamyc_link = $stat_link . $dinamyc_link;
       ?>
                   <li>
                     <img src="../../img/<?=$image[0]?>.<?=$type?>" alt="" width="150">
                      <a href="<?=$dinamyc_link?>" title="<?=$row->id?>"><?=$row->works_title?></a>
                    </li>
          <?php } ?>
        </ul>

        <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?=$id?>" method="post">
        <input type="hidden" name="id" value="<?=$id?>">
        <label for="album_list">Альбом рисунка</label>
        <select id="album_list" name="album_list">
        <?php 
          $sql_album_list = "SELECT * FROM `album_list` ORDER BY `id` DESC";
          $query_album_list = $pdo->query($sql_album_list);
          while($row_album_list = $query_album_list->fetch(PDO::FETCH_OBJ)) { ?>
            <option value="<?=$row_album_list->id?>" <?php if ($row_album_list->id == $album_id) { ?> selected <?php } ?> ><?=$row_album_list->works_title?></option>
        <?php } ?>

        </select>
        <button type="submit" name="edit_album" value="edit_album">Изменить альбом</button>
        </form>

        <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$id?>">
        <label for="news_title">Название рисунка</label>
        <input class="input input__title" id="news_title" type="text" name="title" value="<?=$picture_title?>">

        <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
              <ul class="filter__list filter__list--center">
                <div class="filter__wrapper-gallery">
                  <li class="filter__item-gallery"><input class="checkbox" id="ill_of_books" name="ill_of_books"
                      type="checkbox" value="1" <?php if ($ill_of_books == '1') { ?> checked <?php } ?> > <label class="checkbox__name"
                      for="ill_of_books"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="color" name="color" type="checkbox"
                      value="1" <?php if ($color == '1') { ?> checked <?php } ?>> <label class="checkbox__name" for="color"><span class="checkbox__indicator"></span>
                      Цветные</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="b_a_w" name="b_a_w" type="checkbox"
                      value="1" <?php if ($$b_a_w == '1') { ?> checked <?php } ?> > <label class="checkbox__name" for="b_a_w"><span class="checkbox__indicator"></span>
                      Черно-белые</label></li>
                  <li class="filter__item-gallery"><input class="checkbox" id="history" name="history" type="checkbox"
                      value="1" <?php if ($history == '1') { ?> checked <?php } ?>> <label class="checkbox__name" for="history"><span
                        class="checkbox__indicator"></span> Истории</label></li>
                </div>
              </ul>
            </fieldset>
        <button class="button addnews-button" type="submit" name="edit_picture">Изменить</button>
        </form>

        <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <input type="hidden" name="id" value="<?=$id?>">
          <button type="submit" name="delete" value="delete">Удалить рисунок</button>
        </form>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS_c. 'footer.php'); ?>
  <div class="overlay"></div>
  <script src="../../js/scripts.min.js"></script>
 </body>
</html>