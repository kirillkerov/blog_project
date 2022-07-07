<?php

use App\Application;
use App\Controllers\Admin\CommentsController;
use App\Controllers\Admin\PagesController;
use App\Controllers\Admin\PanelController;
use App\Controllers\Admin\PostsController;
use App\Controllers\Admin\UsersController;
use App\Controllers\CommentController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Controllers\StaticPageController;
use App\Controllers\UserController;
use App\Controllers\ProfileController;
use App\Router;

error_reporting(E_ALL);
ini_set('display_errors',true);

require_once __DIR__ . '/bootstrap.php';

$router = new Router();

$router->get('', [HomeController::class, 'index']);

$router->get('post/*', [PostController::class, 'post']);

$router->post('comment/*', [CommentController::class, 'comment']);

$router->get('page/*', [StaticPageController::class, 'show']);
$router->get('policy', [StaticPageController::class, 'policy']);

$router->post('login', [UserController::class, 'login']);
$router->post('subscribe', [UserController::class, 'subscribe']);
$router->post('registration', [UserController::class, 'registration']);

$router->get('profile/*', [ProfileController::class, 'profile']);
$router->post('profile/*', [ProfileController::class, 'profile']);
$router->get('logout', [ProfileController::class, 'logout']);

$router->get('admin', [PanelController::class, 'panel']);
$router->post('admin', [PanelController::class, 'panel']);

$router->get('admin/comments', [CommentsController::class, 'comments']);
$router->post('admin/comments/moderation', [CommentsController::class, 'moderation']);
$router->post('admin/comments/delete', [CommentsController::class, 'delete']);

$router->get('admin/users', [UsersController::class, 'users']);

$router->get('admin/posts', [PostsController::class, 'posts']);
$router->get('admin/posts/create', [PostsController::class, 'create']);
$router->post('admin/posts/create', [PostsController::class, 'create']);
$router->get('admin/posts/update/*', [PostsController::class, 'update']);
$router->post('admin/posts/update', [PostsController::class, 'update']);
$router->post('admin/posts/delete', [PostsController::class, 'delete']);

$router->get('admin/pages', [PagesController::class, 'pages']);
$router->get('admin/pages/create', [PagesController::class, 'create']);
$router->post('admin/pages/create', [PagesController::class, 'create']);
$router->get('admin/pages/update/*', [PagesController::class, 'update']);
$router->post('admin/pages/update/*', [PagesController::class, 'update']);
$router->post('admin/pages/delete', [PagesController::class, 'delete']);

session_start();

$application = new Application($router);
$application->run($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
