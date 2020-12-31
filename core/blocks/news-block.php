<section class="news">
    <h2 class="section-header"><a name="news"></a><?=$news_title?></h2>
    <ul class="news__list">
    <?php
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
    // задаю через переменную путь к изображению
    $news_image_src = '../img/news/'.$row->screenshot;
    $date = $row->date;
    $date = date('d-m-Y', strtotime($date));
   echo "<li class='news__item clearfix'>
        <div class='header-title'>
        <h3 class='header-title__title'><a class='header-title__link' href='news.php?id=$row->id&amp;page=$page'>$row->title</a></h3><time
            class='header-title__date' datetime='2016-01-11'>$date</time>
        </div>
        <img alt='$row->title' class='news__picture' height='123' src='$news_image_src' width='121'>
        <p class='news__text'>$row->intro</p><a class='button news__button'
        href='news.php?id=$row->id&amp;page=$page'>Читать далее</a>
    </li>";
    } ?>
    </ul>
</section>