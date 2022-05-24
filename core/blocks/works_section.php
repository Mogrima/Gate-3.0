<?php $sectionTitleOn;?>
<section class="works">
  <a name="anchor"></a>
  <?php if($sectionTitleOn) {
    echo '<h2 class="section-header">' .$works_title.'</h2>';
  } else {
    echo '<h2 class="visually-hidden">' .$works_title.'</h2>';
  } 

  $newHtmlClassON;
  $descOff;
  
  if($newHtmlClassON) {
    echo '<div class="works__wrapper' .$newHtmlClass. '">';
  } else {
   echo '<div class="works__wrapper">';
  }?>
  
  <?php
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
        // задаю через переменную путь к изображению
      $image = explode('.', $row->works_image);
        if($image[1] != NULL) {
          $src = $image[0];
          $type = '.' . $image[1];
        } else {
          $src = $image[0];
          $type = '.jpg';
        }
      $works_image_src = $src_stat.$src.$type;
      if($row->works_title == 'Легенды') { ?>
        <figure class='works__item'>
          <figcaption class='works__title'><?=$row->works_title?></figcaption>
          <img alt='<?=$row->works_title?>' class='works__image' height='347' src='img/ОбложкаЛегенды.jpg' width='258'>
          <p class='works__description'><?=$row->works_desc?></p> 
          <a class='button works__button' href='inner-album.php'>Открыть</a>
        </figure>
     <?php }
      else {
        $dinamyc_link = ($row->album_id) ? $row->album_id : $row->id;
        $dinamyc_link = $works_link . $dinamyc_link; ?>
        <figure class='works__item'>
          <figcaption class='works__title'><?=$row->works_title?></figcaption>
          <?php if (!$descOff) { ?>
          <img alt='<?=$row->works_title?>' class='works__image' height='347' src='<?=$works_image_src?>' width='258'>
          <p class='works__description'><?=$row->works_desc?></p> 
          <?php } else { ?>
          <img alt='<?=$row->works_title?>' class='works__image works__image--mb' height='347' src='<?=$works_image_src?>' width='258'>
          <?php } ?>
          <a class='button works__button' href='<?=$dinamyc_link?>'>Открыть</a>
        </figure>
      <?php } 
    }
  ?>
</section>
