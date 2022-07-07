<?php use yidas\widgets\Pagination;

require_once ADMIN_HEADER; ?>

<?php if (isset($result)): ?>
    <div class="alert alert-success" role="alert">
        Пост "<a href="/post/<?= $result['id'] ?>"><?= $result['title'] ?></a>" успешно <?= $result['action'] ?>
    </div>
<?php endif ?>

<a href="/admin/posts/create" class="btn btn-sm btn-secondary">Создать новую статью</a>

<div class="options mb-2 d-flex justify-content-end">
    <select id="sortBy" class="form-select form-select-sm options_select me-2" aria-label=".form-select-sm пример">
        <option hidden>Сортировка</option>
        <option value="DESC">Сначала новые</option>
        <option value="ASC">Сначала старые</option>
    </select>

    <select id="coutnPerPage" class="form-select form-select-sm options_select" aria-label=".form-select-sm пример">
        <option hidden>Количество</option>
        <option value="5">По 5</option>
        <option value="10">По 10</option>
        <option value="15">По 15</option>
        <option value="30">По 30</option>
    </select>
</div>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Дата</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Автор</th>
        <th scope="col">Модерация</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($posts as $post): ?>
        <tr id="<?= $post['id'] ?>">
            <th scope="row"><?= $post['id'] ?></th>
            <td><?= formatDate($post['created_at']) ?></td>
            <td><a href="/post/<?= $post['id'] ?>" class="link-dark"><?= $post['title'] ?></a></td>
            <td><?= $post['user_email'] ?></td>
            <td>
                <?php if ($thisUserEmail === $post['user_email']): ?>
                    <div class="btn-group">
                        <a href="/admin/posts/update/<?= $post['id'] ?>" type="button" class="btn btn-success btn-sm">Редактировать</a>
                        <button type="button" class="deletePost btn btn-danger btn-sm" name="delete">Удалить</button>
                    </div>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<div>
    <?= Pagination::widget([
        'pagination' => $pagination,
        'firstPageLabel' => '',
        'lastPageLabel' => '',
        'nextPageLabel' => '<i class="bi bi-caret-right"></i>',
        'prevPageLabel' => '<i class="bi bi-caret-left"></i>',
    ]) ?>
</div>

<?php require_once FOOTER; ?>
