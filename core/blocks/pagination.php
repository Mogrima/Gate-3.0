<?php
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
$x = 1;
$n = $page - $x;
($n <= 0) ? $n = 1 : $n;
($page == 1) ? $x = 2 : $x;
$f = $page + $x;
($f >= $countPage) ? $f = $countPage : $f;
for($i = $n; $i<= $f; $i++) { 
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
