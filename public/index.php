<?php
require_once __DIR__ . '/../src/Router.php';

use App\Router;

$router = new Router();
$router->handle($_SERVER['REQUEST_URI'], $_GET);
