<?php
// получение полного количества новостей
$stmt = $pdo->query("SELECT COUNT(*) FROM comments WHERE article_id = $book_id");
$row = $stmt->fetch();
$c=$row[0]; //количество строк

$countPage = ceil($c / $on_page);

if ($countPage > 1) {
  ?>
<ul class="pagination">
  <?php if($page > 1) { ?>
  <li class="pagination__item"><a href="<?=$link?>?page=1<?=$link_add?>"
      class="pagination__arrow  pagination__arrow--prev pagination__arrow--start"><span class="visually-hidden">в
        начало</span></a></li>
  <li class="pagination__item"><a href="<?=$link?>?page=<?=$page-1;?><?=$link_add?>"
      class="pagination__arrow pagination__arrow--prev"><span class="visually-hidden">на предыдущую страницу</span></a>
  </li>
  <?php } 
$numberOfLinks = 1;
$startLink = $page - $numberOfLinks;
($startLink <= 0) ? $startLink = 1 : $startLink;
($page == 1) ? $numberOfLinks = 2 : $numberOfLinks;
$finaltLink = $page + $numberOfLinks;
($finaltLink >= $countPage) ? $finaltLink = $countPage : $finaltLink;
for($i = $startLink; $i<= $finaltLink; $i++) { 
?>
  <li class="pagination__item"> <a <?=($i == $page) ? "" : "href='$link?page=$i$link_add'";?>
      <?=($i == $page) ? 'class="pagination__link pagination__link--current"' : 'class="pagination__link"';?>><?=$i;?></a>
  </li>
  <?php }

 if($page < $countPage) { ?>
  <li class="pagination__item"><a href="<?=$link?>?page=<?=$page+1;?><?=$link_add?>"
      class="pagination__arrow pagination__arrow--next"><span class="visually-hidden">на следующую страницу</span></a>
  </li>
  <li class="pagination__item"><a href="<?=$link?>?page=<?=$countPage;?><?=$link_add?>"
      class="pagination__arrow pagination__arrow--next pagination__arrow--finish"><span class="visually-hidden">в
        конец</span></a></li>
  <?php } ?>
</ul>
<?php } 
?>
