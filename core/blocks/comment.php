<a name="anchor"></a>
<?php  require_once(BUS .'send_comment.php');
$anchor = '#anchor';
$action_link = BUS .'send_comment.php';
  if (!isset($_SESSION['user_id'])) {
    echo "<p class='reviews__form-title'>Пожалуйста, авторизуйтесь, чтобы делиться впечатлениями.</p>";
  }
  else { ?>
<h2 class="reviews__form-title">Поделиться впечатлениями</h2>
<form id="reviews__form" action="<?=$action_link?>" class="reviews__form" method="post">
<input id="user" type="hidden" name="user" value="<?php echo $_SESSION['username']?>">
<input id="article_id" type="hidden" name="article_id" value="<?php echo $_GET["id"]?>">
<input id="author_id" type="hidden" name="author_id" value="<?php echo $_SESSION['user_id'];?>">
  <p class="input__wrapper input__wrapper--flex">
    <label class="visually-hidden" for="reviews">Здесь вы можете оставить свой отзыв:</label>
    <textarea class="input reviews__massage countInput" id="reviews" maxlength="600" name="reviews"
      placeholder="ваш отзыв" required></textarea>
    <p class="count-letter">Осталось <span class="count-letter_symbol">600</span> знаков</p>
  </p>
  <!-- <p class="attention attention--user_msg attention--succeful-comment"></p> -->
  <?php
    if (isset($user_msg)) {
      if ($succeful) {
        echo '<p class="attention attention--user_msg attention--succeful-comment">' . $user_msg . '</p>';
      }
      else {
        echo '<p class="attention attention--user_msg">' . $user_msg . '</p>'; 
      }
    }
    ?>
  <button class="button feedback__button" name="submit" type="submit">Выразить мнение</button>
</form>
<?php } 
 require_once(BLOCKS .'reviews.php');
 ?>

