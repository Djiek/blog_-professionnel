<?php

namespace blogProfessionnel\app\Models;

require_once("app/Models/Manager.php");
require 'app/Models/Entity/BlogPost.php';

use blogProfessionnel\app\Models\Entity\BlogPost;
use blogProfessionnel\app\Models\Entity\User;
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

        $posts = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $post = new BlogPost();
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setDate($row['dateLastModification']);
            $post->setStatus($row['status']);
            $post->setUserId($row['user_id']);
            $post->setChapo($row['chapo']);
            $posts[] = $post;
        }

        // $req->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'posts');
        // $posts = $req->fetchAll();
        //$posts = new BlogPost($req['id'], $req['title'], $req['content'], $req["dateLastModification"], $req['status'], $req['user_id'], $req['chapo']);
        return $posts; //retourner un new blogpost 
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT blogpost.id, title,chapo, content,status, user_id,user.login,DATE_FORMAT(dateLastModification, \'%d/%m/%Y à %Hh%imin%ss\') 
        AS dateLastModification FROM blogpost INNER JOIN user ON blogpost.user_id = user.id WHERE blogpost.id = ? AND blogpost.status = 1');
        $req->execute(array($postId));

        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $post = new BlogPost();
            $login = new User();
            $login->setLogin($row['login']);
            $post->setId($row['id']);
            $post->setTitle($row['title']);
            $post->setContent($row['content']);
            $post->setDate($row['dateLastModification']);
            $post->setStatus($row['status']);
            $post->setUserId($row['login']);
            $post->setChapo($row['chapo']);
            $posts[] = $post;
        }
        return $posts; //retourner un new blogpost 
    }

    public function addBlogPost($user,$title, $chapo,$content)
    {
        $db = $this->dbConnect();
        $post = $db->prepare('INSERT INTO blogpost(user_id,status,title,chapo, content,dateLastModification)
             VALUES(?,1,?, ?, ?, NOW())');
        $affectedLines = $post->execute(array($user,$title, $chapo, $content));

        return $affectedLines;
    }

    public function ModifyPost($blogPostId,$userId,$title,$chapo,$content)
    {
         $db = $this->dbConnect();
        $req = $db->prepare('UPDATE blogpost set title = :title,chapo = :chapo,content = :content,user_id = :userId  WHERE id = :blogPostId');
       $req->bindValue(":userId", $userId, PDO::PARAM_INT);
        $req->bindValue(":title", $title);
         $req->bindValue(":chapo", $chapo);
          $req->bindValue(":content", $content);
       $req->bindValue(":blogPostId", $blogPostId);
        $req->execute();
    }
     public function DeletePost($blogPostId)
    {
         $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM `blogpost`WHERE id = :blogPostId');
       $req->bindValue(":blogPostId", $blogPostId, PDO::PARAM_INT);
        $req->execute();
    }
}
