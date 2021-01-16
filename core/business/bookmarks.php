<?php 
require_once('./core/business/session.php');
$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$session_id = $_SESSION['user_id'];
$new_book = true;

  if (isset($_SESSION['user_id'])) {
    
$bookquery = "SELECT * FROM bookmarks WHERE user_id = '$session_id' AND title_book = '$title'";
$bookData = $pdo->prepare($bookquery);
$bookData->execute([$session_id, $title]);
$row = $bookData->fetch(PDO::FETCH_OBJ);

$bookmark = $row->bookmark;
$title_book = $row->title_book;

  if (!empty($title_book)) {
    $new_book = false;
  } 

  if(isset($_POST['submit'])) {
    $user_id = trim(filter_var($session_id, FILTER_SANITIZE_NUMBER_INT));
    $title_book = trim(filter_var($title, FILTER_SANITIZE_STRING));
    $bookmark = trim(filter_var($current_url, FILTER_SANITIZE_URL));

    if($new_book) {
      $bookmark_sql = "INSERT INTO bookmarks(user_id, title_book, bookmark) VALUES ('$user_id', '$title_book', '$bookmark')";
      $bookmark_query = $pdo->prepare($bookmark_sql);
      $bookmark_query->execute(['user_id' => $user_id, 'title_book' => $title_book, 'bookmark' => $bookmark]);
    } else {
      $bookmark_sql = "UPDATE bookmarks SET user_id = '$user_id', title_book = '$title_book', bookmark = '$bookmark' WHERE title_book = '$title_book' AND user_id = '$user_id'";
      $bookmark_query = $pdo->prepare($bookmark_sql);
      $bookmark_query->execute([$user_id, $title_book, $bookmark]);
    }
    Header('Location: '.$current_url);
  }
}

?>
