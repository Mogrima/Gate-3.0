<?php 
$current_url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
require_once('./core/business/appvars.php');
require_once(BUS . 'connectvars.php');
// подключение к базе данных
require_once(BUS.'/mysql__connect.php');  
// получение id альбома
$id = $_GET["id"];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<title>Адаптивная галерея изображений</title>
	<link href="slider.style.css" rel="stylesheet">
	<link rel="stylesheet" href="../css/album-slider.css">
</head>

<body>
	<div class="wrap">
		<div class="headline">Aдаптивная галерея изображений</div>
		<div id="gallery" class="gallery gallery1">
			<div class="slider">
				<div class="stage">
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Asmodei.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Baal.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Nell.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Азазель.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Астарот.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Басманов.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Вельзевул.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Гефест.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Винеа.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<img class="slider__img" src="../img/portraits/Гремор.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Денгребрия.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Ксальбадора.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Леший.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Лилит.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Маммон.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
					<div>
						<h3 class="works__title album-slider__title">Рисунок</h3>
						<img class="slider__img" src="../img/portraits/Сатана.jpg" width="768px" alt="">
						<div class="count count-no-js"><span>1/7</span></div>
					</div>
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
					widthSlider: 312,
					// одновременно выводится 1 элемент
					visibleItems: 1
				},
				768: {
					widthSlider: 452
				},
				1200: {
					widthSlider: 800
				}
			}
		});
	</script>
</body>

</html>