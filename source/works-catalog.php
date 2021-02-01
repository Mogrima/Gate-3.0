<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">
<head>
<?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Книги';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS . 'head.php'); ?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title">Книги</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Книги</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Итак, добро пожаловать в основной раздел сайта – нашу библиотеку. Написание книг – достаточно трудоемкое и долгое занятие, которому мы стараемся уделять достаточно времени. Торопиться и угождать ежеминутным порывам порой подобно смерти, ведь в <i>законченном произведении</i> все должно быть слаженно. Поэтому, частых пополнений здесь ожидать не следует.</p>
          <details class="page-description__spoiler spoiler">
            <summary class="spoiler__title">
              <span class="spoiler__note">Этих правил автор будет придерживаться при пополнении библиотеки</span>
            </summary>
            <div class="spoiler__wrapper">
              <p class="spoiler__text">Авторы разных эпох позволяли себе постепенную публикацию своих произведений, выпуская их в свет по частям в разных специализированых журналах. В этом была своя польза – заинтересованная публика с трепетом ждала продолжения, а время ожидания давало пищу для размышлений, однако, есть и многие минусы. Такие как: сроки воссоздания продолжения, которые оптимальны для сохранения в памяти читателя подробностей предшествующих частей, а так же банальная неспособность автора порой взять себя в руки и закончить начатое. Эти минусы легко постигают такую непостоянную бесхарактерность как я.</p>
              <p class="spoiler__text">Именно поэтому текст я стараюсь не разделять, поднося его вашему вниманию в исключительно окончательно сформированном виде. Впрочем, это правило не касательно графической составляющей, сопутствующей книгам – иллюстрациям, создание которых подобно последнему штриху, ведь их роль носит декоративный характер. Таким образом, иллюстрации к книгам появляться могут поэтапно, по мере своего воссоздания на свет.</p>
              <p class="spoiler__text">Об анонсах книг Вы сможете своевременно узнавать в соц. сетях, а о пополнении графических материалов к книгам всегда выходят новости на заглавной странице сайта.</p>
            </div>
          </details>
          <p class="page-description page-description--welcome">Попробуйте ознакомиться с одной из книг, представленных в архиве Врат…<br>
          <span class="page-description__pleasant">Приятного чтения!</span></p>
        </div>
        <p class="attention"><i>P.S.:</i> Оставляйте свои рецензии, размещенные под каждым описанием книги – помогите другим гостям Врат в выборе! Только Вы способны помочь в совершенствовании своим откликом – это столь ценно для нас.</p>
        <section class="filters">
          <h2 class="visually-hidden">Фильтр книг</h2>
          <h3 class="section-header filters__title">Выберете то, что Вас интересует:</h3>
          <p class="filters__note">Если Вы впервые на сайте – выберите наиболее приятный Вам жанр из представленных. Это позволит достичь наиболее комфортного первого знакомства.</p>
          <form action="#" class="filter" method="POST">
            <div class="filter__wrapper">
              <fieldset class="filter__fieldset">
                <legend class="filter__title">Формат:</legend>
                <ul class="filter__list">
                  <li><input class="checkbox" id="fiction" name="fiction" type="checkbox"> <label class="checkbox__name" for="fiction"><span class="checkbox__indicator"></span>Художественная литература</label></li>
                  <li><input class="checkbox" id="poetry" name="poetry" type="checkbox"> <label class="checkbox__name" for="poetry"><span class="checkbox__indicator"></span>Стихотворения</label></li>
                  <li><input class="checkbox" id="scenario" name="scenario" type="checkbox"> <label class="checkbox__name" for="scenario"><span class="checkbox__indicator"></span>Сценарии</label></li>
                  <li><input checked class="checkbox" id="worlds" name="worlds" type="checkbox"> <label class="checkbox__name" for="worlds"><span class="checkbox__indicator"></span>О мирах</label></li>
                </ul>
              </fieldset>
              <fieldset class="filter__fieldset">
                <legend class="filter__title">Размер:</legend>
                <ul class="filter__list">
                  <li><input checked class="checkbox" id="little" name="little" type="checkbox"> <label class="checkbox__name" for="little"><span class="checkbox__indicator"></span>Рассказы</label></li>
                  <li><input class="checkbox" id="middle" name="middle" type="checkbox"> <label class="checkbox__name" for="middle"><span class="checkbox__indicator"></span><span>Средний <span class="checkbox__clar">(150 - 200 стр.)</span></span></label></li>
                  <li><input class="checkbox" id="big" name="big" type="checkbox"> <label class="checkbox__name" for="big"><span class="checkbox__indicator"></span><span>Большой <span class="checkbox__clar"> (больше 200 стр.)</span></span></label></li>
                </ul>
              </fieldset>
              <fieldset class="filter__fieldset">
                <legend class="filter__title">Жанры:</legend>
                <ul class="filter__list">
                  <li><input checked class="checkbox" id="tale" name="tale" type="checkbox"> <label class="checkbox__name" for="tale"><span class="checkbox__indicator"></span>Сказка</label></li>
                  <li><input class="checkbox" id="novel" name="novel" type="checkbox"> <label class="checkbox__name" for="novel"><span class="checkbox__indicator"></span>Роман</label></li>
                  <li><input class="checkbox" id="encyclopedia" name="encyclopedia" type="checkbox"> <label class="checkbox__name" for="encyclopedia"><span class="checkbox__indicator"></span>Энциклопедия</label></li>
                  <li><input class="checkbox" id="drama" name="drama" type="checkbox"> <label class="checkbox__name" for="drama"><span class="checkbox__indicator"></span>Трагедия</label></li>
                  <li><input class="checkbox" id="life" name="life" type="checkbox"> <label class="checkbox__name" for="life"><span class="checkbox__indicator"></span>Быт</label></li>
                  <li><input class="checkbox" id="philosophy" name="philosophy" type="checkbox"> <label class="checkbox__name" for="philosophy"><span class="checkbox__indicator"></span>Философия</label></li>
                  <li><input class="checkbox" id="folk" name="folk" type="checkbox"> <label class="checkbox__name" for="folk"><span class="checkbox__indicator"></span>Фольклористика</label></li>
                </ul>
              </fieldset>
            </div><button class="filter__button" type="submit" value="sort" name="sort">Применить</button>
          </form>
        </section>
        <!--$works_title заголовок section works  -->
        <?php $works_title = 'Список произведений';
        // подключение к базе данных
        require_once(BUS.'/mysql__connect.php');
        // подключение самого шаблона католога, в котором уже прописан цикл для вывода данных
        // выключаем (прячем) заголовок
        $sectionTitleOn = false;
        $src_stat = '../img/works-catalog/';
        $works_link = 'book.php?id=';
        // --------------------- пагинация ---------------------------------------------- //
        $page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
        $on_page = 6;
        $shift = ($page - 1) * $on_page;
        // запрос на вывод данных каталога произведений из бд в порядке убывания по id
        $sql = "SELECT * FROM `works_catalog` ORDER BY `id` DESC LIMIT $shift, $on_page";
        $query = $pdo->query($sql);
        $stmt = $pdo->query("SELECT COUNT(*) FROM works_catalog");
        $row = $stmt->fetch();
        $c=$row[0];
        $countPage = ceil($c / $on_page);

        require(BLOCKS .'works_section.php');
        $link = 'works-catalog.php';
        $link_add = "";
        $anchor = '#anchor';
        require_once(BLOCKS . 'pagination.php');

        // ------------------------------------------------------------------------------------- //
        ?>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>
</html>
