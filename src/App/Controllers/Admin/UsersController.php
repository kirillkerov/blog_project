<?php

namespace App\Controllers\Admin;

use App\Models\Group;
use App\Models\User;
use App\View\View;

class UsersController extends AbstractAdminController
{
    public function users(): View
    {
        if ($this->user->group_id !== 1) {
            $this->redirect('/admin_panel', 'Доступ к данному разделу открыт только Администраторам');
        }

        return new View('/admin/users', [
            'users' => User::getUsers(),
            'nav' => $this->getNav($this->nav['users']),
        ]);
    }
}
