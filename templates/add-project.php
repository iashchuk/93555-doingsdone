<h2 class="content__main-heading">Добавление проекта</h2>
    <form class="form" action="../add-project.php" method="post">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>
            <?php if (isset($errors["empty_project"]) || isset($errors["exist_project"])): ?>
                <p class="form__message">
                    <?= $errors["empty_project"] ?? ""; ?>
                    <?= $errors["exist_project"] ?? ""; ?>
                </p>
            <?php endif; ?>
            <input class="form__input
            <?php if (isset($errors["empty_project"]) || isset($errors["exist_project"])): ?>form__input--error
            <?php endif; ?>" type="text" name="project[title]" id="name" value="<?=strip_tags($value['title']); ?? ""; ?>" placeholder="Введите название проекта">
        </div>
        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
