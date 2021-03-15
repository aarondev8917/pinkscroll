<?php

// echo "Hello World!";

require_once __DIR__ . '/../vendor/autoload.php';
use app\controllers\FeedController;
use app\core\Application;

$app = new Application(dirname(__DIR__));

$app->router->get('/', 'home');

// $app->router->get('/feed', 'feed');
$app->router->get('/feed', [FeedController::class, 'handlefeed']);
$app->router->get('/feed/:id', [FeedController::class, 'handleMultiplefeeds']);


$app->run();