<?php


namespace Kernel\DB;


use Exception;
use PDO;

class QueryBuilder
{

    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function pdo()
    {
        return $this->pdo;
    }

    public function query($q, $params = [])
    {
        $statement = $this->pdo->prepare($q);

        $statement->execute($params);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($table, $param){
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($param)),
            ':' . implode(', :', array_keys($param))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($param);

            $id = $this->pdo->lastInsertId();

            return $id;
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    public function update($table, $param, $where){
        $keys = array();

        foreach ($param as $k=>$v){
            $keys[] = $k.' = :'.$k;
        }

        $newWhere = array();

        foreach ($where as $k=>$v){
            $newWhere[] = $k.' = :'.$k;
        }

        $sql = sprintf(
            'update %s set %s where %s',
            $table,
            implode(', ', $keys),
            implode(' and ', $newWhere)
        );

        $allParams = array_merge($param,$where);

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($allParams);

        } catch (Exception $e) {}
    }

    public function delete($table, $where)
    {
        $sql = "delete from {$table} {$where}";

        $statement = $this->pdo->prepare($sql);

        $statement->execute();
    }

}