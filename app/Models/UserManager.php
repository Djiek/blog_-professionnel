<?php

namespace blogProfessionnel\app\Models;

require_once("app/Models/Manager.php");

use PDO;

class UserManager extends Manager
{
    public function getUser($userId)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('SELECT * FROM user');
        $user->execute(array($userId));
        //  if($mail == $user['mail'] && $login == $user['login']  && $password == $user['password'] ){
        //     $_SESSION["login"] = $user['login'] ;
        //     $_SESSION["mail"] = $user['mail'];
        // }
        return $user;
    }

    public function addUser($login, $password, $mail)
    {
        $db = $this->dbConnect();
        $user = $db->prepare('INSERT INTO user(login,password,mail,admin) VALUES(?,?,?,0)');
        $affectedLines = $user->execute(array($login, $password, $mail));
        return $affectedLines;
    }

    public function emailVerify($mail)
    {
        $db = $this->dbConnect();
        $user = $db->prepare("SELECT mail FROM user WHERE mail = :mail");
        $user->bindValue(":mail", $mail, PDO::PARAM_STR);
        $user->execute();
        $result = $user->rowCount();
        return $result;
    }

        public function loginVerify($login)
    {
        $db = $this->dbConnect();
        $user = $db->prepare("SELECT login FROM user WHERE login = :login");
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->execute();
        $result = $user->rowCount();
        return $result;
    }
}
