<?php require_once 'layout/header.php' ?>
<?php use \yidas\widgets\Pagination; ?>

<h1 class="mb-2"><?= $title ?></h1>

<div class="row article__list align-items-start">
    <?php foreach ($posts as $post): ?>
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="article__date"><?= formatDate($post['created_at']) ?></div>
                    <h5 class="card-title article__title"><?= $post['title'] ?></h5>
                </div>
                <div class="card-body">
                    <img src="/view/img/posts/<?= $post['img'] ?>" class="card-img-top" alt="Картинка поста">
                    <p class="card-text article__text"><?= mb_strimwidth($post['text'], 0, 200, '...') ?></p>
                    <a href="/post/<?= $post['id'] ?>" class="stretched-link"></a>
                </div>
            </div>
        </div>
    <?php endforeach ?>
<div>
    <?= Pagination::widget([
        'pagination' => $pagination,
        'firstPageLabel' => '',
        'lastPageLabel' => '',
        'nextPageLabel' => '<i class="bi bi-caret-right"></i>',
        'prevPageLabel' => '<i class="bi bi-caret-left"></i>',
    ]) ?>
</div>

<?php require_once 'layout/footer.php' ?>