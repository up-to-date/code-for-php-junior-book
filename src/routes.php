<?php
// Routes
use App\Controllers\TaskController;

$app->get('/', TaskController::class.':index')->add($container->get('csrf'));
$app->get('/tasks', TaskController::class.':index')->add($container->get('csrf'));
$app->post('/tasks', TaskController::class.':store')->add($container->get('csrf'));

$app->get('/tasks/{id}/edit', TaskController::class . ':edit')->add($container->get('csrf'));
$app->put('/tasks/{id}', TaskController::class . ':update')->add($container->get('csrf'));
