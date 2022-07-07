<?php

namespace App\Service;

use App\Models\Subscribe;
use App\Exception\InvalidArgumentException;

class SubscribeService
{
    public static function subscribe(): bool
    {
        if (empty($_POST['email'])) {
            throw new InvalidArgumentException('Введите Email');
        }

        if (empty($_POST['policy'])) {
            throw new InvalidArgumentException('Отсутствует согласие с политикой конфиденциальности');
        }

        if (Subscribe::where('email', $_POST['email'])->first()) {
            setcookie('subscribe', $_POST['email'], time() + 3600, '/');
            throw new InvalidArgumentException('Вы уже подписаны на рассылку');
        }

        $subscribe = new Subscribe;
        $subscribe->email = $_POST['email'];
        $subscribe->save();
        setcookie('subscribe', $_POST['email'], time() + 3600, '/');

        return true;
    }
}
