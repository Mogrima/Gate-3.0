<section class="login login__log">
    <h2 class="visually-hidden">Здесь можно представиться</h2>
    <p class="section-header login__title">Здравствуйте</p>
    <form id="login-form" method="POST" action="core/business/auth_modal.php">
    <p id="errorLogin" class="attention attention--modal"></p>
      <p class="input__wrapper">
          <label for="login-name" class="visually-hidden">Ваше имя</label>
          <input id="login-name" class="input login__input login__input--page" type="text" name="username" placeholder="Ваше имя..." required>
      </p>
      <p class="input__wrapper">
          <label for="login-pass" class="visually-hidden">Ваш пароль</label>
          <input id="login-pass" class="input login__input login__input--page" type="password" name="password" placeholder="Ваш ключ..." required>
      </p>
        <div class="login__info">
        <input id="login-remember" class="checkbox login__info-checkbox" type="checkbox" name="remember"> <label for="login-remember" class="checkbox__name login__checkbox-name"><span class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
        <a class="login__restore" href="#">Я забыл(а) пароль!</a> 
      </div>
      <button class="button login__button" type="submit" value="enter" name="submit">Представиться</button>
    </form>
    <a class="login__info login__info--last link link--modal" href="./login.php">Если форма работает некорректно</a>
       <button class="close login__close-log">Закрыть</button>
</section>