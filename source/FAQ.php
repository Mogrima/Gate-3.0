<?php require_once('./core/business/session.php');?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <?php
    require_once('./core/business/appvars.php');
    require_once(BUS . 'connectvars.php');
    // подключение к базе данных
    require_once(BUS.'/mysql__connect.php');
    $website_title = 'FAQ: ответы на вопросы';
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
          <h1 class="title">FAQ</h1>
          <ul class="breadcrumb">
            <li class="breadcrumb__item">
              <a class="breadcrumb__link" href="index.php">Новости</a>
            </li>
            <li class="breadcrumb__item breadcrumb__item--current">FAQ</li>
          </ul>
          <?php require_once(BLOCKS . 'search-block.php'); ?>
          <p class="page-description">В этом разделе мы постарались собрать наиболее распространенные вопросы, которые могут возникнуть, и разделили их на прикладные и пояснительные. Прикладные вопросы объясняют о том, как работает сайт, в то время как пояснительные – утолят любопытство.</p>
          <p class="page-description page-description--flex">Список вопросов и ответов на них постоянно пополняется. Здесь может появиться ответ на Ваш вопрос! Вы можете задать его в специальной теме: (ссылка на группу вк с обсуждением, скорее всего)</p>
        </div>
        <section class="tab">
          <h2 class="section-header tab__title">Перечень вопросов:</h2>
          <ul class="tab__list">
            <li class="tab__item">
              <input checked class="tab__checkbox" type="checkbox"> <i class="tab__arrow"></i>
              <h3 class="tab__subtitle">Почему основной упор делается на книги?</h3>
              <p class="tab__text">Слово, особенно столь многоликое, передает суть мысли куда точнее многих других способов искусства, в основном ориентированных на эмоциональную сторону. Конечно, каждый человек способен увидеть в одном и том же – свое, но точность, которую можно достигнуть словом, остается наиболее оптимальной. Именно потому на тексты я стремлюсь делать основной упор.</p>
            </li>
            <li class="tab__item">
              <input checked class="tab__checkbox" type="checkbox"> <i class="tab__arrow"></i>
              <h3 class="tab__subtitle">Почему иллюстраций так мало, а где-то они и вовсе отсутствуют?</h3>
              <p class="tab__text">Чтение дает человеческому воображению огромный простор. Я стараюсь, по возможности, не мешать волнительному процессу формирования образов частыми иллюстрациями.</p>
            </li>
            <li class="tab__item">
              <input checked class="tab__checkbox" type="checkbox"> <i class="tab__arrow"></i>
              <h3 class="tab__subtitle">Почему книги в нестандартном исполнении – не бумажные, а в виде текста в интернете?</h3>
              <p class="tab__text">Все банально просто. Печатные книги – дорогое удовольствие, не соперник книгам виртуальным, чье воссоздание не требует совершенно никаких затрат. В эпоху общедоступности информации в сети даже у профессиональных издательств печатная продукция терпит упадки, становясь дорогим удовольствием для народа, в каких-то случаях снижая качество и тиражи. Но мир в своем непостоянстве лишь облегчает этой переменой задачу – теперь чтобы книга нашла своего читателя нет необходимости в средствах и издательствах. Интернет – эта гигантская паутина, обладает неисчислимыми способами подачи информации, что, в конечном счете, зависит только от умения и желания. </p>
              <p class="tab__text">Словом, не смотря на нашу личную любовь к печатным книгам, наши возможности не позволяют заниматься попытками издания реальных, бумажных экземпляров. При даже среднем качестве, они будут столь дороги в себестоимости, что попросту не будут многим по карману.</p>
            </li>
          </ul>
        </section>
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