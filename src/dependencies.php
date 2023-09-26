<?php

// 의존성 주입 설정

use App\Csrf;
use App\Models\Task;
use App\Models\TaskModel;

$container = $app->getContainer();

// view renderer
$container['view'] = function () {
    return new Slim\Views\PhpRenderer(__DIR__ . '/../views/');
};

// monolog
$container['logger'] = function ($container) {
    $settings = $container->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO
$container['pdo'] = function ($container) {
    $settings = $container->get('settings')['db'];
    return new PDO(
        "mysql:host={$settings['host']};dbname={$settings['database']};charset=utf8",
        $settings['user'],
        $settings['pw']
    );
};

// Eloquent ORM
$capsule = new \Illuminate\Database\Capsule\Manager();
$capsule->addConnection($container['settings']['db']);

$capsule->setAsGlobal();
$capsule->bootEloquent();
$container['db'] = function () use ($capsule) {
    return $capsule;
};

// TaskModel
$container['taskModel'] = function () {
    return new Task();
};

// CSRF
$container['csrf'] = function () {
    $csrf = new Csrf();
    $csrf->setPersistentTokenMode(true);
    return $csrf;
};
