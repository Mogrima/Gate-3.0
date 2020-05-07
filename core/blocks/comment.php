<?php require_once(BUS .'send_comment.php');
  if (!isset($_SESSION['user_id'])) {
    echo "<p class='reviews__form-title'>Пожалуйста, авторизуйтесь, чтобы делиться впечатлениями.</p>";
  }
  else { ?>
<h2 class="reviews__form-title">Поделиться впечатлениями</h2>
<form action="<?=$link_comment;?><?=$link_comment_get?>" class="reviews__form" method="post">
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
<div class="reviews__list">
  <?php
  // помещаем номер страницы из массива GET в переменую $page
    $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
    // количество статей на страницу
  $on_page = 3;

  // (номер страницы - 1) * статей на страницу
  $shift = ($page - 1) * $on_page;
  $sql = "SELECT * FROM $comments_table WHERE `article_id` = $book_id ORDER BY `date` DESC LIMIT $shift, $on_page";
  $result = $pdo->query($sql);
  while($row = $result->fetch(PDO::FETCH_OBJ)) {
    $user_id = $row->author_id;
    $queryUser = "SELECT username, avatar FROM user WHERE `user_id` = $user_id";
    $resultUser = $pdo->query($queryUser);
    $rowUser = $resultUser->fetch(PDO::FETCH_OBJ);
    $userPic = $rowUser->avatar;
    echo "<blockquote class='reviews__item'>
              <div class='header-title'>
                <cite class='header-title__title reviews__author-name'>$rowUser->username</cite><time class='reviews__time' datetime='$row->date'>$row->date</time>
              </div>
              <div class='reviews__author-picture'><img alt='Фото $rowUser->username' class='reviews__author-image' src='$userPic' width='70' height='70'></div>
              <p class='reviews__text'>$row->comment</p>
              </blockquote>";;
  }
  ?>
</div>
