<section class="login login__reg">
    <h2 class="visually-hidden">Здесь можно зарегистрироваться</h2>
    <p class="section-header login__title">Добро пожаловать</p>
    <form action="#" method="post">
      <p class="input__wrapper">
        <label for="user-name" class="visually-hidden">Ваше имя...</label>
        <input id="user-name" class="input login__input" type="text" name="user-name" placeholder="Ваше имя...">
      </p>
      <p class="input__wrapper">
        <label for="user-email" class="visually-hidden">Ваш почтовый ящик...</label>
        <input id="user-email" class="input login__input" type="email" name="user-email" placeholder="Ваш почтовый ящик...">
      </p>
      <p class="input__wrapper">
        <label for="user-pass" class="visually-hidden">Придумайте пароль</label>
        <input id="user-pass" class="input login__input" type="password" name="user-pass" placeholder="Придумайте пароль">
      </p>
      <div class="login__info login__info--start">
        <input id="remember" class="checkbox login__info-checkbox" type="checkbox" name="remember" checked="checked"> <label for="remember" class="checkbox__name login__checkbox-name"><span class="checkbox__indicator login__checkbox-indicator"></span>Запомните меня</label>
      </div>
      <button class="button login__button" type="submit">Зарегистрироваться</button>
    </form>
    <button class="close login__close-reg">Закрыть</button>
</section>