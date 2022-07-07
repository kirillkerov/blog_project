<?php require_once ADMIN_HEADER ?>

<?php if (isset($result)): ?>
    <div class="alert alert-success" role="alert">
        Страница "<a href="/page/<?= $result['pageName'] ?>"><?= $result['pageName'] ?></a>" успешно <?= ($result['action'] === 'created') ? 'создана' : 'обновлена' ?>
    </div>
<?php endif ?>

<a href="/admin/pages/create" class="btn btn-sm btn-secondary">Создать новую страницу</a>

<table class="table caption-top table-sm">
    <caption>Список статичных страниц</caption>
    <thead>
        <tr>
            <th scope="col">Имя</th>
            <th scope="col">Заголовок</th>
            <th scope="col">Автор</th>
            <th scope="col">Модерация</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($staticPages as $page): ?>
        <tr id="<?= $page['name'] ?>">
            <th scope="row"><?= $page['name'] ?></th>
            <td><?= $page['title'] ?></td>
            <td><?= $page['user_email'] ?></td>
            <td>
                <?php if ($thisUserEmail === $page['user_email']): ?>
                    <div class="btn-group">
                        <a href="/admin/pages/update/<?= $page['id'] ?>" type="button" class="btn btn-success btn-sm">Редактировать</a>
                        <button type="button" class="deletePage btn btn-danger btn-sm" name="delete">Удалить</button>
                    </div>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach  ?>
    </tbody>
</table>

<?php require_once FOOTER ?>
