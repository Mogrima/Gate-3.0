<?php 

////////////////////////// Динамическое добавление активного класса к текущему пункту меню + для страниц подменю
$menu_active = array("Новости"=> "", 
                      "Книги"=>"", 
                      "Галерея" => "", 
                      "О нас" => "",
                      "Отзывы" => "",
                      "FAQ" => "");

$menu = array("Новости"=>"//index.php", 
                "Книги"=>"//works-catalog.php", 
                "Галерея" => "//gallery.php", 
                "О нас" => "//about.php",
                "Отзывы" => "//reviews.php",
                "FAQ" => "//FAQ.php");

$i = 0;
$num_menu;
foreach ($menu as $item) {
  if($_SERVER["REQUEST_URI"] == $item) {
    $num_menu = $i;
  }
  $i++;
}

$menu_active[$num_menu] = "page-navigation__item--active";

// echo print_r($menu_active);
///////////////////// Конец /////////////////////////////////////////////////////////////////////////
?>