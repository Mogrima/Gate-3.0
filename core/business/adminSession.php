<?php
  if ($_SESSION['user_id'] != '22') {
  echo '<p class="login">Please <a href="login.php">log in</a> to access this page.</p>';
  exit();
  }
  else if ($_SESSION['user_id'] == '22') {
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '. <a href="../../logout.php">Log out</a>.</p>');
  }
?>
