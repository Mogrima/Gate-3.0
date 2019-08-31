<?php
session_start();

// If the session vars aren't set, try to set them with a cookie
if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
        $_SESSION['user_id']  = $_COOKIE['user_id'];
        $_SESSION['username'] = $_COOKIE['username'];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <title>Добавить изображение</title>
</head>
<body>
    <?php
require_once('appvars.php');
require_once('connectvars.php');
// Make sure the user is logged in before going any further.
if (!isset($_SESSION['user_id'])) {
    echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
    exit();
} else {
    echo ('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="logout.php">Log out</a>.</p>');
}

?>
    <?php
$dbc         = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$userquery   = "SELECT avatar, gender FROM user WHERE user_id = '" . $_SESSION['user_id'] . "'";
$userData    = mysqli_query($dbc, $userquery);
$userProfile = mysqli_fetch_array($userData);

$avatar = $userProfile['avatar'];

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
                    
                    echo '<p>Вы изменили аватар</p>';
                    
                    mysqli_close($dbc);
                } else {
                    @unlink($_FILES['new_picture']['tmp_name']);
                    echo '<p>Извините, возникла ошибка при загрузке файла изображения.</p>';
                }
            }
        } else {
            echo '<p> Файл, подтверждающий рейтинг, должен быть файлом изображения в форматах GIF, JPEG или PNG, и его размер не должен превыmать ' . (MM_MAXFILESIZE / 1024) . ' KB.</p>';
        }
        @unlink($_FILES['new_picture']['tmp_name']);
    }
    
    else {
        echo '<p>Не было внесено никакой информации</p>';
    }
}
?>
    <form class="form-addnews" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="327680">
        <label for="new_picture">Файл изображения:</label>
        <input type="hidden" name="avatar" value="<?php if (!empty($avatar)) echo $avatar; ?>" />
        <input class="input" id="new_picture" type="file" name="new_picture">
        <button class="button addnews-button" type="submit" name="submit">Добавить</button>
    </form>
    <?php if (true) {
    echo '<img class="profile" src="' . MM_UPLOADPATH . $avatar . '" alt="Profile Picture" />'; } ?>
    <a href="index.php">На главную</a>
</body>
</html>