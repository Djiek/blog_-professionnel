<?php

namespace blogProfessionnel\app\Models;

require_once "app/Models/Manager.php";
require_once 'app/Models/Entity/User.php';

use blogProfessionnel\app\Models\Entity\User;
use PDO;

class UserManager extends Manager
{

    public function connectionUser($login, $password)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare("SELECT login, password,mail,admin  FROM user WHERE login=:login AND password=:password");
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->bindValue(":password", $password, PDO::PARAM_STR);
        $user->execute();
        return $user;
    }

    public function getUser($login)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare('SELECT * FROM user WHERE login=:login');
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->execute();
        return $user->fetch();
        $users = new User($user['id'], $user['mail'], $user['login'], $user["password"], $user["admin"]);
        return $users;
    }

    public function addUser($login, $password, $mail)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare('INSERT INTO user(login,password,mail,admin) VALUES(?,?,?,0)');
        $affectedLines = $user->execute(array($login, $password, $mail));
        return $affectedLines;
    }

    public function emailVerify($mail)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare("SELECT mail FROM user WHERE mail = :mail");
        $user->bindValue(":mail", $mail, PDO::PARAM_STR);
        $user->execute();
        $result = $user->rowCount();
        return $result;
    }

    public function loginVerify($login)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare("SELECT login FROM user WHERE login = :login");
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->execute();
        $result = $user->rowCount();
        return $result;
    }
}
