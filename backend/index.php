<?php
declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use App\Database;
use App\BrandController;

// Initialize the database connection
$database = new Database();
$connection = $database->connect();

// Initialize Alto router
$router = new AltoRouter();

// Initialize the controller
$controller = new BrandController($connection);

// Map routes
$router->map( 'GET', '/', fn () => $controller->index());
$router->map( 'GET', '/[i:id]', fn ($id) => $controller->show((int) $id));
$router->map( 'POST', '/', fn () => $controller->store());
$router->map( 'PUT', '/[i:id]', fn ($id) => $controller->update((int) $id));
$router->map( 'DELETE', '/[i:id]', fn ($id) => $controller->destroy((int) $id));


// Alto router matching request
$match = $router->match();


if( is_array($match) && is_callable( $match['target'] ) ) {
    call_user_func_array( $match['target'], $match['params'] );
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}