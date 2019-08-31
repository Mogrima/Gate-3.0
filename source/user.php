<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
  ?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta charset="UTF-8">
    <title>Профиль пользователя</title>
    <link href="img/favicon.png" rel="apple-touch-icon" sizes="180x180">
    <link href="img/favicon.png" rel="icon" sizes="32x32" type="image/png">
    <link href="img/favicon.png" rel="icon" sizes="16x16" type="image/png">
    <link href="/site.webmanifest" rel="manifest">
    <link color="#5bbad5" href="img/favicon.png" rel="mask-icon">
    <meta content="#da532c" name="msapplication-TileColor">
    <meta content="#ffffff" name="theme-color">
    <link href="https://fonts.googleapis.com/css?family=Cormorant+Infant:400,600,700&amp;subset=cyrillic"
      rel="stylesheet">
    <link rel="stylesheet" href="../slick/min.slick.css">
    <link href="css/style.min.css" rel="stylesheet">
  </head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
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
    <header class="page-header">
      <div class="page-header__wrapper">
        <a class="page-header__logo"><img class="page-header__logo-image" alt="Логотип Врата" width="164"
          height="54" src="img/Logo.png"></a>
        <nav class="profile-menu profile-menu--nojs profile-menu--closed">
          <button class="profile-menu__button" type="button">
          <img src="<?php echo $avatar?>" width="70" height="70" alt="меню пользователя">
          <span class="profile__name"><?php echo ''.$_SESSION['username'].'' ?></span>
          <span class="visually-hidden">Открыть</span>
          </button>
          <ul class="profile-menu__list">
            <li class="profile-menu__item">
              <a class="profile-menu__link" href="profile.html">Перейти в личный кабинет</a>
            </li>
            <li class="profile-menu__item">
              <a class="profile-menu__link profile-menu__link--bottom" href="logout.php">Выйти</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
    <nav class="page-navigation page-navigation--closed page-navigation--nojs">
      <button class="page-navigation__toggle" type="button"><span class="visually-hidden">Открыть меню</span></button>
      <ul class="page-navigation__list">
        <li class="page-navigation__item page-navigation__item--active">
          <a class="page-navigation__link" href="index.php">Новости</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--green" href="../works-catalog.html">Книги</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--yellow" href="../gallery.html">Галерея</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--peach" href="../about.html">О нас</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--lilac" href="../reviews.html">Отзывы</a>
        </li>
        <li class="page-navigation__item">
          <a class="page-navigation__link page-navigation__link--purple" href="../FAQ.html">FAQ</a>
        </li>
      </ul>
    </nav>
    <main class="page-main">
      <div class="container">
        <div class="substrate">
          <div class="page-main__head">
            <h1 class="title"><?php echo ''.$_SESSION['username'].'' ?></h1>
            <div class="search-block">
              <input class="search-block__input" placeholder="Поиск..." type="text"> <span class="search-block__icon"></span>
            </div>
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
                  <span
                    class="visually-hidden">Выйти</span>
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
                <form enctype="multipart/form-data" class="form-settings" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
                     }

                     else {
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
                    <input class="input" id="contact" name="user_other" value="<?php if (!empty($user_other)) echo $user_other; else { echo $user_other1;} ?>" type="text">
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
                    <input class="checkbox login__info-checkbox" type="radio" id="undfind" name="gender"
                      value="I" <?php if ((!empty($gender) && $gender == 'I') || ($gender1 == 'I')) echo 'checked = "checked"'; ?>>
                    <label class="checkbox__name login__checkbox-name" for="undfind">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Не указан
                    </label>
                    <input class="checkbox login__info-checkbox" type="radio" id="woman" name="gender"
                      value="F" <?php if ((!empty($gender) && $gender == 'F') || ($gender1 == 'F')) echo 'checked = "checked"'; ?>>
                    <label class="checkbox__name login__checkbox-name" for="woman">
                    <span class="checkbox__indicator login__checkbox-indicator"></span>
                    Женский</label>
                    <input class="checkbox login__info-checkbox" type="radio" id="men" name="gender"
                      value="M" <?php if ((!empty($gender) && $gender == 'M') || ($gender1 == 'M')) echo 'checked = "checked"'; ?>>
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
                    <textarea class="input form-settings__text" name="aboutself" id="aboutself" cols="30" rows="10"><?php if (!empty($aboutself)) echo $aboutself; else { echo $aboutself1;} ?></textarea>
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
                    <input class="input" type="date" id="date" name="birthdate" value="<?php if (!empty($birthdate)) echo $birthdate; else { echo $birthdate1;} ?>" >
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
    <footer class="page-footer">
      <div class="page-footer__wrapper">
        <nav class="footer-navigation">
          <ul class="footer-navigation__list">
            <li class="footer-navigation__item">
              <a class="footer-navigation__link footer-navigation__link--current"><img alt="Врата" height="30"
                src="../img/Logo.png" width="100"></a>
            </li>
            <li class="footer-navigation__item">
              <a class="footer-navigation__link" href="works-catalog.html">Книги</a>
            </li>
            <li class="footer-navigation__item">
              <a class="footer-navigation__link" href="gallery.html">Галерея</a>
            </li>
            <li class="footer-navigation__item">
              <a class="footer-navigation__link" href="about.html">О нас</a>
            </li>
            <li class="footer-navigation__item">
              <a class="footer-navigation__link" href="feedback.html">Отзывы</a>
            </li>
            <li class="footer-navigation__item">
              <a class="footer-navigation__link" href="FAQ.html">FAQ</a>
            </li>
          </ul>
        </nav>
        <p class="page-footer__copyright copyright"><b class="copyright__developers">Разработано: Ro&Mo</b><br>
          <span class="copyright__reserved">© Все права защищены. 2018</span>
        </p>
        <div class="footer-social">
          <b class="footer-social__title">Контакты для связи:</b>
          <ul class="footer-social__list">
            <li class="footer-social__item">
              <a href="#">
                <span class="visually-hidden">Вконтакте</span>
                <svg aria-hidden="true" class="svg-inline--fa fa-vk fa-w-18" data-icon="vk" data-prefix="fab" height="44" role="img" viewbox="0 0 576 512" width="44" xmlns="http://www.w3.org/2000/svg">
                  <path class="footer-social__icon-color" d="M545 117.7c3.7-12.5 0-21.7-17.8-21.7h-58.9c-15 0-21.9 7.9-25.6 16.7 0 0-30 73.1-72.4 120.5-13.7 13.7-20 18.1-27.5 18.1-3.7 0-9.4-4.4-9.4-16.9V117.7c0-15-4.2-21.7-16.6-21.7h-92.6c-9.4 0-15 7-15 13.5 0 14.2 21.2 17.5 23.4 57.5v86.8c0 19-3.4 22.5-10.9 22.5-20 0-68.6-73.4-97.4-157.4-5.8-16.3-11.5-22.9-26.6-22.9H38.8c-16.8 0-20.2 7.9-20.2 16.7 0 15.6 20 93.1 93.1 195.5C160.4 378.1 229 416 291.4 416c37.5 0 42.1-8.4 42.1-22.9 0-66.8-3.4-73.1 15.4-73.1 8.7 0 23.7 4.4 58.7 38.1 40 40 46.6 57.9 69 57.9h58.9c16.8 0 25.3-8.4 20.4-25-11.2-34.9-86.9-106.7-90.3-111.5-8.7-11.2-6.2-16.2 0-26.2.1-.1 72-101.3 79.4-135.6z" fill="currentColor"></path>
                </svg>
              </a>
            </li>
            <li class="footer-social__item">
              <a href="#">
                <span class="visually-hidden">Фейсбук</span>
                <svg aria-hidden="true" class="svg-inline--fa fa-facebook-f fa-w-9" data-icon="facebook-f" data-prefix="fab" height="35" role="img" viewbox="0 0 264 512" width="40" xmlns="http://www.w3.org/2000/svg">
                  <path class="footer-social__icon-color" d="M76.7 512V283H0v-91h76.7v-71.7C76.7 42.4 124.3 0 193.8 0c33.3 0 61.9 2.5 70.2 3.6V85h-48.2c-37.8 0-45.1 18-45.1 44.3V192H256l-11.7 91h-73.6v229" fill="currentColor"></path>
                </svg>
              </a>
            </li>
            <li class="footer-social__item">
              <a href="#">
                <span class="visually-hidden">Твиттер</span>
                <svg aria-hidden="true" class="svg-inline--fa fa-twitter fa-w-16" data-icon="twitter" data-prefix="fab" height="32" role="img" viewbox="0 0 512 512" width="32" xmlns="http://www.w3.org/2000/svg">
                  <path class="footer-social__icon-color" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z" fill="currentColor"></path>
                </svg>
              </a>
            </li>
            <li class="social-list__item">
              <a href="#">
                <span class="visually-hidden">Девианарт</span>
                <svg aria-hidden="true" class="svg-inline--fa fa-deviantart fa-w-10" data-icon="deviantart" data-prefix="fab" height="35" role="img" viewbox="0 0 320 512" width="35" xmlns="http://www.w3.org/2000/svg">
                  <path class="footer-social__icon-color" d="M320 93.2l-98.2 179.1 7.4 9.5H320v127.7H159.1l-13.5 9.2-43.7 84c-.3 0-8.6 8.6-9.2 9.2H0v-93.2l93.2-179.4-7.4-9.2H0V102.5h156l13.5-9.2 43.7-84c.3 0 8.6-8.6 9.2-9.2H320v93.1z" fill="currentColor"></path>
                </svg>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </footer>
    <script src="js/scripts.min.js"></script>
    <script src="js/profile.js"></script>
  </body>
</html>
