<?php

namespace blogProfessionnel\app\Models;

require_once("app/Models/Manager.php");

use PDO;

class ConnectionManager extends Manager
{

    public function getPassword(){
        $db = $this->dbConnect();
        $password = $db->prepare("SELECT password FROM user ");
        $password->execute();
        return $password;   
    }

       public function getMail(){
        $db = $this->dbConnect();
        $mail = $db->prepare("SELECT mail FROM user ");
        $mail->execute();
        return $mail;   
    }

      public function getid(){
        $db = $this->dbConnect();
        $id = $db->prepare("SELECT id FROM user ");
        $id->execute();
        return $id;   
    }


    public function connectionUser($login, $password)
    {
        $db = $this->dbConnect();
        $user = $db->prepare("SELECT login, password,mail,admin  FROM user WHERE login=:login AND password=:password");
        $user->bindValue(":login", $login, PDO::PARAM_STR);
        $user->bindValue(":password", $password, PDO::PARAM_STR);
        $user->execute();
        return $user;
    }
}
