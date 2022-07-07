<?php

namespace App\Controllers;

use App\Models\User;

class AbstractPrivateController
{
    protected User $user;

    public function __construct()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if ($userId) {
            $this->user = User::find($userId);
        } else {
            $this->redirect('/', 'Вам не доступен данный раздел');
        }
    }

    protected function redirect($url, $message = null)
    {
        if ($message) {
            $_SESSION['notAccess'] = $message;
        }
        header('Location: ' . $url);
        exit;
    }
}
