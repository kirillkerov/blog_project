<?php

namespace App;

use App\View\Renderable;
use App\Exception\ApplicationException;
use App\Exception\HttpException;
use Illuminate\Database\Capsule\Manager as Capsule;

class Application
{
    private Router $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->initialize();
    }

    public function run(string $url, string $method)
    {
        try {
            $result = $this->router->dispatch($url, $method);

            if ($result instanceof Renderable) {
                $result->render();
            } else {
                echo $result;
            }
        } catch (ApplicationException $e) {
            $this->renderException($e);
        }
    }

    private function renderException(ApplicationException $e)
    {
        if ($e instanceof Renderable) {
            $e->render();
        }

        if ($e instanceof HttpException) {
            $exceptionCode = ($e->getCode() !== 0) ? $e->getCode() : 500;
            http_response_code($exceptionCode);

            include VIEW_DIR . 'errors/error.php';
        }
    }

    private function initialize()
    {
        $capsule = new Capsule;
        $db = Config::getInstance()->get('db');

        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => $db['host'],
            'database' => $db['database'],
            'username' => $db['username'],
            'password' => $db['password'],
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();

        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
    }
}
