<?php

namespace blogProfessionnel\app\Models;

require_once("Models/Manager.php");

class AccueilManager extends Manager
{
    // public function getUser()
    // {
    //     $db = $this->dbConnect();
    //     $req = $db->query('SELECT id, title,chapo, content,status, DATE_FORMAT(dateLastModification, \'%d/%m/%Y à %Hh%imin%ss\') AS dateLastModification FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

    //     return $req;
    // }

    public function getUser($userId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT  login, password, mail, admin FROM posts WHERE id = ?');
        $req->execute(array($userId));
        $user = $req->fetch();

        return $user;
    }
}
