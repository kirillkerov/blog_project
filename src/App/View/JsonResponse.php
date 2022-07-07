<?php

namespace App\View;

class JsonResponse implements Renderable
{
    private array $response;

    public function __construct($response)
    {
        $this->response = $response;
    }

    public function render()
    {
        echo json_encode($this->response);
    }
}
