<div class="reviews__list">
  <?php
   require_once('./core/business/appvars.php');
   require_once(BUS . 'connectvars.php');
   // подключение к базе данных
   require_once(BUS.'/mysql__connect.php');
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
    if($rowUser == 0) {
      $userPic = 'delete.jpg';
    } else {
      $userPic = $rowUser->avatar;
    }
    echo "<blockquote class='reviews__item'>
              <div class='header-title'>
                <cite class='header-title__title reviews__author-name'>$user_name</cite><time class='reviews__time' datetime='$row->date'>$row->date</time>
              </div>
              <div class='reviews__author-picture'><img alt='Фото $user_name' class='reviews__author-image' src='./img/user/$userPic' width='70' height='70'></div>
              <p class='reviews__text'>$row->comment</p>
              </blockquote>";;
  }
  ?>
</div>