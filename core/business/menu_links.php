<?php 

////////////////////////// Динамическое добавление активного класса к текущему пункту меню + для страниц подменю

$adress_current = $_SERVER["REQUEST_URI"];
// echo "<p style='color: pink;'>Адрес текущей страницы " . $adress_current . "</p>";
preg_match_all('|/(.+).php|isU', $adress_current, $arr);
$url_active = $arr[0][0];
// echo "<p style='color: pink;'>Адрес текущей страницы " . $url_active . "</p>";

$menu_active = array("Новости"=> "", 
                      "Книги"=>"", 
                      "Галерея" => "", 
                      "О нас" => "",
                      "Отзывы" => "",
                      "FAQ" => "");

$menu = array("Новости"=>"/index.php", 
                "Книги"=>"/works-catalog.php", 
                "Галерея" => "/gallery.php", 
                "О нас" => "/about.php",
                "Отзывы" => "/reviews.php",
                "FAQ" => "/FAQ.php");

if ($url_active == '/news.php') {
  $url_active = "/index.php";
}

if ($url_active == '/album.php') {
  $url_active = "/gallery.php";
}

if ($url_active == '/book.php') {
  $url_active = "/works-catalog.php";
}

if ($url_active == '/inner-album.php') {
  $url_active = "/gallery.php";
}

if (($url_active == '/login.php') || ($url_active == '/registration.php')) {
  $url_active = "/index.php";
}

$i = 0;
$num_menu;
foreach ($menu as $item) {
  if($url_active == $item) {
    $num_menu = $i;
  }
  $i++;
}

$menu_active[$num_menu] = "page-navigation__item--active";

// echo print_r($menu_active);
///////////////////// Конец /////////////////////////////////////////////////////////////////////////
?>