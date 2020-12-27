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
  $new_picture = trim(filter_var($_FILES['new_picture']['name'], FILTER_SANITIZE_STRING));
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
?>
<!DOCTYPE html>
<html lang="ru">

<head>
<?php
    $website_title = 'Профиль пользователя';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
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
     $birthdate = $row->birthdate;
   }

   if(isset($_POST['submit'])) {
    $gender = trim(filter_var($_POST['gender'], FILTER_SANITIZE_STRING));
    $birthdate = trim(filter_var($_POST['birthdate'], FILTER_SANITIZE_STRING));

    $sql = "UPDATE user SET gender = '$gender', birthdate = '$birthdate' WHERE user_id = '$session_id'";
    $query = $pdo->prepare($sql);
    $query->execute([$gender, $birthdate, $session_id]);

    $pdo = null;
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
          <!-- <section class="profile__content fade">
              <div class="profile__container profile__container--single">
                  <h2 class="visually-hidden">Общая информация</h2>
                  <p class="profile__description"><span class="profile__desc-key">Дата рождения:</span>
                      01.12.1995</p>
                  <p class="profile__description"><span class="profile__desc-key">Пол:</span> не указан</p>
                  <p class="profile__description"><span class="profile__desc-key">Визитка:</span><br> Таким
                      образом, высокотехнологичная концепция
                      общественного уклада не оставляет шанса для позиций, занимаемых участниками
                      в отношении поставленных задач. Но сторонники тоталитаризма в науке призваны
                      к ответу. Разнообразный и богатый опыт говорит нам, что сплоченность команды
                      профессионалов предполагает независимые способы реализации системы обучения
                      кадров, соответствующей насущным потребностям. Лишь акционеры крупнейших компаний,
                      инициированные исключительно синтетически, ограничены исключительно образом
                      мышления. Задача организации, в особенности же разбавленное изрядной долей
                      эмпатии, рациональное мышление требует от нас анализа экспериментов,
                      поражающих по своей масштабности и грандиозности.
                  </p>
                  <p class="profile__description"><span class="profile__desc-key">Электронная почта:</span> <a
                          class="link link--profile" href="mailto:<?php echo ''.$_SESSION['user_email'].'' ?>"><?php echo ''.$_SESSION['user_email'].'' ?></a>
                  </p>
              </div>
              </section>
              <section class="profile__content fade">
              <div class="profile__container profile__container--single">
                  <h2 class="visually-hidden">Закладки</h2>
                  <p class="profile__description">Здесь будут отображаться оставленные вами закладки в
                      произведениях.</p>
              </div>
              </section>
              <section class="profile__content fade">
              <div class="profile__container profile__container--single">
                  <h2 class="visually-hidden">Любимое</h2>
                  <p class="profile__description">Здесь будут отображаться отмеченные вами произведения
                      или
                      рисунки.</p>
              </div>
              </section> -->
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
              <?php
                
                  // Validate and move the uploaded picture file, if necessary
                  //    if (!empty($avatar)) {
                  //      if ((($avatar_type == 'image/gif') || ($avatar_type == 'image/jpeg') || ($avatar_type == 'image/pjpeg') ||
                  //        ($avatar_type == 'image/png')) && ($avatar_size > 0) && ($avatar_size <= MM_MAXFILESIZE)) {
                  //        if ($_FILES['file']['error'] == 0) {
                  //          // Move the file to the target upload folder
                  //          $target = MM_UPLOADPATH . basename($avatar);
                  //          if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
                  //  // The new picture file move was successful, now make sure any old picture is deleted
                  //            if (!empty($old_picture) && ($old_picture != $avatar)) {
                  //             @unlink(MM_UPLOADPATH . $old_picture);
                  //            }
                  //          }
                  //          else {
                  // // The new picture file move failed, so delete the temporary file and set the error flag
                  //            @unlink($_FILES['avatar']['tmp_name']);
                  //            $error = true;
                  //            echo '<p class="error">Sorry, there was a problem uploading your picture.</p>';
                  //          }
                  //        }
                  //      }
                  //     else {
                  //        // The new picture file is not valid, so delete the temporary file and set the error flag
                  //        @unlink($_FILES['avatar']['tmp_name']);
                  //        $error = true;
                  //        echo '<p class="error">Your picture must be a GIF, JPEG, or PNG image file no greater than ' . (MM_MAXFILESIZE / 1024) .
                  //          ' KB in size.</p>';
                  //      }
                  //    }
                  // Update the profile data in the database

                      // Only set the picture column if there is a new picture
                      //  if (!empty($new_picture)) {
                      //    $query = "UPDATE user SET gender = '$gender', birthdate = '$birthdate', "
                      //    . "user_other = '$other', text = '$self', picture = '$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      //  }
                      //  else {


                          // $query = "UPDATE user SET gender = '$gender', birthdate = '$birthdate', "
                          // . "user_other = '$other', text = '$self' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      //  }


                      // Confirm success with the user






                  //  else {
                  //     // Grab the profile data from the database



                  //   }

                  ?>
              <!-- <p class="form-settings__wrapper">
                  <label class="form-settings__sign" for="login">Сменить логин:</label>
                  <input class="input" id="login" type="text">
                  </p>
                  <p class="form-settings__wrapper">
                  <label class="form-settings__sign" for="email">Сменить электронную почту:</label>
                  <input class="input" id="email" type="email">
                  </p> -->
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
</body>

</html>
