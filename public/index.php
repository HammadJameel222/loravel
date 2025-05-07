<?php

// require_once __DIR__ . '/core/Router.php';
// require_once __DIR__ . '/core/Application.php';

require_once __DIR__ .'/../vendor/autoload.php';
// echo "<pre>";
// var_dump();
// echo "</pre>";

use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/',"home");

$app->router->get('/contact', 'contact');

$app->router->post('/contact', function () {
    return 'Contact Post request!';
});

$app->run();
