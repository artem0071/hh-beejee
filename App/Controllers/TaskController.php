<?php


namespace App\Controllers;

use App\Models\Task;
use Kernel\App;

class TaskController
{

    public function index()
    {
        $tasks = Task::paginate(App::$Router->data);

        echo view('page.tasks', [
            'tasks' => $tasks['data'],
            'meta' => $tasks['meta']
        ]);
    }

    public function store()
    {
        $validated = App::$Router->checkData(['name', 'email', 'text']);

        Task::store($validated);

        go('/');
    }

    public function show($params)
    {
        if (! $_SESSION['is_auth']) {
            go('/login');
        }

        $data = App::$Router->data;

        echo view('page.task', [
            'task' => Task::findOrFail($params[0]),
            'updated' => key_exists('status', $data)
        ]);
    }

    public function update($params)
    {
        if (! $_SESSION['is_auth']) {
            go('/login');
        }

        $taskId = $params[0];

        $task = Task::findOrFail($taskId);

        $data = App::$Router->checkData(['text']);

        $isMarked = key_exists('marked', App::$Router->data);

        if ($task->marked_at && !$isMarked) {
            $data['marked_at'] = null;
        }

        if (!$task->marked_at && $isMarked) {
            $data['marked_at'] = date("Y-m-d H:i:s");
        }

        Task::update($taskId, $data);

        go('/tasks/' . $taskId . '?status=updated');
    }
}