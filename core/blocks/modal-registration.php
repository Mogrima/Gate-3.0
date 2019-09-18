<section class="login login__reg">
    <h2 class="visually-hidden">Здесь можно зарегистрироваться</h2>
    <p class="section-header login__title">Добро пожаловать</p>
    <p id="errorReg" class="attention attention--modal"></p>
    <form id="reg-form" action="core/business/signup__modal.php" method="post">
      <p class="input__wrapper">
        <label for="username" class="visually-hidden">Ваше имя...</label>
        <input id="username" class="input login__input" type="text" name="username" placeholder="Ваше имя..." required>
      </p>
      <p class="input__wrapper">
        <label for="useremail" class="visually-hidden">Ваш почтовый ящик...</label>
        <input id="useremail" class="input login__input" type="email" name="useremail" placeholder="Ваш почтовый ящик..." required>
      </p>
      <p class="input__wrapper">
        <label for="userpass" class="visually-hidden">Придумайте пароль</label>
        <input id="userpass" class="input login__input" type="password" name="userpass" placeholder="Придумайте пароль" required>
      </p>
      <p class="input__wrapper">
        <label for="userpass2" class="visually-hidden">Повторите пароль</label>
        <input id="userpass2" class="input login__input login__input--page" type="password" name="userpass2" placeholder="Повторите пароль" required>
      </p>
      <div class="login__info login__info--start">
        <input id="remember" class="checkbox login__info-checkbox" type="checkbox" name="remember" checked="checked"> <label for="remember" class="checkbox__name login__checkbox-name"><span class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
      </div>
      <button class="button login__button" type="submit">Зарегистрироваться</button>
    </form>
    <a class="link link--profile" href="./registration.php">Перейти на отдельную страницу регистрации</a>
    <button class="close login__close-reg">Закрыть</button>
</section>