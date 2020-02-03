<?php require_once(BUS .'send_comment.php');
  if (!isset($_SESSION['user_id'])) {
    echo "<p class='reviews__form-title'>Пожалуйста, авторизуйтесь, чтобы делиться впечатлениями.</p>";
  }
  else { ?>
<h2 class="reviews__form-title">Поделиться впечатлениями</h2>
<form action="/book.php?id=<?=$_GET['id']?>" class="reviews__form" method="post">
  <p class="input__wrapper input__wrapper--flex">
    <label class="visually-hidden" for="reviews-massage">Здесь вы можете оставить свой отзыв:</label>
    <textarea class="input reviews__massage countInput" id="reviews-massage" maxlength="600" name="reviews"
      placeholder="ваш отзыв" required></textarea>
    <p class="count-letter">Осталось <span class="count-letter_symbol">600</span> знаков</p>
  </p>
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
<?php } ?>
