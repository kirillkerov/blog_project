<?php
require_once HEADER;
if (isset($_SESSION['result'])) {
    $result = $_SESSION['result'];
    unset($_SESSION['result']);
}
?>

<h1>Управление сайтом</h1>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <?php foreach ($nav as $key => $page): ?>
            <?php if ($key === array_key_last($nav)): ?>
                <li class="breadcrumb-item active" aria-current="page"><?= $page['name'] ?></li>
            <?php else: ?>
                <li class="breadcrumb-item"><a href="<?= $page['link'] ?>"><?= $page['name'] ?></a></li>
            <?php endif ?>
        <?php endforeach ?>
    </ol>
</nav>