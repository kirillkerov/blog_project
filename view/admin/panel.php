<?php require_once ADMIN_HEADER; ?>

<div class="admin__section">
    <div class="card bg-light mb-3">
        <div class="card-header">
            <h3>Комментарии</h3>
        </div>
        <div class="card-body">
            <table class="table caption-top table-sm">
                <caption>Ожидают модерации</caption>
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Дата</th>
                    <th scope="col">Автор</th>
                    <th scope="col">Текст</th>
                    <th scope="col">Решение</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($commentsNeedsModeration as $comment): ?>
                    <tr id="<?= $comment['id'] ?>">
                        <th scope="row"><?= $comment['id'] ?></th>
                        <td><?= formatDate($comment['created_at']) ?></td>
                        <td><?= $comment['user_email'] ?></td>
                        <td><?= $comment['text'] ?></td>
                        <td>
                            <div class="btn-group">
                                <button type="button" class="moderationComment btn btn-success btn-sm">Принять</button>
                                <button type="button" class="deleteComment btn btn-danger btn-sm">Удалить</button>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="/admin/comments" class="btn btn-sm btn-secondary">Все комментарии</a>
        </div>
    </div>

    <div class="row" data-masonry='{ "percentPosition": true }'>
        <div class="col-12 col-lg-6 admin__users">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <h3>Пользователи</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="number d-flex justify-content-center align-items-center rounded-circle bg-info text-light p-4">
                                <?= $users['countUsers'] ?>
                            </div>
                            <div class="sign text-center mt-2">Всего</div>
                        </div>
                        <div class="col">
                            <div class="number d-flex justify-content-center align-items-center rounded-circle bg-info text-light p-4">
                                <?= $users['countManagers'] ?>
                            </div>
                            <div class="sign text-center mt-2">Контент-менеджеров</div>
                        </div>
                        <div class="col">
                            <div class="number d-flex justify-content-center align-items-center rounded-circle bg-info text-light p-4">
                                <?= $users['countAdmins'] ?>
                            </div>
                            <div class="sign text-center mt-2">Администраторов</div>
                        </div>
                    </div>

                    <hr>

                    <table class="table caption-top table-sm">
                        <caption>Последние регистрации</caption>
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Имя</th>
                                <th scope="col">Фамилия</th>
                                <th scope="col">Почта</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users['lastUsers'] as $user): ?>
                                <tr>
                                    <th scope="row"><?= $user['id'] ?></th>
                                    <td><?= $user['first_name'] ?></td>
                                    <td><?= $user['second_name'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/admin/users" class="btn btn-sm btn-secondary">Все пользователи</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <h3>Статьи</h3>
                </div>
                <div class="card-body">
                    <table class="table caption-top table-sm">
                        <caption>Мои последние статьи</caption>
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Дата</th>
                            <th scope="col">Заголовок</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($thisUserPosts as $post): ?>
                            <tr>
                                <th scope="row"><?= $post['id'] ?></th>
                                <td><?= formatDate($post['created_at']) ?></td>
                                <td><a href="/post/<?= $post['id'] ?>" class="link-dark"><?= $post['title'] ?></a></td>
                            </tr>
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/admin/posts" class="btn btn-sm btn-secondary">Все статьи</a>
                    <a href="/admin/posts/create" class="btn btn-sm btn-secondary">Создать новую статью</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <h3>Управление страницами</h3>
                </div>
                <div class="card-body">
                    <table class="table caption-top table-sm">
                        <caption>Список статичных страниц</caption>
                        <thead>
                            <tr>
                                <th scope="col">Имя</th>
                                <th scope="col">Заголовок</th>
                                <th scope="col">Автор</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($staticPages as $page): ?>
                                <tr>
                                    <th scope="row"><?= $page['name'] ?></th>
                                    <td><?= $page['title'] ?></td>
                                    <td><?= $page['user_email'] ?></td>
                                </tr>
                            <?php endforeach  ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/admin/pages" class="btn btn-sm btn-secondary">Все страницы</a>
                    <a href="/admin/pages/create" class="btn btn-sm btn-secondary">Создать новую страницу</a>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card bg-light mb-3">
                <div class="card-header">
                    <h3>Настройки блога</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-floating mb-3">
                            <input type="number" min="6" name="mainPagino" value="<?= $mainPagino ?>" class="form-control" placeholder="Количество выводимых статей на странице">
                            <label>Количество выводимых статей на странице</label>
                        </div>
                        <button type="submit" class="btn btn-dark">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once FOOTER; ?>