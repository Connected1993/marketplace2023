<?php
    dump($data);
?>
<main>
    <form action="/create" class="regForm regForm_flex" method="POST">
      <span class="regForm__head">Регистрация</span>
      <div class="regForm__wrapper">
        <div class="regForm__content">
          <span class="regForm__span">Логин: </span>
          <input name="login" class="regForm__input" type="text" required>
        </div>
        <div class="regForm__content">
          <div class="regForm__content__pswd">
            <span class="regForm__span">Пароль: </span>
            <input name="password1" id="inputPswd1" class="regForm__input inputPswd" type="password" required>
          </div>
          <div class="regForm__content__pswd">
            <span class="regForm__span">Повторите пароль: </span>
            <input name="password2" id="inputPswd2" class="regForm__input inputPswd" type="password" required>
          </div>
        </div>
        <button class="regForm__submit regForm__submit_txt" type="submit">Зарегистрироваться</button>
        <input name="action" class="d-none" value="registration" type="text">
      </div>
    </form>
</main>