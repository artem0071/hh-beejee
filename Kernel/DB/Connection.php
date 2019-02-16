<?php


namespace Kernel\DB;

use PDO;
use PDOException;

class Connection
{
    public static function make()
    {
        try {
            return new PDO(
                DB_CONNECTION . ':host=' . DB_HOST . ';dbname='.DB_DATABASE,
                DB_USERNAME,
                DB_PASSWORD,
                DB_OPTIONS
            );
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}