<?php

namespace blogProfessionnel\app\Models;

class Manager
{
    protected function dbConnect()
    {
        $dbName = new \PDO('mysql:host=localhost;dbname=blog_professionnel;charset=utf8', 'root', '');
        return $dbName;
    }
}
