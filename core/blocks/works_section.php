<?php $sectionTitleOn;?>
<section class="works">
  <a name="anchor"></a>
  <?php if($sectionTitleOn) {
    echo '<h2 class="section-header">' .$works_title.'</h2>';
  } else {
    echo '<h2 class="visually-hidden">' .$works_title.'</h2>';
  } 

  $newHtmlClassON;
  
  if($newHtmlClassON) {
    echo '<div class="works__wrapper' .$newHtmlClass. '">';
  } else {
   echo '<div class="works__wrapper">';
  }?>
  
  <?php
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
        // задаю через переменную путь к изображению
      $works_image_src = $src_stat.$row->works_image;
      if($row->works_title == 'Легенды') {
        echo "<figure class='works__item'>
              <figcaption class='works__title'>$row->works_title</figcaption>
              <img alt='$row->works_title' class='works__image' height='347' src='img/ОбложкаЛегенды.jpg' width='258'>
              <p class='works__description'>$row->works_desc</p><a class='button works__button' href='inner-album.php'>Открыть</a>
            </figure>";
      }
      else {
        $dinamyc_link = ($row->album_id) ? $row->album_id : $row->id;
        echo "<figure class='works__item'>
              <figcaption class='works__title'>$row->works_title</figcaption>
              <img alt='$row->works_title' class='works__image' height='347' src='$works_image_src$type_image' width='258'>
              <p class='works__description'>$row->works_desc</p><a class='button works__button' href='$works_link$dinamyc_link'>Открыть</a>
            </figure>";
      }
    }
  ?>
</section>
