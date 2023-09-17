<?php
    //dump($data);
?>
<main>
    <form  id="registration"  action="/create" method="POST" class="col-10 col-sm-4 m-auto mt-5">
        <input name="login" class="form-control form-control-sm mb-1" type="text" placeholder="login">
        <input name="password" class="form-control form-control-sm mb-1" type="password" placeholder="password">
        <input name="passwordConfirm" class="form-control form-control-sm mb-1" type="password" placeholder="confirm password">
        <input name="phone" class="form-control form-control-sm mb-1" type="tel">
        <input name="email" class="form-control form-control-sm mb-1" type="email" placeholder="email">
        <input name="action" class="form-control form-control-sm mb-1" value="registration" hidden>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate">
                Запомнить пароль
            </label>
        </div>
        <input data="reg" class="form-control form-control-sm mb-1 btn btn-outline-success" type="submit" value="Зарегистрироваться">
    </form>
</main>