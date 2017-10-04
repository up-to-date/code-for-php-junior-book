<?php
// Routes
use App\Controllers\TaskController;

$app->get('/', TaskController::class.':index')->add($container->get('csrf'));
$app->get('/tasks', TaskController::class.':index')->add($container->get('csrf'));
$app->post('/tasks', TaskController::class.':store')->add($container->get('csrf'));

$app->get('/tasks/{id}/edit', TaskController::class . ':edit');
$app->put('/tasks/{id}', TaskController::class . ':update');
