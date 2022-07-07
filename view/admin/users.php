<?php require_once ADMIN_HEADER; ?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Имя</th>
        <th scope="col">Фамилия</th>
        <th scope="col">Почта</th>
        <th scope="col">Роль</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['first_name'] ?></td>
            <td><?= $user['second_name'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['group'] ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<?php require_once FOOTER; ?>
