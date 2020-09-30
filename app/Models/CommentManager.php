<?php

namespace blogProfessionnel\app\Models;

require_once("app/Models/Manager.php");
require 'app/Models/Entity/Comment.php';

use blogProfessionnel\app\Models\Entity\Comment;
use blogProfessionnel\app\Models\Entity\User;
use PDO;


class CommentManager extends Manager
{

    public $nbrPerPage = 5;

    public function getNbPerPage()
    {
        return $this->nbrPerPage;
    }


    public function countComment($postId, $currentPage)
    {
        // // $db = $this->dbConnect();
        // // $countComment = $db->prepare('SELECT count(id) as nbrComment FROM comment WHERE status=1');
        // // $countComment->setFetchMode(PDO::FETCH_ASSOC);
        // // $countComment->execute();
        // // $countComments = $countComment->fetchAll();
      
        // $getComment = $this->getComments($postId, $currentPage);
        // $db = $this->dbConnect();
        // $countComment = $db->prepare("SELECT count(comment.id) as nbrComment FROM comment INNER JOIN blogpost ON comment.blogPost_id = blogpost.id WHERE status=1 && blogPost_id = $postId");
        // $countComment->setFetchMode(PDO::FETCH_ASSOC);
        // $countComment->execute(array($postId,$currentPage));
        // $countComments = $countComment->fetchAll();

        // //pagination
        // $nbPerPage = $this->getNbPerPage();
        // $pageOfNumber = ceil($countComments[0]["nbrComment"] / $nbPerPage); //ceil pour arondir au nombre au dessus en cas de division a virgule
        // return $pageOfNumber;

        
        $db = $this->dbConnect();
        $countComment = $db->prepare('SELECT count(id) as nbrComment FROM comment WHERE status=1 && blogPost_id = ?');
        $countComment->setFetchMode(PDO::FETCH_ASSOC);
        $countComment->execute(array($postId));
        $countComments = $countComment->fetchAll();

        //pagination
        $nbPerPage = $this->getNbPerPage();
        $pageOfNumber = ceil($countComments[0]["nbrComment"] / $nbPerPage); //ceil pour arondir au nombre au dessus en cas de division a virgule
        return $pageOfNumber;
    
    }


    public function CommentPage($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = ($currentPage - 1) * $nbPerPage;
        return $commentPage;
    }

    public function getComments($postId, $currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = $this->CommentPage($currentPage);
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT  title, user_id,status, content,user.login, DATE_FORMAT(date, '%d/%m/%Y à %Hh%imin%ss')
        AS date FROM comment INNER JOIN user ON comment.user_id = user.id WHERE blogPost_id = :postId AND status = 1 ORDER BY date DESC LIMIT :commentPage ,:nbPerPage");
        $req->bindValue(":postId", $postId, PDO::PARAM_INT);
        $req->bindValue(":commentPage", $commentPage, PDO::PARAM_INT);
         $req->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
        $req->execute();
        $comments = [];
         while($row = $req->fetch(PDO::FETCH_ASSOC)){
             
                 $login= new User();
                 $login->setLogin($row['login']);
                 $comment = new Comment();
                 $comment->setTitle($row['title']);
                 $comment->setContent($row['content']);
                 $comment->setDate($row['date']);
                 $comment->setStatus($row['status']);
                 $comment->setUserId($row['login']);
                 $comments[] =$comment; 
        }

        //$comment = new Comment($comments['id'],$comments['title'],$comments['content'],$comments['date'],$comments['status'],$comments['login'],$comments['blogPostId']);
        return $comments;
    }

    //    public function getComments($postId, $currentPage)
    // {
    //     $nbPerPage = $this->getNbPerPage();
    //     $commentPage = $this->CommentPage($currentPage);
    //     $db = $this->dbConnect();
    //     $comments = $db->prepare("SELECT  title, user_id,status, content,user.login, DATE_FORMAT(date, '%d/%m/%Y à %Hh%imin%ss')
    //     AS date FROM comment INNER JOIN user ON comment.user_id = user.id WHERE :blogPost_id  AND status = 1 ORDER BY date DESC LIMIT :commentPage ,:nbPerPage");
    //     $comments->bindValue(":blogPost_id", $postId, PDO::PARAM_INT);
    //     $comments->bindValue(":commentPage", $commentPage, PDO::PARAM_INT);
    //     $comments->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
    //     $comments->execute();
    //     return $comments;
    // }


    public function postComment($postId, $userId, $content, $title)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comment(status, blogPost_id, title, user_id, content,date) VALUES(0,?,?,?,?,NOW())');
        $affectedLines = $comments->execute(array($postId, $title, $userId, $content));
        return $affectedLines;
         }

        public function updateStatus($postId, $userId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE INTO comment(status) VALUES(1,NOW())');
        $affectedLines = $comments->execute($postId,$userId);
        return $affectedLines;
    }
}
