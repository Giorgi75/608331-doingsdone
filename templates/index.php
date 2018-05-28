<div class="container container--with-sidebar">
    <header class="main-header">
        <a href="index.php">
            <img src="img/logo.png" width="153" height="42" alt="Логотип Дела в порядке">
        </a>

        <div class="main-header__side">
            <?php if ($is_auth): ?>
                <a class="main-header__side-item button button--plus open-modal" href="javascript:;"
                   target="task_add">Добавить задачу</a>

                <div class="main-header__side-item user-menu">
                    <div class="user-menu__image">
                        <img src="img/user-pic.jpg" width="40" height="40" alt="Пользователь">
                    </div>

                    <div class="user-menu__data">
                        <p><?= $_SESSION['user']['name']; ?></p>

                        <a href="logout.php">Выйти</a>
                    </div>
                </div>
            <?php else: ?>
                <a class="main-header__side-item button button--transparent" href="login.php">Войти</a>
            <?php endif; ?>
        </div>

    </header>

    <div class="content">
        <section class="content__side">
            <h2 class="content__side-heading">Проекты</h2>

            <nav class="main-navigation">
                <ul class="main-navigation__list">
                    <li class="main-navigation__list-item<?= (empty($_GET['project_id'])) ? ' main-navigation__list-item--active' : ''; ?>">
                        <a class="main-navigation__list-item-link" href="index.php<?= (!empty($_GET['show_completed'])) ? '?show_completed=' . $_GET['show_completed']: ''?>">Все</a>
                        <span class="main-navigation__list-item-count"><?= count_tasks($all_tasks); ?></span>
                    </li>
                    <?php foreach ($projects as $project): ?>
                        <li class="main-navigation__list-item<?= (!empty($_GET['project_id']) && $_GET['project_id'] == $project['id']) ? ' main-navigation__list-item--active' : ''; ?>">
                            <a class="main-navigation__list-item-link" href="index.php?project_id=<?= $project['id']; ?><?= (!empty($_GET['show_completed'])) ? '&show_completed=' . $_GET['show_completed']: ''?>"><?= $project['name']; ?></a>
                            <span class="main-navigation__list-item-count"><?= count_tasks($all_tasks, $project['id']); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <a class="button button--transparent button--plus content__side-button open-modal"
               href="javascript:;" target="project_add">Добавить проект</a>
        </section>

        <main class="content__main">
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

                            <td class="task__date"><?= $task['task_deadline']; ?></td>
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

                            <td class="task__date"><?= $task['task_deadline']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </table>
        </main>
    </div>
</div>
