<?php
namespace App\Controllers;

use Interop\Container\ContainerInterface;

class TaskController
{
    protected $ci;

    public function __construct(ContainerInterface $ci)
    {
        $this->ci = $ci;
    }

    public function index($request, $response)
    {
        $tasks = $this->ci->taskModel->all();
        $response = $this->ci->view->render($response, "task-list-html.php", [
            'tasks' => $tasks,
            'csrf' => $this->ci->csrf->getAll()
        ]);
        return $response;
    }

    public function store($request, $response)
    {
        $inputs = $request->getParsedBody();

        $this->ci->taskModel->create([
            'name' => $inputs['name']
        ]);

        return $response->withStatus(302)->withHeader('Location', '/tasks');
    }

    public function edit($request, $response)
    {
        $uriSegments = explode('/', $request->getUri()->getPath());

        $id = $uriSegments[2];

        $mysqli = new \mysqli('localhost', 'homestead', 'secret', 'pnb');
        $mysqli->set_charset("utf8mb4");

        $result = $mysqli->query("SELECT * FROM tasks WHERE id={$id}");

        $task = $result->fetch_assoc();

        $response = $this->ci->view->render(
            $response,
            "task-edit.php",
            [
                'task' => $task,
                'csrf' => $this->ci->csrf->getAll()
            ]
        );

        return $response;
    }

    public function update($request, $response)
    {
        $uriSegments = explode('/', $request->getUri()->getPath());

        $id = $uriSegments[2];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $mysqli = new \mysqli('localhost', 'homestead', 'secret', 'pnb');
        $mysqli->set_charset("utf8mb4");

        $mysqli->query("UPDATE tasks SET name = '{$name}' WHERE id = {$id}");

        header('Location: /tasks');
        exit;
    }
}
