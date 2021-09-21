<?php
declare(strict_types=1);

use Bramus\Router\Router;

require_once 'vendor/autoload.php';

$router = new Router();
$router->setNamespace('\Api\Controllers');
$router->get('/', 'GameController@show');
$router->post('/restart', 'GameController@reset');
$router->delete('/', 'GameController@destroy');
$router->post('/(\w+)', 'GameController@store');
$router->set404('ErrorController@show');
$router->run();
