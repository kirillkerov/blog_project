<?php require_once 'layout/header.php' ?>
<div class="article__page m-auto">
    <div class="article__date"><?= formatDate($post['created_at']) ?></div>
    <h2><?= $post['title'] ?></h2>
    <div class="article__img mb-3">
        <img src="/view/img/posts/<?= $post['img'] ?>" class="img-fluid" alt="Картинка поста">
    </div>
    <p class="article__text"><?= $post['text'] ?></p>

    <hr>

    <div class="comments">
        <h4 class="mb-3">Комментарии:</h4>
        <?php if (!empty($_SESSION['user'])):?>
            <form class="comment-form mb-3" id="commentForm" action="/comment/<?= $post['id'] ?>" method="post">
                <div class="mb-3">
                    <textarea name="comment" class="form-control" placeholder="Оставьте свой комментарий..." required></textarea>
                </div>
                <span class="comment__error"></span>
                <button type="submit" class="btn btn-dark">Отправить</button>
            </form>
        <?php else:?>
            <div class="alert alert-dark" role="alert">
                <div class="row">
                    <div class="col">Оставлять комментарии могут только авторизованные пользователи!</div>
                    <div class="col-auto">
                        <!-- Button trigger modal Enter -->
                        <button type="button" class="btn btn-sm btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#enterModal">Войти</button>
                    </div>
                </div>
            </div>
        <?php endif?>

        <?php foreach ($comments as $comment) :?>
            <div class="comments__item text-<?= $comment['moderation'] ? 'dark' : 'muted' ?> bg-light mb-3 p-3 border">
                <div class="comment__title d-flex justify-content-between">
                    <div class="comment__author d-flex align-items-center">
                        <div class="author__avatar me-2 rounded-circle">
                            <img src="/view/img/users/<?= $comment['user']['img'] ?>" alt="">
                        </div>
                        <div class="author__name"><?= $comment['user']['first_name'] . ' ' . $comment['user']['second_name'] ?></div>
                    </div>
                    <div class="data"><?= formatDate($comment['created_at']) ?></div>
                </div>
                <div class="comment_body">
                    <?= $comment['text'] ?>
                    <?php if (!$comment['moderation']): ?>
                        <div class="mb-2 text-primary text-end"><i class="bi bi-info-square-fill"></i> Ваш комментарий принят и находится на модерации</div>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach?>
    </div>
</div>

<?php require_once 'layout/footer.php' ?>