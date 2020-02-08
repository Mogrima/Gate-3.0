<section class="news">
    <h2 class="section-header"><?=$news_title?></h2>
    <ul class="news__list">
    <?php
    while($row = $query->fetch(PDO::FETCH_OBJ)) {
    // задаю через переменную путь к изображению
    $news_image_src = '../img/'.$row->screenshot;
   echo "<li class='news__item clearfix'>
        <div class='header-title'>
        <h3 class='header-title__title'><a class='header-title__link' href='news-1.html'>$row->title</a></h3><time
            class='header-title__date' datetime='2016-01-11'>$row->date</time>
        </div>
        <img alt='Рисунок новости' class='news__picture' height='123' src='$news_image_src' width='121'>
        <p class='news__text'>$row->intro</p><a class='button news__button'
        href='news.php?id=$row->id&amp;page=$page'>Читать далее</a>
    </li>";
    } ?>
    </ul>
</section>