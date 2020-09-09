<?php

namespace blogProfessionnel\app\Models;

require_once("app/Models/Manager.php");

use PDO;

class PostManager extends Manager
{

    public $nbrPerPage = 5;


    public function getNbPerPage()
    {
        return $this->nbrPerPage;
    }


    public function countPost()
    {
        $db = $this->dbConnect();
        $countPost = $db->prepare('SELECT count(id) as nbrPost FROM blogpost WHERE status=1');
        $countPost->setFetchMode(PDO::FETCH_ASSOC);
        $countPost->execute();
        $countPosts = $countPost->fetchAll();

        //pagination
        $nbPerPage = $this->getNbPerPage();
        $pageOfNumber = ceil($countPosts[0]["nbrPost"] / $nbPerPage); //ceil pour arondir au nombre au dessus en cas de division a virgule
        return $pageOfNumber;
    }


    public function PostPage($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $postPage = ($currentPage - 1) * $nbPerPage;
        return $postPage;
    }

    public function getPosts($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $postPage = $this->PostPage($currentPage);
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT id, title,chapo, content,status,user_id, DATE_FORMAT(dateLastModification, '%d/%m/%Y à %Hh%imin%ss')
         AS dateLastModification FROM blogpost WHERE status = 1 ORDER BY dateLastModification DESC LIMIT :postPage ,:nbPerPage");
        $req->bindValue(":postPage", $postPage, PDO::PARAM_INT);
        $req->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
        $req->execute();
        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT blogpost.id, title,chapo, content,status, user_id,user.login,DATE_FORMAT(dateLastModification, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS dateLastModification FROM blogpost INNER JOIN user ON blogpost.user_id = user.id WHERE blogpost.id = ? AND blogpost.status = 1');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post; //retourner un new blogpost 
    }

    public function addBlogPost($chapo, $title, $content)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO blogpost(user_id,status,title,chapo, content,dateLastModification)
             VALUES(1,1,?, ?, ?, NOW())');
        $affectedLines = $post->execute(array($title, $chapo, $content));

        return $affectedLines;
    }
}
