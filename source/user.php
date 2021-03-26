<?php require_once('./core/business/session.php');
require_once('./core/business/appvars.php');
require_once(BUS . 'connectvars.php');
// подключение к базе данных
require_once(BUS.'/mysql__connect.php');?>
<?php
    if (!isset($_SESSION['user_id'])) {
      $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER[PHP_SELF]) . '/login.php';
      header('Location: ' . $home_url);
    }
?>
<?php
if (isset($_POST['upload'])) {
  $currentAvatar    = trim(filter_var($_POST['avatar'], FILTER_SANITIZE_STRING));
  $orig_picture = trim(filter_var($_FILES['new_picture']['name'], FILTER_SANITIZE_STRING));
  $pic_name = explode(".", $orig_picture);
  $extension = end($pic_name);
  $new_picture = date('dmyHis') . $_SESSION['user_id'] . '.' . $extension;
  $new_picture_type = $_FILES['new_picture']['type'];
  $new_picture_size = $_FILES['new_picture']['size'];
  if (!empty($new_picture)) {
      if ((($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') || ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE)) {
          if ($_FILES['new_picture']['error'] == 0) {

              $target = MM_UPLOADPATH . basename($new_picture);

              if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                  if (!empty($currentAvatar) && ($currentAvatar != $new_picture) && ($currentAvatar != 'default.png')) {
                      @unlink(MM_UPLOADPATH . $currentAvatar);
                  }

                  $sql = "UPDATE user SET avatar = '$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                  $query = $pdo->prepare($sql);
                  $query->execute([$new_picture, $session_id]);
                  $avatar = $new_picture;
                  Header('Location: '.$_SERVER['PHP_SELF']);

                  $pdo = null;
              } else {
                  @unlink($_FILES['new_picture']['tmp_name']);
                  $avatar_text = '<p class="profile__avatar-btn">Извините, возникла ошибка при загрузке файла изображения.</p>';
              }
          }
      } else {
        @unlink($_FILES['new_picture']['tmp_name']);
        $avatar_text = '<p class="profile__avatar-btn"> Изображение для аватара должно быть в формате JPEG или PNG, и его размер не должен превыmать ' . (MM_MAXFILESIZE / 1024) . ' KB.</p>';
        }
  } else {
    $avatar_text = '<p class="profile__avatar-btn">Ничего не изменилось! Попробуйте добавить файл</p>';
  }
}

if(isset($_GET['id'])) {

  $id = $_GET['id'];

  $sql = "DELETE FROM bookmarks WHERE id = $id";
  $query = $pdo->prepare($sql);
  $query->execute([$id]);
  Header('Location: user.php');

  $pdo = null;

  }
?>
<!DOCTYPE html>
<html lang="ru">

<head>
<?php
    $website_title = 'Профиль пользователя';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
    <link href="css/album-slider.css" rel="stylesheet">
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once BLOCKS .'header.php';
   $profilequery = "SELECT * FROM user WHERE `user_id` = :session_id";
   $profileData = $pdo->prepare($profilequery);
   $profileData->execute([':session_id' => $session_id]);
   while($row = $profileData->fetch(PDO::FETCH_OBJ)) {
     $avatar = $row->avatar;
     $gender = $row->gender;
     $email = $row->user_email;
     $birthdate = $row->birthdate;
   }

   if(isset($_POST['submit'])) {
    $gender = trim(filter_var($_POST['gender'], FILTER_SANITIZE_STRING));
    $birthdate = trim(filter_var($_POST['birthdate'], FILTER_SANITIZE_STRING));

    $sql = "UPDATE user SET gender = '$gender', birthdate = '$birthdate' WHERE user_id = '$session_id'";
    $query = $pdo->prepare($sql);
    $query->execute([$gender, $birthdate, $session_id]);
  }

  if(empty($birthdate)) {
    $formatBirthdate = 'Не указана';
  } else {
    $formatBirthdate = date('d.m.Y', strtotime($birthdate));
  }

  $sex = '';
    
  if ($gender == 'F') {
    $sex = 'Женский';
  } else if ($gender == 'M') {
    $sex = 'Мужской';
  } else {
    $sex = 'Не указан';
  }
    ?>
  <?php require_once BLOCKS .'main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title"><?php echo ''.$_SESSION['username'].'' ?></h1>
          <?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <picture class="profile__avatar">
          <source srcset="img/user/<?php echo $avatar?>" media="(min-width: 768px)">
          <img class="profile__avatar-img" src="img/user/<?php echo $avatar?>" width="350" height="394" alt="аватар пользователя">
        </picture>
        <div class="profile">
          <div class="profile__toggles profile__toggles--closed">
            <button class="profile__toggles-open" type="button"><span class="visually-hidden">Открыть
                меню</span></button>
            <div class="profile__toggles-list">
              <button class="profile__toggle profile__toggle--active" type="button">Профиль</button>
              <button class="profile__toggle" type="button">Закладки</button>
              <button class="profile__toggle" type="button">Любимое</button>
              <button class="profile__toggle" type="button">Настройки</button>
              <a href="<?=$logout_php?>" class="profile__toggle profile__exit" title="Выйти">
                <span class="visually-hidden">Выйти</span>
                <svg enable-background="new 0 0 492.5 492.5" width="50" height="50" version="1.1"
                  viewBox="0 0 492.5 492.5" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="m184.65 0v21.72h-84.942v433.36h31.403v-401.96h53.539v439.38l208.15-37.422v-417.58l-208.15-37.5zm38.292 263.13c-6.997 0-12.67-7.381-12.67-16.486 0-9.104 5.673-16.485 12.67-16.485s12.67 7.381 12.67 16.485c0 9.105-5.673 16.486-12.67 16.486z"
                    fill="#fdf30d" />
                </svg>
              </a>
            </div>
          </div>
          <section class="profile__content fade">
              <div class="profile__container profile__container--single">
                  <h2 class="visually-hidden">Общая информация</h2>
                  <p class="profile__description"><span class="profile__desc-key">Дата рождения: </span>
                  <?php echo $formatBirthdate ?></p>
                  <p class="profile__description"><span class="profile__desc-key">Пол: </span><?php echo $sex ?></p>
                  <p class="profile__description"><span class="profile__desc-key">Электронная почта:</span> <a
                          class="link link--profile" href="mailto:<?=$email?>"><?=$email?></a>
                  </p>
              </div>
              </section>
              <section class="profile__content fade">
              <div class="profile__container profile__container--single">
                  <h2 class="visually-hidden">Закладки</h2>
                  <p class="profile__description">Здесь отображаются оставленные вами закладки в
                      произведениях.</p>
                  <ul class="bookmark">
                  <?php
                  $sql = "SELECT id, title_book, bookmark FROM `bookmarks` WHERE user_id = '$session_id'";
                  $query = $pdo->query($sql);
                  while($row = $query->fetch(PDO::FETCH_OBJ)) {
                    $bookmark_id = $row->id;
                    $title_book = $row->title_book;
                    $bookmark = $row->bookmark;

                    echo "<li class='reviews__item bookmark__item'>
                            <h3 class='bookmark__title'> «$title_book"."»</h3>
                            <div class='bookmark__wrapper'>
                              <a class='profile__btn profile__btn--book' href='$bookmark' target='_blank'>Читать</a>
                              <a class='profile__delete' href='user.php?id=$bookmark_id'>Удалить закладку</a>
                            </div>
                          </li>";
                  }
                   ?>
                   </ul>
              </div>
              </section>
              <section class="profile__content fade">
                <div>
                  <div class="profile__container profile__container--single">
                    <h2 class="visually-hidden">Любимое</h2>
                    <p class="profile__description">Здесь отображаются отмеченные вами рисунки.</p>
                  </div>
                  <?php
                  $album_arts = "SELECT works_title, works_image FROM `favorite` WHERE user_id = $session_id ORDER BY `id` DESC";
                  $arts_query = $pdo->query($album_arts);
                  $album_name = array();
                  $album_src = array();
                  while($art = $arts_query->fetch(PDO::FETCH_OBJ)) {
                    $album_name[] = $art->works_title;;
                    $album_src[] = $art->works_image;
                  } 
                  $arts_count = count($album_name);
                  ?>
                  <section class="gallery gallery-no-js">
                    <div class="slider__container">
                      <ul class="slider__list">
                        <?php for($i = 0; $i < $arts_count; $i++) {?>
                        <li class="slider__item">
                        
                          <h3 class="works__title album-slider__title"><?=$album_name[$i]?></h3><a name="<?=$i?>"></a>
                          <img class="slider__img" src="img/<?=$album_src[$i]?>.jpg" width="768px" alt="<?=$album_name[$i]?>">
                          <div class="count count-no-js"><span>1/7</span></div>
                        </li> 
                        <?php }?>
                      </ul> 
                      <div class="count count-js"> 
                        <span class="count__current">1</span> из 
                        <span class="count__total">5</span> 
                      </div>
                      
                      </div>
                      <button class="slider__next album-slider__next"><!-- Следущий --></button> 
                      <button class="slider__prev album-slider__prev"><!-- Предыдущий--></button> 
                      <ul class="slider__dots"> 
                      </ul> 
                  </section>
                </div>
              </section>
          <section class="profile__content fade">
            <div class="profile__container profile__container--single">
              <h2 class="visually-hidden">Настройки</h2>
              <form enctype="multipart/form-data" class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="327680">
                <p class="form-settings__wrapper">
                <?php echo $avatar_text; ?>
                  <label for="new_picture" class="form-settings__sign">Файл изображения:</label>
                  <input type="hidden" name="avatar" value="<?php if (!empty($avatar)) echo $avatar; ?>" />
                  <input id="new_picture" class="profile__avatar-btn" type="file" name="new_picture">
                </p>
                <button class="profile__btn" type="submit" name="upload" value="upload">Сохранить</button>
              </form>
              <form class="form-settings"  action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <span class="form-settings__sign">Ваш пол:</span>
                <p class="form-settings__wrapper">
                  <input class="checkbox login__info-checkbox" type="radio" id="undfind" name="gender" value="I"
                    <?php if ($gender == 'I') echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="undfind">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Не указан
                  </label>
                  <input class="checkbox login__info-checkbox" type="radio" id="woman" name="gender" value="F"
                    <?php if ($gender == 'F') echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="woman">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Женский</label>
                  <input class="checkbox login__info-checkbox" type="radio" id="men" name="gender" value="M"
                    <?php if ($gender == 'M') echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="men">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Мужской</label>
                </p>
                <p class="form-settings__wrapper">
                  <label class="form-settings__sign" for="date">Дата рождения: </label>
                  <input class="input" type="date" id="date" name="birthdate"
                    value="<?php echo $birthdate; ?>">
                </p>
                <button class="profile__btn" type="submit" value="enter" name="submit">Сохранить</button>
              </form>
              <a class="profile__delete" href="./deleteUser.php">Удалить профиль</a>
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <script src="js/profile.js"></script>
  <?php require_once(BLOCKS . 'scripts-include.php'); ?>
  <script src="js/album-slider.js"></script>
  <script>
  let totalCountLetter = 600;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  if (countInput != null) {
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCountLetter - countInput.value.length;
  });
};
  </script>
</body>

</html>
