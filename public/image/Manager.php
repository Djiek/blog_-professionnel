<?php

namespace App\Models;

class Manager
{
    /**
     * fais une connection avec la base de donnée
     */
    protected function dbConnect()
    {
        $dbName = new \PDO('mysql:host=djiekovhoddjiek.mysql.db;dbname=djiekovhoddjiek;charset=utf8', 'djiekovhoddjiek', 'Azerty1234');
        return $dbName;
    }
}
