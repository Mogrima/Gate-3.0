<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'Врата. Версия 6';
    require_once(BUS.'/pagevars.php');
    require_once(BLOCKS .'head.php');?>
</head>
<body class="page page-about">
  <div class="background-header"></div>
  <?php require_once(BLOCKS . 'header.php'); ?>
  <?php require_once(BLOCKS . 'main-navigation.php'); ?>
  <main class="page-main">
    <div class="container">
      <div class="substrate">
        <div class="page-main__head">
          <h1 class="title">О нас</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">О нас</li>
          </ul>
          <?php require_once BLOCKS .'search-block.php' ?>
        </div>
        <section class="about-content">
          <h2 class="visually-hidden">Немного информации про авторов проекта</h2>
          <p class="about-content__text about-content__text--first">Итак, эта страница предназначена для более тесного знакомства между Вами – нашими гостями и нами – авторами. Сайт, на который Вы попали, - сборник кропотливо перенесенных воспоминаний, от самой первой нашей жизни, до жизней тех, кто был отделен от нас рамками времени и пространства, как и банальными обстоятельствами. Содержимое воспоминаний, отраженное в книгах и графике, может показаться несколько специфичным, броским или же туманным, в зависимости от того произведения, что первым попадется Вам на глаза. Но не стоит допускать шаблонность – мы ни в коем случае не мистификаторы, не оккультисты и не обманщики. Только лишь <i>рассказчики.</i></p>
          <div class="about-content__authors">
            <figure class="about-content__photo">
              <a class="about__open-photo-1" href="#"><img alt="Роджер" class="about-content__photo-image" height="150" src="img/about/Ro.jpg" width="250"></a>
              <figcaption class="about-content__caption">
                Роджер
              </figcaption>
            </figure>
            <figure class="about-content__photo about-content__photo--right">
              <a class="about__open-photo-2" href="#"><img alt="Могрима" class="about-content__photo-image" height="150" src="img/about/Mo.jpg" width="250"></a>
              <figcaption class="about-content__caption">
                Могрима
              </figcaption>
            </figure>
          </div>
          <p class="about-content__text">Кто мы? А если взглянуть иначе – а важен ли этот вопрос? Важным должно остаться лишь то, что мы отважились сделать за жизнь, столь короткую, словно затянувшийся сон перед долгожданным пробуждением. Кажется, словно еще немного – и вот открыты глаза, и теплое утреннее солнце, заглянувшее в гости, согревает лицо. Что мы снова дома. Но то мираж – действительность остается непреклонна, возвращая день ото дню к обыденной жизни. Важным остается то, что мы из себя представляем, то, что мы предлагаем <i>вашему вниманию.</i></p>
          <p class="about-content__text">Мы нашли чем занять предстоящие годы ожидания, сделали выбор: рассказать то, что знаем. От безобидных сказок до вполне серьезных вопросов. Истории, захватывающие полет воображения, оставляющие след в сознании – вот та ценность, на которую будет разменяно время – самый драгоценный ресурс. Когда во власти один из самых роскошных языков во всем мире задача, сама по себе, - огранить замысел вереницей подходящих слов, отполировав впечатление подходящими иллюстрации. Что мы и стараемся сделать.</p>
          <p class="about-content__text">Так уж вышло что я – <i><a class="link link--about" href="https://vk.com/id501667863">Роджер</a></i>, не столь ужасно, как мне представляется, излагаю мысль в слове, так же как и немного смыслю в графическом изображении тех образов, что стремлюсь показать. Иными словами, я автор текстов и иллюстраций. В то время как моя верная спутница – <i><a class="link link--about" href="https://vk.com/mogrima">Могрима</a></i>, мое вдохновение, столь умна, что самостоятельно изучила несколько языков, дабы при помощи кода воплотить нашу задумку в веб среде. Так нашим союзом воссоздано все, что содержится во Вратах. Именно мы «стоим по ту сторону».</p>
          <figure class="about-content__photo">
            <a class="about__open-photo-3" href="#"><img alt="Одна из первых напечатанных книг" class="about-content__photo-image about-content__photo-image--border" height="150" src="img/about/photo-1.jpg" width="250"></a>
            <figcaption class="about-content__caption">
              Одна из первых напечатанных книг
            </figcaption>
          </figure>
          <p class="about-content__text">У далеких истоков творчества были бесчисленные попытки. Сомнения – злейший враг разума. Попытки воссоздать книгу вживую – тяжки, и предпринимались прежде исключительно ради присущего человеку любопытства. Что же будет итогом? Как будет выглядеть книга, воплощенная, материальная, лежащая в руках? Так были напечатаны первые книги - два сборника стихов. Всего по несколько экземпляров, как позволяли накопленные в эпоху учебы сбережения. Ощущение реальности труда – восхитительно, однако, зыбко. Не смотря на все типографские изъяны книги эти стали примером того, как любая цель, приложи к ней упорства и отринь сомнения, - <i>воплотится.</i></p>
          <p class="about-content__text">Спустя долгий срок удалось, наконец, воссоздать полноценную книгу – не сборник бессвязных работ в стихотворной форме, а слаженную историю. Это стало личным достижением для такой неорганизованной, непостоянной натуры, как я. И существенным толчком к большему.</p>
          <p class="about-content__text">И мы постараемся не останавливаться на скромных нынешних результатах. Впереди есть много направлений для развития. Так важным можно выделить, к примеру: <ul class="about__list">
                        <li class="page-main__intro-item about__item">Разумеется, расширение существующей на данном этапе базы книг;</li>
                        <li class="page-main__intro-item about__item">Преодоление международной языковой среды;</li>
                        <li class="page-main__intro-item about__item">Озвучивание произведений для удобства их восприятия – некоторым информацию легче воспринимать именно на слух, а некоторым попросту не хватает на чтение времени;</li>
                        <li class="page-main__intro-item about__item">Поиск финансовых решений для обеспечения не только проекта, но и нас самих – временем на него.</li>
                    </ul></p>
          <p class="about-content__text">Какая красота скрывается в омуте представлений, какими бы они ни были, в причудливой игре воображения. И даже в попытке отыскать истину среди рациональных фактов есть солидное место домыслу. Мы воображаем о многом, а порой ни о чем, но именно мысли наполняют нашу жизнь. Я стремлюсь вообразить народы: их зарю и упадки, их волю и слабость. Вообразить героев, чьи чувства проходят сквозь мою душу как ноты очаровывающих мелодий, вынуждая оцепенеть в ожидании финала – развязки их путей. Этими мыслями, этими впечатлениями я и хочу поделиться с Вами.</p>
          <p class="about-content__text">Воображение обладает неоспоримой силой, давая человеку шанс, столь бесценный, - освободить свою уставшую душу от скуки и серости окружающего. Вообразите лишь на мгновение, что Врата отведут вас к ларцу, в котором заперты древние сокровища – останки былых цивилизаций, реликвии разных народов и эпох, вещицы родом со всех уголков необъятной Вселенной. Вот же ключ. Вы волны разглядывать их сколько угодно – безделушки из ларца никуда не исчезнут. Главное – это сопутствующее настроение.</p>
          <p class="about-content__text about-content__text--right">Мы желаем Вам интересного пути.</p>
          <p class="about-content__text about-content__text--PS"><i>P.S. :</i> Менее пространные ответы на вопросы, которые могли у вас возникнуть, всегда можно отыскать в соседствующем разделе <a class="link link--about" href="FAQ.php">FAQ</a>.</p>
        </section>
        <div class="index-columns index-columns--border">
          <section class="about-social index-columns__column index-columns__column--left">
            <h2 class="section-header index-columns__title">Мы в социальных сетях</h2>
            <p class="about-social__description">Только сообща люди достигают наиболее значительных результатов – мы будем рады Вашему участию. Свяжитесь с Вратами в социальных сетях!</p>
            <p class="about-social__description"><a class="link link--about" href="https://vk.com/gate_art_project" target="_blank">Группа вконтакте</a> - публикуются самые свежие новости.</p>
            <p class="about-social__description"><a class="link link--about" href="https://www.deviantart.com/inaneakme" target="_blank">Девианарт</a> - представлен весь графический контент.</p>
          </section>
          <section class="feedback index-columns__column index-columns__column--right">
          <?php
            $succeful = false;
              if(isset($_POST['submit'])) {
                if(($_POST['massage'] != '') && ($_POST['name'] != '') && ($_POST['email'] != '')) {
                  if(mb_strlen($_POST['massage'], 'utf-8') <= 1000) {
                    $name = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
                    $email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
                    $massage = trim(filter_var($_POST['massage'], FILTER_SANITIZE_STRING));

                    $to = 'VRATAproject@yandex.ru';
                    $subject = 'Обратная связь с сайта';
                    $msg = "$name отправил(а) следующее обращение:\n" .
                      "$massage";
                    mail($to, $subject, $msg, 'From:' . $email);
                    $user_msg = 'Ваше сообщение отправлено';
                    $succeful = true;
                  }
                  else {
                    $user_msg = 'Ваше сообщение превысило допустимое количество знаков - 1000';
                  }
                }
                else {
                  $user_msg = 'Не все поля заполнены';
                }
              }
            ?>
            <h2 class="section-header index-columns__title">Обратная связь</h2>
            <p class="feedback__description">Вы всегда можете оставить свое пожелание, замечание или предложение сугубо тет-а-тет, отправив его на нашу электронную почту, заполнив простую форму обратной связи. Это займет всего пару минут, нам важно Ваше мнение!</p>
            <?php
              if (isset($user_msg)) {
                if ($succeful) {
                  echo '<p class="attention attention--user_msg attention--succeful-comment attention--w100">' . $user_msg . '</p>';
                }
              else {
                  echo '<p class="attention attention--user_msg attention--w100">' . $user_msg . '</p>'; 
                }
              }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="feedback__form" method="post">
              <p class="input__wrapper"><label class="input__sign feedback__input-sign" for="feedback-name">Как вас зовут?</label> <input class="input feedback__name" id="feedback-name" name="name" maxlength="20" placeholder="имя..." type="text"></p>
              <p class="input__wrapper"><label class="input__sign feedback__input-sign" for="feedback-email">Напишите почту для ответа:</label> <input class="input feedback__email" id="feedback-email" name="email" maxlength="30" placeholder="почтовый ящик..." type="email"></p>
              <p class="input__wrapper"><label class="input__sign feedback__input-sign" for="feedback-massage">Напишите ваш вопрос или пожелание:</label> 
              <textarea class="input feedback__massage countInput" id="feedback-massage" maxlength="1000" name="massage" placeholder="ваше сообщение..."></textarea>
              <p class="count-letter">Осталось <span class="count-letter_symbol">1000</span> знаков</p></p>
              <button class="button feedback__button" name="submit" type="submit">Отправить</button>
            </form>
          </section>
        </div>
      </div>
    </div>
  </main>
  <?php require_once(BLOCKS .'footer.php'); ?>
  <!-- Модальные окна -->
  <div class="popup__photo popup__photo--1">
    <img class="popup__image popup__image--round" alt="Роджер. Большой размер" height="500" src="img/about/Ro.jpg" width="500"> <button class="close photo-close-1">Закрыть</button>
  </div>
  <div class="popup__photo popup__photo--2">
    <img class="popup__image popup__image--round" alt="Могрима. Большой размер" height="500" src="img/about/Mo.jpg" width="500"> <button class="close photo-close-2">Закрыть</button>
  </div>
  <div class="popup__photo popup__photo--3">
    <img class="popup__image" alt="Одна из первых напечатанных книг. Большой размер" height="500" src="img/about/photo-1.jpg" width="500"> <button class="close photo-close-3">Закрыть</button>
  </div>
  <?php require_once(BLOCKS .'modal-login.php'); ?>
  <?php require_once(BLOCKS .'modal-registration.php'); ?>
  <div class="overlay"></div>
  <div class="overlay overlay--dark"></div>
  <?php require_once(BLOCKS .'scripts-include.php'); ?>
  <script src="js/popup-photo.js" type="text/javascript"></script>
  <script>
  let totalCount = 1000;
  let countInput = document.querySelector('.countInput');
  let count = document.querySelector('.count-letter_symbol');
  countInput.addEventListener('input', function() {
    count.innerHTML = totalCount - countInput.value.length;
  });
  </script>
</body>
</html>