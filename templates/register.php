<h2 class="content__main-heading">Регистрация аккаунта</h2>
<form class="form" action="../register.php" method="post" enctype="multipart/form-data">


    <!-- E-mail -->
    <div class="form__row">

        <label class="form__label" for="email">E-mail <sup>*</sup></label>

        <input class="form__input
        <?php if (isset($errors['email']) ||
                    isset($errors['used_email']) ||
                    isset($errors['invaild_email'])): ?> form__input--error"
        <?php endif; ?>
        type="text" name="signup[email]" id="email" value="<?=strip_tags($values['email']); ?? ''; ?>" placeholder="Введите e-mail">

        <?php if (isset($errors['email'])): ?>
            <p class="form__message">
                <span class="error-message">Заполните это поле</span>
            </p>
        <?php endif; ?>


    </div>


    <!-- Пароль -->
    <div class="form__row">

        <label class="form__label" for="password">Пароль <sup>*</sup></label>

        <input class="form__input
        <?php if (isset($errors["password"])): ?>
            form__input--error"
        <?php endif; ?>
        type="password" name="signup[password]" id="password" value="" placeholder="Введите пароль">

        <?php if (isset($errors['password'])): ?>
            <p class="form__message">
                <span class="error-message">Заполните это поле</span>
            </p>
        <?php endif; ?>

    </div>


    <!-- Имя -->
    <div class="form__row">

        <label class="form__label" for="name">Имя <sup>*</sup></label>

        <input class="form__input
        <?php if (isset($errors['name'])): ?>
            form__input--error"
        <?php endif; ?>
        type="text" name="signup[name]" id="name" value="" placeholder="Введите имя">

        <?php if (isset($errors['name'])): ?>
            <p class="form__message">
                <span class="error-message">Заполните это поле</span>
            </p>
        <?php endif; ?>

    </div>


    <!-- Зарегистрироваться -->
    <div class="form__row form__row--controls">

        <input class="button" type="submit" name="" value="Зарегистрироваться">

        <?php if (isset($errors['invaild_email'])): ?>
            <p class="error-message">Пожалуйста, исправьте ошибки в форме:</p>
        <?php endif; ?>

        <?php if (isset($errors['used_email'])): ?>
            <p class="error-message">Пожалуйста, исправьте ошибки в форме:</p>
        <?php endif; ?>

        <?php if (isset($errors['invaild_email'])): ?>
            <p class="form__message">- E-mail введён некорректно</p>
        <?php endif; ?>

        <?php if (isset($errors['used_email'])): ?>
            <p class="form__message">- Пользователь с этим email уже зарегистрирован</p>
        <?php endif; ?>

    </div>
</form>
