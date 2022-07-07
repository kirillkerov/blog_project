<?php require_once ADMIN_HEADER; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>

<form action="/admin/posts/<?= $form['action'] ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label for="title" class="form-label">Заголовок</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $form['title'] ?>" required>
    </div>
    <div class="mb-3">
        <label for="img" class="form-label">Картинка</label>
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
        <input class="form-control form-control-sm" id="img" type="file" name="img">
    </div>
    <?php if (!empty($form['img'])): ?>
        <img src="<?= '/view/img/posts/' . $form['img'] ?>" class="mb-3" width="400">
        <input type="text" name="id" value="<?= $form['postId'] ?>" hidden>
    <?php endif ?>
    <div class="mb-3">
        <label for="text" class="form-label">Текст</label>
        <textarea class="form-control" id="text" name="text" rows="3" required><?= $form['text'] ?></textarea>
    </div>
    <button type="submit" class="btn btn-dark" name="<?= $form['action'] ?>"><?= $form['btn'] ?></button>
</form>

<?php require_once FOOTER; ?>
