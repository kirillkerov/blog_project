<?php require_once ADMIN_HEADER; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        Страница с именем "<?= $_POST['name'] ?>" уже существует
    </div>
<?php endif ?>

<form action="/admin/pages/<?= ($action === 'create') ? $action : $action . '/' . $currentPage['id'] ?>" method="post">
    <div class="mb-3">
        <label for="name" class="form-label">Название страницы</label>
        <input type="text" class="form-control" id="name" name="name" value="<?= $currentPage['name'] ?? '' ?>"  aria-describedby="nameHelpBlock" required>
        <div id="nameHelpBlock" class="form-text">
            Имя страницы должно быть уникальным
        </div>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $currentPage['title'] ?? '' ?>" required>
    </div>
    <div class="mb-3">
        <label for="text" class="form-label">Текст</label>
        <textarea class="form-control" id="text" name="text" rows="3" required><?= $currentPage['text'] ?? '' ?></textarea>
    </div>
    <button type="submit" class="btn btn-dark" name="<?= $action ?>"><?= ($action === 'update') ? 'Обновить' : 'Создать' ?></button>
</form>

<?php require_once FOOTER; ?>
