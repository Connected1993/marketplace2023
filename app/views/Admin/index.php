<?php

declare(strict_types=1);

?>
<main>
    <div class="mt-2 col-11 mx-auto">
        <form id="product" method="POST">
            <input name="name" class="form-control form-control-sm mb-1" type="text" placeholder="наименование товара">
            <input name="price" class="form-control form-control-sm mb-1" type="number" placeholder="цена">
            <textarea name="description" class="form-control form-control-sm mb-1" placeholder="описание"></textarea>
        </form>
        <label for="uploadFiles">
            <div class="form-control" id="DRAGZONE">
                <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                <input type="file" id="uploadFiles" multiple="multiple" name="files[]" hidden>
            </div>
        </label>
        <div class="mt-2 col-11 mx-auto drag__preview"></div>
        <input type="submit" class="btn btn-success col-6 mx-auto d-block d-none" state="sendRequest"
               onclick="upload()">
    </div>


    <form id="registration" action="/create" method="POST" class="col-10 col-sm-4 m-auto mt-5">
        <input name="login" class="form-control form-control-sm mb-1" type="text" placeholder="login">
        <input name="password" class="form-control form-control-sm mb-1" type="password" placeholder="password">
        <input name="passwordConfirm" class="form-control form-control-sm mb-1" type="password"
               placeholder="confirm password">
        <input name="phone" class="form-control form-control-sm mb-1" type="tel">
        <input name="email" class="form-control form-control-sm mb-1" type="email" placeholder="email">
        <input name="action" class="form-control form-control-sm mb-1" value="registration" hidden>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckIndeterminate">
            <label class="form-check-label" for="flexCheckIndeterminate">
                Запомнить пароль
            </label>
        </div>
        <input data="reg" class="form-control form-control-sm mb-1 btn btn-outline-success" type="submit"
               value="Зарегистрироваться">
    </form>
</main>
