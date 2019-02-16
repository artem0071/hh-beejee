<?php


namespace App\Models;


use Kernel\App;
use PDO;

class Task
{

    protected static $table = 'tasks';

    protected static $perPage = 3;

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

    public static function paginate($data)
    {
        $current_page = key_exists('page', $data) ? $data['page'] : 1;
        $orderBy = 'id';
        $direction = 'desc';

        if (key_exists('direction', $data) && in_array($data['direction'], ['asc', 'desc'])) {
            $direction = $data['direction'];
        }

        if (key_exists('orderBy', $data) && in_array($data['orderBy'], ['id', 'name', 'email'])) {
            $orderBy = $data['orderBy'];
        }

        $total = self::count();
        $limit = self::$perPage;

        // How many pages will there be
        $pages = (int) ceil($total / $limit);

        // What page are we currently on?
        $page = min($pages, $current_page);

        $offset = max((($page - 1)  * $limit), 0);

        $stmt = App::$DB->pdo()->prepare("Select * from tasks order by $orderBy $direction limit :limit offset :offset");


        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return [
            'data' => $stmt->fetchAll(PDO::FETCH_OBJ),
            'meta' => [
                'total' => $total,
                'last_page' => $pages,
                'current_page' => $page,
                'orderBy' => $orderBy,
                'direction' => $direction
            ]
        ];
    }

    public static function count()
    {
        return App::$DB->query('Select COUNT(*) as total from ' . self::$table)[0]->total;
    }

}