<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Галерея';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<body class="page">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <!--  Подложка -->
        <div class="page-main__head">
          <h1 class="title">Галерея</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">Галерея</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">Рисование будоражило меня с незапамятных лет, часто открывая моей памяти дорогу к истокам. При помощи графического планшета и вдохновенного настроя светлой грусти порой возможно совершить чудо - воссоздать живых и мертвых, пробудить историю, да и просто дать полную волю вымыслу. Этот раздел разбит на альбомы, в каждом из которых – иллюстрации к разным книгам, а так же просто рисунки, ссылающиеся на разных упомянутых во Вратах персонажей.</p>
          <p class="page-description page-description--flex">Здесь же располагается альбом с историей в картинках: <i>«Бесконечная история»</i> - затяжным сквозным проектом, связанным с серией книг из соседствующего раздела.<br>
          <span class="page-description__pleasant">Приятного просмотра!</span></p>
        </div>
        <p class="attention"><i>P.S.:</i> Делитесь своими впечатлениями, оставляйте свои комментарии – это легко и быстро можно сделать под каждым рисунком в Галерее! Только Вы способны помочь в совершенствовании своим откликом – это столь ценно для нас.</p>
        <!-- <section class="filters">
          <h2 class="visually-hidden">Фильтр рисунков</h2>
          <form action="#" class="filter" method="get">
            <fieldset class="filter__fieldset filter__fieldset--gallery">
              <legend class="filter__title filter__title--center">Сортировка:</legend>
                  <ul class="filter__list filter__list--center">
                    <div class="filter__wrapper-gallery">
                    <li class="filter__item-gallery"><input checked class="checkbox" id="popular-checkbox" name="popular" type="checkbox"> <label class="checkbox__name" for="popular-checkbox"><span class="checkbox__indicator"></span> По популярности</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="old-checkbox" name="old" type="checkbox"> <label class="checkbox__name" for="old-checkbox"><span class="checkbox__indicator"></span> Иллюстрации из книг</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="free-checkbox" name="free" type="checkbox"> <label class="checkbox__name" for="free-checkbox"><span class="checkbox__indicator"></span> Цветные</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="colorless" name="pay" type="checkbox"> <label class="checkbox__name" for="colorless"><span class="checkbox__indicator"></span> Черно-белые</label></li>
                    <li class="filter__item-gallery"><input class="checkbox" id="history" name="pay" type="checkbox"> <label class="checkbox__name" for="history"><span class="checkbox__indicator"></span> Истории</label></li>
                    </div>
                  </ul>
            </fieldset><button class="filter__button filter__button--center">Применить</button>
          </form>
        </section> -->
        <section class="works">
          <h2 class="visually-hidden">Список альбомов</h2>
          <div class="works__wrapper works__wrapper--inner">
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Сюжетные
              </figcaption><img alt="Сюжетные" class="works__image" height="347" src="img/arts-catalog/Ритуал.jpg" width="258">
              <p class="works__description">Работы разнопланового содержания – передающие конкретный момент, историю, случай.</p><a class="button works__button" href="inner-page/story.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Портреты
              </figcaption><img alt="Портреты" class="works__image" height="347" src="img/arts-catalog/gefest.jpg" width="258">
              <p class="works__description">Лица, а то и переданные полностью образы знакомых и просто припомнившихся персон.</p><a class="button works__button" href="inner-page/portraits.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Состояния
              </figcaption><img alt="Состояния" class="works__image" height="347" src="img/arts-catalog/clarification.jpg" width="258">
              <p class="works__description">Пускай человечество относится к эмоциям, как ко второстепенным в своей жизни проявлениям, именно они владеют нашей жизнью, прокладывают нам путь в мире.</p><a class="button works__button" href="inner-page/condition.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Легенды
              </figcaption><img alt="Легенды" class="works__image" height="347" src="img/arts-catalog/Ритуал1.jpg" width="258">
              <p class="works__description"></p><a class="button works__button" href="inner-page/legend.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Старые работы
              </figcaption><img alt="Старые работы" class="works__image" height="347" src="img/arts-catalog/alive.jpg" width="258">
              <p class="works__description">Следы давно минувших безвозвратно лет – самые старые из работ, на которых явственнее всего видны ошибки и стремления, а порой и изжившие себя взгляды.</p><a class="button works__button" href="inner-page/oldWorks.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Наброски и зарисовки
              </figcaption><img alt="Наброски и зарисовки" class="works__image" height="347" src="img/arts-catalog/ghost.jpg" width="258">
              <p class="works__description">Изображения, которым никогда не обрести полноценную форму. Всего лишь зарисовки.</p><a class="button works__button" href="inner-page/sketches.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Бесконечная история
              </figcaption><img alt="Бесконечная история" class="works__image" height="347" src="" width="258">
              <p class="works__description">Графическая история</p><a class="button works__button" href="manga/contents.html">Открыть</a>
            </figure>
            <figure class="works__item">
              <figcaption class="works__title works__title--mt">
                Дюран
              </figcaption><img alt="Дюран" class="works__image" height="347" src="img/manga/duran/Обложка.jpeg" width="258">
              <p class="works__description">Эпизоды</p><a class="button works__button" href="manga/duran.html">Открыть</a>
            </figure>
          </div>
        </section>
        <!-- <ul class="pagination">
          <div class="pagination__wrapper">
            <li class="pagination__item"><a class="pagination__link pagination__link--current">1</a>
            </li>
            <li class="pagination__item"><a class="pagination__link" href="#">2</a>
            </li>
            <li class="pagination__item"><a class="pagination__link" href="#">3</a>
            </li>
            <li class="pagination__item"><a class="pagination__link" href="#">4</a>
            </li>
          </div>
        </ul> -->
      </div><!-- Подложка -->
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
</body>
</html>