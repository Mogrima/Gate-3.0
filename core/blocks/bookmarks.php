<?php
  if (isset($_SESSION['user_id'])) {
      if(empty($bookmark) || $bookmark != $current_url) {
  ?>
<form action="<?php echo $current_url ?>" method="POST">
  <button type="submit" value="submit" name="submit">Добавить закладку</button>
</form>
<?php } 
  }
 ?>
