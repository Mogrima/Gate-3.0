<?php 
$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once('../../core/business/appvars.php');
require_once('../../core/business/connectvars.php');
// подключение к базе данных
require_once('../../core/business/mysql__connect.php');  
// получение id альбома
$id = 2;

$album_arts = "SELECT * FROM `album_arts` WHERE album_id = $id ORDER BY `id` DESC";
$arts_query = $pdo->query($album_arts);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Адаптивная галерея изображений</title>
	<link href="slider.style.css" rel="stylesheet">
	<link rel="stylesheet" href="album-slider.css">
</head>

<body>
	<div class="wrap">
		<div class="headline">Aдаптивная галерея изображений</div>
		<div id="gallery" class="gallery gallery1">
			<div class="slider">
				<div class="stage">
				<?php
					$album_name = array();
					$album_src = array();
						while($art = $arts_query->fetch(PDO::FETCH_OBJ)) {
							$album_name[] = $art->works_title;;
							$album_src[] = $art->works_image;
						} 
						$arts_count = count($album_name);
						
						for($i = 0; $i < $arts_count; $i++) {
								?>
							<li class="slider__item">
								
								<h3 class="works__title album-slider__title"><?=$album_name[$i]?></h3><a name="<?=$i?>"></a>
								<img class="slider__img" src="images/<?=$album_src[$i]?>.jpg" width="768px" alt="<?=$album_name[$i]?>">
							</li> 
						<?php }?>
				</div>
				<div class="count count-js"> 
					<span class="count__current">1</span> из 
					<span class="count__total">5</span> 
				</div>
			</div>
			<div class="nav-ctrl">
				<button class="prev slider__prev album-slider__prev" type="button" data-shift="prev"><!-- Предыдущий--></button>
				<button class="next slider__next album-slider__next" type="button" data-shift="next"><!-- Следущий --></button>
			</div>
				<ul class="dots-ctrl slider__dots"></ul>
			</div>
		</div>
	</div>

	<script src="slider.function.js"></script>
	<script type="text/javascript">
		var gallery1 = new Gallery('gallery', {
			// включаем постраничную навигацию
			dots: true,
			// включаем управление с клавиатуры клавишами навигации "вправо / влево"
			keyControl: true,
			// включаем адаптивность
			responsive: true,
			// настройки галереи в зависимости от разрешения
			adaptive: {
				// настройка работает в диапазоне разрешений 320-768px
				320: {
					widthSlider: 320,
					margin: 20,
					// одновременно выводится 1 элемент
					visibleItems: 1
				},
				768: {
					widthSlider: 480,
					margin: 20
				},
				1200: {
					widthSlider: 800
				}
			}
		});
	</script>
</body>

</html>