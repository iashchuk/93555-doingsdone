<h2 class="content__main-heading">Вход на сайт</h2>
<form class="form" action="../auth.php" method="post">

    <div class="form__row">
        <label class="form__label" for="email">E-mail <sup>*</sup></label>

        <input class="form__input
            <?php if (isset($errors['invaild_email']) || isset($errors['email'])): ?> form__input--error<?php endif; ?>"
            type="text" name="auth[email]" id="email" value="<?=$values['email'] ?? ''; ?>" placeholder="Введите e-mail">

            <?php if (isset($errors['email'])): ?>
                <p class="form__message"><?=$errors['invaild_email'] ?? ''; ?></p>
            <?php endif; ?>

            <?php if (isset($errors['invaild_email'])): ?>
                <p class="form__message"><?=$errors['email'] ?? ''; ?></p>
            <?php endif; ?>
    </div>


    <div class="form__row">
        <label class="form__label" for="password">Пароль <sup>*</sup></label>

        <input class="form__input
            <?php if (isset($errors['password'])): ?> form__input--error<?php endif; ?>"
            type="password" name="auth[password]" id="password" value="" placeholder="Введите пароль">

            <?php if (isset($errors['password'])): ?>
            <p class="form__message"><?=$errors['password'] ?? ''; ?></p>
        <?php endif; ?>
    </div>


    <div class="form__row form__row--controls">
        <input class="button" type="submit" name="" value="Войти">
    </div>

</form>
