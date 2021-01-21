<?php
  if (isset($_SESSION['user_id'])) {
      if(empty($bookmark) || $bookmark != $current_url) {
  ?>
<form class="book-bookmark__form" action="<?php echo $current_url ?>" method="POST">
  <div class="tooltip">
    <button class="book-bookmark" type="submit" value="submit" name="submit"><span class="visually-hidden">Добавить закладку</span>
      <svg class="book-bookmark__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M106 0v512l150-145.789L406 512V0z" fill="#cccccc" />
      </svg>
    </button>
      <span class="tooltip__text">Добавить закладку</span>
  </div>
</form>
<?php } else if($bookmark == $current_url) { ?>
  <div class="book-bookmark__form tooltip">
    <button class="book-bookmark" type="submit" value="submit" name="button" disabled><span class="visually-hidden">Добавить закладку</span>
      <svg class="book-bookmark__icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M106 0v512l150-145.789L406 512V0z" fill="#efb818" />
      </svg>
    </button>
    <span class="tooltip__text">Закладка добавлена</span>
  </div>
<?php  }
  }
 ?>
