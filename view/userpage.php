<?php require_once 'layout/header.php'?>

<div class="userpage mt-3">
    <div class="userpage user-card">
        <div class="row justify-content-md-center align-items-center">
            <div class="col-auto">
                <div class="user-card__photo">
                    <img src="/view/img/users/<?= $user['img'] ?>" alt="">
                </div>
            </div>
            <div class="col-auto">
                <div class="user-card__role"><?= $group ?></div>
                <div class="user-card__name"><?= $user['first_name'] . ' ' . $user['second_name'] ?></div>
                <div class="user-card__email"><a href="mailto:<?= $user['email'] ?>"><?= $user['email'] ?></a></div>
            </div>
        </div>
    </div>

    <div class="userpage__forms">
        <div class="row justify-content-center mt-3">
            <div class="col-12 col-lg-4">
                <h5 class="mb-3">Обновить фото профиля</h5>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
                        <input class="form-control form-control-sm" id="formFileSm" type="file" name="userPhoto" required>
                    </div>
                    <input type="text" name="newUserPhoto" hidden>
                    <span class="form__error"><?= $update['error']['img'] ?? '' ?></span>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-dark">Обновить фото</button>
                    </div>
                </form>
                <h5 class="mb-3">Профиль</h5>
                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="firstName" value="<?= $user['first_name'] ?>" class="form-control" placeholder="Имя">
                        <label>Имя</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="secondName" value="<?= $user['second_name'] ?>" class="form-control" placeholder="Фамилия">
                        <label>Фамилия</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="about" class="form-control" placeholder="О себе"><?= $user['about'] ?></textarea>
                        <label>О себе</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" name="mailing" type="checkbox" role="switch" <?= $user['is_mailing'] ? 'checked' : '' ?>>
                        <label class="form-check-label">Подписаться на рассылку</label>
                    </div>
                    <input type="text" name="newUserData" hidden>
                    <button type="submit" class="btn btn-dark">Сохранить</button>
                </form>
            </div>
            <div class="col-12 col-lg-3">
                <h5 class="mb-3">Изменение пароля</h5>
                <form method="post">
                    <div class="form-floating mb-3">
                        <input type="password" name="currentPassword" class="form-control" placeholder="Текущий пароль" required>
                        <label>Текущий пароль</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="newPassword1" class="form-control" placeholder="Новый пароль" required>
                        <label>Новый пароль</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" name="newPassword2" class="form-control" placeholder="Повторите новый пароль" required>
                        <label>Повторите новый пароль</label>
                    </div>
                    <input type="text" name="newUserPassword" hidden>
                    <span class="form__error"><?= $update['error']['password'] ?? '' ?></span>
                    <span class="form__access"><?= $update['access']['password'] ?? '' ?></span>
                    <button type="submit" class="btn btn-dark">Сохранить</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'layout/footer.php'?>