<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
<?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Профиль пользователя';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<?php
    // Make sure the user is logged in before going any further.
    if (!isset($_SESSION['user_id'])) {
      echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
      exit();
    }
    else {
      echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="' .BUS. '/logout.php">Log out</a>.</p>');
    }
    $avatar_text = '';
    ?>
<?php
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    echo 'вывод данных формы';
    $userquery = "SELECT user_other, gender, text, birthdate, avatar FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    $userData = mysqli_query($dbc, $userquery);
    $userProfile = mysqli_fetch_array($userData);

      $user_other1 = $userProfile['user_other'];
      $gender1 = $userProfile['gender'];
      $aboutself1 = $userProfile['text'];
      $birthdate1 = $userProfile['birthdate'];
      $avatar = $userProfile['avatar'];

    if (isset($_POST['submit'])) {
      $user_other = mysqli_real_escape_string($dbc, trim($_POST['user_other']));
      $gender = mysqli_real_escape_string($dbc, trim($_POST['gender']));
      $aboutself = mysqli_real_escape_string($dbc, trim($_POST['aboutself']));
      $birthdate = mysqli_real_escape_string($dbc, trim($_POST['birthdate']));

      $error = false;

      if (!$error) {
        // echo 'вошел в блок !error';
        // // $query =  "UPDATE user SET user_other = '$user_other', gender = '$gender', text = '$aboutself', birthdate = '$birthdate' WHERE user_id = '" . $_SESSION['user_id'] . "'";
        // mysqli_query($dbc, $query);
        // echo '<p>Your profile has been successfully updated. Would you like to <a href="viewprofile.php">view your profile</a>?</p>';
        // // exit();
      }

      else {
        echo '<p>вылезла ошибка error</p>';
      }

    } // End of check for form submission
    // else {
    //   echo 'вывод данных формы';
    //   $query = "SELECT user_other, gender, text, birthdate FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
    //   $data = mysqli_query($dbc, $query);
    //   $row = mysqli_fetch_array($data);
    //   if ($row != NULL) {
    //     $user_other = $row['user_other'];
    //     $gender = $row['gender'];
    //     $aboutself = $row['text'];
    //     $birthdate = $row['birthdate'];

    //   }
    //   else {
    //     echo '<p class="error">There was a problem accessing your profile.</p>';
    //   }
    // }
    ?>

<body class="page">
  <div class="background-header"></div>
  <?php require_once BLOCKS .'header.php' ?>
  <?php require_once BLOCKS .'main-navigation.php' ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
      <?php require_once(BUS. '/adminSession.php'); ?>
        <div class="page-main__head">
          <h1 class="title"><?php echo ''.$_SESSION['username'].'' ?></h1>
          <<?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <picture class="profile__avatar">
          <source srcset="<?php echo $avatar?>" width="350" height="394" media="(min-width: 768px)">
          <img class="profile__avatar-img" src="img/user/user-avatar2x.png" alt="аватар пользователя">
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
              <a href="#" class="profile__toggle profile__exit" title="Выйти">
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
                <?php
                    if (isset($_POST['submit'])) {
                      $currentAvatar    = mysqli_real_escape_string($dbc, trim($_POST['avatar']));
                      $new_picture = mysqli_real_escape_string($dbc, trim($_FILES['new_picture']['name']));
                      $new_picture_type = $_FILES['new_picture']['type'];
                      $new_picture_size = $_FILES['new_picture']['size'];
                      if (!empty($new_picture)) {
                          if ((($new_picture_type == 'image/gif') || ($new_picture_type == 'image/jpeg') || ($new_picture_type == 'image/pjpeg') || ($new_picture_type == 'image/png')) && ($new_picture_size > 0) && ($new_picture_size <= MM_MAXFILESIZE)) {
                              if ($_FILES['new_picture']['error'] == 0) {

                                  $target = MM_UPLOADPATH . basename($new_picture);

                                  if (move_uploaded_file($_FILES['new_picture']['tmp_name'], $target)) {
                                      if (!empty($currentAvatar) && ($currentAvatar != $new_picture) && ($currentAvatar != 'default.png')) {
                                          @unlink(MM_UPLOADPATH . $currentAvatar);
                                      }

                                      $query = "UPDATE user SET avatar = '$new_picture' WHERE user_id = '" . $_SESSION['user_id'] . "'";

                                      mysqli_query($dbc, $query);
                                      $avatar_text = '<p class="profile__avatar-btn">Вы изменили аватар, перезагрузите страницу, чтобы изменения вступили в силу</p>';
                                      echo $avatar_text;

                                      mysqli_close($dbc);
                                  } else {
                                      @unlink($_FILES['new_picture']['tmp_name']);
                                      $avatar_text = '<p class="profile__avatar-btn">Извините, возникла ошибка при загрузке файла изображения.</p>';
                                      echo $avatar_text;
                                  }
                              }
                          } else {
                            @unlink($_FILES['new_picture']['tmp_name']);
                            $avatar_text = '<p class="profile__avatar-btn"> Изображение для аватара должно быть в формате GIF, JPEG или PNG, и его размер не должен превыmать ' . (MM_MAXFILESIZE / 1024) . ' KB.</p>';
                            echo $avatar_text;

                            }
                      } else {
                        $avatar_text = '<p class="profile__avatar-btn">Не было внесено никакой информации</p>';
                        echo $avatar_text;
                      }
                    }
                    ?>
                <p class="form-settings__wrapper">
                  <label for="new_picture" class="form-settings__sign">Файл изображения:</label>
                  <input type="hidden" name="avatar" value="<?php if (!empty($avatar)) echo $avatar; ?>" />
                  <input id="new_picture" class="profile__avatar-btn" type="file" name="new_picture">
                </p>
                <button class="profile__btn" type="submit" name="submit" value="enter">Сохранить</button>
              </form>
              <form class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                    if (!empty($user_other)) {
                      $query =  "UPDATE user SET user_other = '$user_other' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      mysqli_query($dbc, $query);
                      echo '<p>Вы изменили сведения о дополнительных контактах</p>';
                    }
                    ?>
                <p class="form-settings__wrapper">
                  <label class="form-settings__sign" for="contact">Добавить контакты:</label>
                  <input class="input" id="contact" name="user_other"
                    value="<?php if (!empty($user_other)) echo $user_other; else { echo $user_other1;} ?>" type="text">
                </p>
                <button class="profile__btn" type="submit" value="enter" name="submit">Сохранить</button>
              </form>
              <form class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                    if (!empty($gender)) {
                      $query =  "UPDATE user SET gender = '$gender' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      mysqli_query($dbc, $query);
                      $avatar_text = '';
                      echo '<p>Вы изменили сведения о поле</p>';
                    }
                  ?>
                <span class="form-settings__sign">Ваш пол:</span>
                <p class="form-settings__wrapper">
                  <input class="checkbox login__info-checkbox" type="radio" id="undfind" name="gender" value="I"
                    <?php if ((!empty($gender) && $gender == 'I') || ($gender1 == 'I')) echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="undfind">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Не указан
                  </label>
                  <input class="checkbox login__info-checkbox" type="radio" id="woman" name="gender" value="F"
                    <?php if ((!empty($gender) && $gender == 'F') || ($gender1 == 'F')) echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="woman">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Женский</label>
                  <input class="checkbox login__info-checkbox" type="radio" id="men" name="gender" value="M"
                    <?php if ((!empty($gender) && $gender == 'M') || ($gender1 == 'M')) echo 'checked = "checked"'; ?>>
                  <label class="checkbox__name login__checkbox-name" for="men">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Мужской</label>
                </p>
                <button class="profile__btn" type="submit" value="enter" name="submit">Сохранить</button>
              </form>
              <form class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                    if (!empty($aboutself)) {
                      $query =  "UPDATE user SET text = '$aboutself' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      mysqli_query($dbc, $query);
                      echo '<p>Вы изменили сведения о дополнительных контактах</p>';
                    }
                    ?>
                <p class="form-settings__wrapper">
                  <label class="form-settings__sign form-settings__sign--mb" for="aboutself">Визитка:</label>
                  <textarea class="input form-settings__text" name="aboutself" id="aboutself" cols="30"
                    rows="10"><?php if (!empty($aboutself)) echo $aboutself; else { echo $aboutself1;} ?></textarea>
                </p>
                <button class="profile__btn" type="submit" value="enter" name="submit">Сохранить</button>
              </form>
              <form class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <?php
                    if (!empty($birthdate)) {
                      $query =  "UPDATE user SET birthdate = '$birthdate' WHERE user_id = '" . $_SESSION['user_id'] . "'";
                      mysqli_query($dbc, $query);
                      echo '<p>Вы изменили сведения о дне рожденье</p>';
                    }
                    ?>
                <p class="form-settings__wrapper">
                  <label class="form-settings__sign" for="date">Дата рождения: </label>
                  <input class="input" type="date" id="date" name="birthdate"
                    value="<?php if (!empty($birthdate)) echo $birthdate; else { echo $birthdate1;} ?>">
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
              <a class="profile__delete" href="#">Удалить профиль</a>
            </div>
          </section>
        </div>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <script src="js/profile.js"></script>
  <script src="js/scripts.min.js"></script>
</body>

</html>
