<?php

namespace App\Exception;

use App\View\Renderable;
use App\View\View;

class NotFoundException extends ApplicationException implements Renderable
{
    public function render()
    {
        header('HTTP/1.1 404 Not Found', true, 404);

        $exceptionPage = new View('errors.404', ['text' => 'Ошибка 404. Страница не найдена']);
        $exceptionPage->render();
    }
}
