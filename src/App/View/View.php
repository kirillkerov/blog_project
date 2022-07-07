<?php

namespace App\View;

use App\Exception\ApplicationException;

class View implements Renderable
{
    private string $view;
    private array $data;

    public function __construct($view, $data)
    {
        $this->view = $view;
        $this->data = $data;
    }

    public function render()
    {
        $thisUserName = $_SESSION['userName'] ?? null;
        extract($this->data);

        if (is_file($this->getIncludeTemplate($this->view))) {
            include $this->getIncludeTemplate($this->view);
        } else {
            throw new ApplicationException($this->getIncludeTemplate($this->view) . ' шаблон не найден!');
        }
    }

    private function getIncludeTemplate($view)
    {
        $view = str_replace('.php', '', $view);
        $view = str_replace('.', DIRECTORY_SEPARATOR, $view);
        return VIEW_DIR . $view . '.php';
    }
}
