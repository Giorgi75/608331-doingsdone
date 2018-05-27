<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.html" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox"<?= ($show_complete_tasks) ? " checked" : "" ?>>
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $task): ?>
        <?php if ($show_complete_tasks): ?>
            <tr class="tasks__item task<?php if ($task['date_completed']) {
                echo " task--completed";
            } elseif (is_task_deadline($task['task_deadline'])) {
                echo " task--important";
            }; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1"
                            <?= ($task['date_completed']) ? " checked" : ""; ?>>
                        <span class="checkbox__text"><?= ($task['name']); ?></span>
                    </label>
                </td>
                <?php if ($task['file']) { ?>
                    <td class="task__file">
                        <a class="download-link" href="#"><?= $task['file']; ?></a>
                    </td>
                <?php } ?>

                <td class="task__date"><?= $task['date_created']; ?></td>
            </tr>
        <?php elseif (!$task['date_completed']): ?>
            <tr class="tasks__item task<?= (is_task_deadline($task['task_deadline'])) ? " task--important" : ""; ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                        <span class="checkbox__text"><?= ($task['name']); ?></span>
                    </label>
                </td>
                <?php if ($task['file']) { ?>
                    <td class="task__file">
                        <a class="download-link" href="#"><?= $task['file']; ?></a>
                    </td>
                <?php } ?>

                <td class="task__date"><?= $task['date_created']; ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>