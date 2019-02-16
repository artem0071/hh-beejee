<?php


namespace App\Models;


use Kernel\App;

class Task
{

    protected static $table = 'tasks';

    public static function store($data)
    {
        return App::$DB->insert(self::$table, $data + [
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }

    public static function findOrFail($id)
    {
        $tasks = App::$DB->query("Select * from " . self::$table . " where id = :id", [
            'id' => $id
        ]);

        if (count($tasks) != 1) {
            abort('Not founded', 404);
        }

        return $tasks[0];
    }

    public static function update($id, $data)
    {
        App::$DB->update(self::$table, $data, ['id' => $id]);
    }

}