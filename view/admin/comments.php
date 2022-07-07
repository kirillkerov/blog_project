<?php require_once ADMIN_HEADER; ?>

<table class="table">
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
    <?php foreach ($comments as $comment): ?>
        <tr id="<?= $comment['id'] ?>">
            <th scope="row"><?= $comment['id'] ?></th>
            <td><?= formatDate($comment['created_at']) ?></td>
            <td><?= $comment['user_email'] ?></td>
            <td><?= $comment['text'] ?></td>
            <td>
                <?php if (!$comment['moderation']): ?>
                    <div class="btn-group">
                        <button type="button" class="moderationComment btn btn-success btn-sm">Принять</button>
                        <button type="button" class="deleteComment btn btn-danger btn-sm">Удалить</button>
                    </div>
                <?php else: ?>
                    <span class="badge bg-success">Принято</span>
                <?php endif ?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?php require_once FOOTER; ?>
