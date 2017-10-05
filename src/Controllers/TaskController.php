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

        $task = $this->ci->taskModel->find($id);

        $response = $this->ci->view->render($response, "task-edit.php", ['task' => $task]);

        return $response;
    }

    public function update($request, $response)
    {
        $uriSegments = explode('/', $request->getUri()->getPath());

        $id = $uriSegments[2];

        $inputs = $request->getParsedBody();

        $this->ci->taskModel->update($id, ['name' => $inputs['name']]);

        header('Location: /tasks');
        exit;
    }
}
