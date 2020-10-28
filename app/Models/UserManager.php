<?php

namespace blogProfessionnel\app\Models;

require_once "app/Models/Manager.php";
require_once 'app/Models/Entity/User.php';

use blogProfessionnel\app\Models\Entity\User;
use PDO;

class UserManager extends Manager
{

    /**
     * connectionUser : recupere le login et le passeword et verifie qu'ils existent en bdd, si oui connection
     */
    public function connectionUser($login, $password)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare("SELECT login, password,mail,admin  FROM user WHERE login=:login AND password=:password");
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->bindValue(":password", $password, PDO::PARAM_STR);
        $user->execute();
        return $user;
    }

    /**
     * getUser : recupere le login de l'utilisateur connecté
     */
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

    /**
     * addUser : ajoute un utilisateur en bdd
     */
    public function addUser($login, $password, $mail)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare('INSERT INTO user(login,password,mail,admin) VALUES(?,?,?,0)');
        $affectedLines = $user->execute(array($login, $password, $mail));
        return $affectedLines;
    }

    /**
     * emailVerify : verifie si l'email n'existe pas deja en bdd quand un utilisateur d'inscrit
     */
    public function emailVerify($mail)
    {
        $dbName = $this->dbConnect();
        $user = $dbName->prepare("SELECT mail FROM user WHERE mail = :mail");
        $user->bindValue(":mail", $mail, PDO::PARAM_STR);
        $user->execute();
        $result = $user->rowCount();
        return $result;
    }

    /**
     * loginVerify : verifie si le login n'existe pas deja en bdd quand un utilisateur d'inscrit
     */
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
