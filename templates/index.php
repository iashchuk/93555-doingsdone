<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="<?= set_filter("all"); ?>" class="tasks-switch__item
        <?php if ($tasks_switch == null || $tasks_switch == "all"): ?>tasks-switch__item--active<?php endif; ?>">Все задачи</a>

        <a href="<?= set_filter("today"); ?>" class="tasks-switch__item
        <?php if ($tasks_switch == "today"): ?>tasks-switch__item--active<?php endif; ?>">Повестка дня</a>

        <a href="<?= set_filter("tomorrow"); ?>" class="tasks-switch__item
        <?php if ($tasks_switch == "tomorrow"): ?>tasks-switch__item--active<?php endif; ?>">Завтра</a>

        <a href="<?= set_filter("delay"); ?>" class="tasks-switch__item
        <?php if ($tasks_switch == "delay"): ?>tasks-switch__item--active<?php endif; ?>">Просроченные</a>
    </nav>

    <label class="checkbox">
        <input class="checkbox__input visually-hidden show_completed"
                <?php if ($show_complete_tasks): ?>checked<?php endif; ?>
                type="checkbox">
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $item): ?>
    <?php if ($show_complete_tasks === 1 || !$item['status']): ?>
    <tr class="tasks__item task
        <?=$item['status'] ? 'task--completed' : '' ?>
        <?=mark_task_important($item) ? 'task--important' : ''; ?>">
        <td class="task__select">
            <label class="checkbox task__checkbox">
                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="<?=$item["id"];?>"
                <?php if ($item['status']): ?>checked<?php endif; ?>>
                <span class="checkbox__text"><?=strip_tags($item['title']); ?></span>
            </label>
        </td>
        <td class="task__file">
            <?php if (isset($item['file']) && $item['file'] !== ""): ?>
                <a class="download-link" href="../uploads/<?= $item['file'] ?>"><?= $item['file'] ?></a>
            <?php endif; ?>
        </td>
        <td class="task__date">
            <?=$item['deadline'] ? set_date_format($item['deadline']) : '' ?>
        </td>
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>

    <?php if ($show_complete_tasks): ?>
        <tr class="tasks__item task task--completed">
        <td class="task__select">
            <label class="checkbox task__checkbox">
            <input class="checkbox__input visually-hidden" type="checkbox" checked>
            <span class="checkbox__text">Записаться на интенсив "Базовый PHP"</span>
            </label>
        </td>
        <td class="task__date">10.10.2018</td>

        <td class="task__controls">
        </td>
        </tr>
    <?php endif; ?>
</table>
