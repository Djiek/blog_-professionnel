<?php

namespace App\Models;

class Manager
{
    /**
     * fais une connection avec la base de donnée
     */
    protected function dbConnect()
    {
       $dbName = new \PDO('mysql:host=localhost;dbname=blog_professionnel;charset=utf8', 'root', '');
        return $dbName;
    }
}