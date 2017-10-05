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
        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriSegments = explode('/', $uriPath);
        
        $id = $uriSegments[2];

        $task = $this->ci->taskModel->find($id);

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
        $uriPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uriSegments = explode('/', $uriPath);

        $id = $uriSegments[2];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

        $this->ci->taskModel->update($id, ['name' => $name]);

        header('Location: /tasks');
        exit;
    }
}
