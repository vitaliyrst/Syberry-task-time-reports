<?php

namespace App\Classes;

use PDO;

class Db
{
    public PDO $dbh;

    public function __construct()
    {
        $config = require __DIR__ . '/../config.php';
        try {
            $this->dbh = new PDO($config['db']['driver'] . ':host=' . $config['db']['host'] .
                ';dbname=' . $config['db']['dbname'], $config['db']['user'], $config['db']['password']);
        } catch (\PDOException $exception) {
            echo 'Error! ' . $exception->getMessage();
            die();
        }
    }
}