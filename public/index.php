<?php

require_once '../src/vendor/autoload.php';
use src\app\controllers\PostController;
use src\app\controllers\UserController;
session_start();


// Простая маршрутизация на основе запроса
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Обработка запросов на разные страницы
switch ($page) {
    case 'home':
        $controller = new PostController();
        $controller->index();
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'create':
        $controller = new PostController();
        $controller->create();
        break;
    case 'view':
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $controller = new PostController();
        $controller->view($id);
        break;
    case 'search':
        $search = isset($_GET['search']) ? $_GET['search'] : null;
        $controller = new PostController();
        $controller->search($search);
        break;
    default:
        echo "404 Not Found";
        break;
}
