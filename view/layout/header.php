<?php if (isset($_SESSION['notAccess'])): ?>
    <script>
        alert('<?= $_SESSION['notAccess'] ?>')
    </script>
<?php unset($_SESSION['notAccess']) ?>
<?php endif ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>our cms</title>

    <link rel="stylesheet" href="/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="/view/css/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid justify-content-between">
            <div class="as">-WEB-</div>

            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="/" class="nav-link px-2 link-secondary">Главная</a></li>
                <?php foreach ($pages = App\Models\Page::all() as $page): ?>
                    <li><a href="/page/<?= $page['name'] ?>" class="nav-link px-2 link-secondary"><?= $page['title'] ?></a></li>
                <?php endforeach ?>
            </ul>

            <?php if (!empty($_SESSION['user'])): ?>
                <div class="user-menu">
                    <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['user']['name'] ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-start dropdown-menu-md-end">
                        <li><a class="dropdown-item" href="/profile/<?= $_SESSION['user']['id'] ?>">Мой профиль</a></li>
                        <?php if ($_SESSION['user']['group'] != NULL): ?>
                            <li><a class="dropdown-item" href="/admin">Панель управления</a></li>
                        <?php endif ?>
                        <li><a class="dropdown-item" href="/logout">Выйти</a></li>
                    </ul>
                </div>
            <?php else: ?>
                <div class="enter">
                    <button id="subscribeButton" type="button" class="btn btn-outline-dark me-2" title="Подписаться на рассылку" data-bs-toggle="modal" data-bs-target="#subscribeModal">
                        <i class="bi bi-bell-fill"></i>
                    </button>

                    <!-- Button trigger modal Enter -->
                    <button type="button" class="btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#enterModal">Войти</button>

                    <!-- Modal Subscribe -->
                    <div class="modal fade" id="subscribeModal" tabindex="-1" aria-labelledby="mailingModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="subscribeModalLabel">Подписаться на рассылку</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <span class="modal__success" id="subscribe__success"></span>
                                    <form class="modal-form" id="subscribeForm">
                                        <div class="mb-3">
                                            <label for="subscribeModalInput" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="subscribeModalInput" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input name="policy" type="checkbox" class="form-check-input" id="registrationPolicycCheck2" required>
                                            <label class="form-check-label" for="registrationPolicyCheck2">Принимаю <a href="/policy" target="_blank">Политику конфиденциальности</a></label>
                                        </div>
                                        <span class="form__error"></span>
                                        <button type="submit" class="btn btn-dark">Подписаться</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Enter -->
                    <div class="modal fade" id="enterModal" tabindex="-1" aria-labelledby="enterModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="enterModalLabel">Авторизация</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <span class="modal__success"></span>
                                    <form class="modal-form" id="enterForm">
                                        <div class="mb-3">
                                            <label for="enterLoginInput" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="enterLoginInput" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="enterPasswordInput" class="form-label">Пароль</label>
                                            <input name="password" type="password" class="form-control" id="enterPasswordInput" required>
                                        </div>
                                        <span class="form__error"></span>
                                        <button type="submit" class="btn btn-dark">Войти</button>
                                        <!-- Button trigger modal Registration-->
                                        <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#registrationModal">Регистрация</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Registration-->
                    <div class="modal fade" id="registrationModal" tabindex="-1" aria-labelledby="registrationModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="registrationModalLabel">Регистрация</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <span class="modal__success"></span>
                                    <form class="modal-form" id="registrationForm">
                                        <div class="mb-3">
                                            <label for="registrationFirstnameInput" class="form-label">Имя</label>
                                            <input name="firstName" type="text" class="form-control" id="registrationFirstnameInput" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registrationSecondnameInput" class="form-label">Фамилия</label>
                                            <input name="secondName" type="text" class="form-control" id="registrationSecondnameInput" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="registrationEmailInput" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="registrationEmailInput" aria-describedby="emailHelp" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Пароль</label>
                                            <div class="form-floating mb-3">
                                                <input name="password1" type="password" class="form-control" id="registrationPasswordInput1" required>
                                                <label for="registrationPasswordInput1" class="form-label">Введите пароль</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input name="password2" type="password" class="form-control" id="registrationPasswordInput2" required>
                                                <label for="registrationPasswordInput2" class="form-label">Подтвердите пароль</label>
                                            </div>
                                        </div>
                                        <div class="mb-3 form-check">
                                            <input name="policy" type="checkbox" class="form-check-input" id="registrationPolicycCheck" required>
                                            <label class="form-check-label" for="registrationPolicyCheck">Принимаю <a href="/policy" target="_blank">Политику конфиденциальности</a></label>
                                        </div>
                                        <span class="form__error"></span>
                                        <button type="submit" class="btn btn-dark">Отправить</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif ?>
        </div>
    </nav>

    <div class="container">