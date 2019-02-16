<?php


namespace App\Controllers;

use App\Models\Task;
use Kernel\App;

class TaskController
{

    public function index()
    {
        echo view('page.tasks');
    }

    public function store()
    {
        $validated = App::$Router->checkData(['name', 'email', 'text']);

        header('Location: /tasks/' . Task::store($validated));
    }

    public function show($params)
    {
        $data = App::$Router->data;

        echo view('page.task', [
            'task' => Task::findOrFail($params[0]),
            'updated' => key_exists('status', $data)
        ]);
    }

    public function update($params)
    {
        $taskId = $params[0];

        Task::findOrFail($taskId);

        Task::update($taskId, App::$Router->checkData(['text']));

        header('Location: /tasks/' . $taskId . '?status=updated');
    }

    public function destroy()
    {

    }

}