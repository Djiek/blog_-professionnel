<?php

namespace blogProfessionnel\app\Models;

require_once "app/Models/Manager.php";
require_once 'app/Models/Entity/Comment.php';

use blogProfessionnel\app\Models\Entity\Comment;
use blogProfessionnel\app\Models\Entity\User;
use PDO;

class CommentManager extends Manager
{
    public $nbrPerPage = 5;

    /**
     * getNbPerPage : recupere le nombre de page.
     */
    public function getNbPerPage()
    {
        return $this->nbrPerPage;
    }

    /**
     *  countComment : Permets de Compter les commentaires
     */
    public function countComment($postId)
    {
        $dbConnect = $this->dbConnect();
        $countComment = $dbConnect->prepare('SELECT count(id) as nbrComment FROM comment WHERE status=1 && blogPost_id = ?');
        $countComment->setFetchMode(PDO::FETCH_ASSOC);
        $countComment->execute(array($postId));
        $countComments = $countComment->fetchAll();


        $nbPerPage = $this->getNbPerPage();
        $pageOfNumber = ceil($countComments[0]["nbrComment"] / $nbPerPage);
        return $pageOfNumber;
    }

    /**
     *  countCommentWithoutId : Permets de compter les commentaires avec un status 0
     */
    public function countCommentWithoutId()
    {
        $dbConnect = $this->dbConnect();
        $countComment = $dbConnect->prepare('SELECT count(id) as nbrComment FROM comment WHERE status= 0 ');
        $countComment->setFetchMode(PDO::FETCH_ASSOC);
        $countComment->execute();
        $countComments = $countComment->fetchAll();

        $nbPerPage = $this->getNbPerPage();
        $pageOfNumber = ceil($countComments[0]["nbrComment"] / $nbPerPage);
        return $pageOfNumber;
    }

    /**
     * deleteComment : Permets de supprimer un commentaire en bdd
     */
    public function deleteComment($postId, $commentId)
    {
        $dbConnect = $this->dbConnect();
        $req = $dbConnect->prepare('DELETE FROM comment WHERE blogPost_id = :postId AND id = :commentId ');
        $req->bindValue(":postId", $postId, PDO::PARAM_INT);
        $req->bindValue(":commentId", $commentId, PDO::PARAM_INT);
        $req->execute();
    }

    /**
     * CommentPage : Compte le nombre de page pour ensuite faire la pagination
     */
    public function CommentPage($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = ($currentPage - 1) * $nbPerPage;
        return $commentPage;
    }

    /**
     * UpdateStatusComment : mets à jour le status d'un commentaire (sur 1 pour l'afficher)
     */
    public function UpdateStatusComment($postId, $commentId)
    {
        $dbConnect = $this->dbConnect();
        $req = $dbConnect->prepare('UPDATE comment set status=1  WHERE blogPost_id = :postId && id = :commentId ');
        $req->bindValue(":postId", $postId, PDO::PARAM_INT);
        $req->bindValue(":commentId", $commentId, PDO::PARAM_INT);
        $req->execute();
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setId($row['id']);
            $comments[] = $comment;
        }
        return $comments;
    }

    /**
     * getComments : Permets d'afficher les commentaires qui ont un status 1 sur la vue
     */
    public function getComments($postId, $currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = $this->CommentPage($currentPage);
        $dbConnect = $this->dbConnect();
        $req = $dbConnect->prepare("SELECT  title, user_id,status, content,user.login, DATE_FORMAT(date, '%d/%m/%Y à %Hh%imin%ss')
        AS date FROM comment INNER JOIN user ON comment.user_id = user.id WHERE blogPost_id = :postId AND status = 1 ORDER BY date DESC LIMIT :commentPage ,:nbPerPage");
        $req->bindValue(":postId", $postId, PDO::PARAM_INT);
        $req->bindValue(":commentPage", $commentPage, PDO::PARAM_INT);
        $req->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
        $req->execute();
        $comments = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {

            $login = new User();
            $login->setLogin($row['login']);
            $comment = new Comment();
            $comment->setTitle($row['title']);

            $comment->setContent($row['content']);
            $comment->setDate($row['date']);
            $comment->setStatus($row['status']);
            $comment->setUserId($row['login']);
            $comments[] = $comment;
        }
        return $comments;
    }

    /**
     * getCommentsWithoutStatus : va chercher les commentaires en status 0 pour les afficher sur la vue
     */
    public function getCommentsWithoutStatus($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = $this->CommentPage($currentPage);
        $dbConnect = $this->dbConnect();
        $req = $dbConnect->prepare("SELECT * FROM comment INNER JOIN user ON comment.user_id = user.id WHERE status = 0 ORDER BY date DESC LIMIT :commentPage ,:nbPerPage ");
        $req->bindValue(":commentPage", $commentPage, PDO::PARAM_INT);
        $req->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
        $req->execute();
        $comments = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $login = new User();
            $login->setLogin($row['login']);
            $comment = new Comment();
            $comment->setId($row['id']);
            $comment->setTitle($row['title']);
            $comment->setContent($row['content']);
            $comment->setDate($row['date']);
            $comment->setStatus($row['status']);
            $comment->setUserId($row['login']);
            $comment->setBlogPostId($row['blogPost_id']);
            $comments[] = $comment;
        }
        return $comments;
    }

    /**
     * getCommentsWithoutStatusWithId : va chercher les commentaires en status 0 pour les afficher sur la vue et avec l'userId
     */
    public function getCommentsWithoutStatusWithId($postId, $currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $commentPage = $this->CommentPage($currentPage);
        $dbConnect = $this->dbConnect();
        $req = $dbConnect->prepare("SELECT comment.id,title,content,date,status,blogPost_id,user.login FROM comment INNER JOIN user ON comment.user_id = user.id WHERE blogPost_id = :postId AND status = 0 ORDER BY date DESC LIMIT :commentPage ,:nbPerPage ");
        $req->bindValue(":postId", $postId, PDO::PARAM_INT);
        $req->bindValue(":commentPage", $commentPage, PDO::PARAM_INT);
        $req->bindValue(":nbPerPage", $nbPerPage, PDO::PARAM_INT);
        $req->execute();
        $comments = [];
        while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
            $login = new User();
            $login->setLogin($row['login']);
            $comment = new Comment();
            $comment->setTitle($row['title']);
            $comment->setId($row['id']);
            $comment->setContent($row['content']);
            $comment->setDate($row['date']);
            $comment->setStatus($row['status']);
            $comment->setUserId($row['login']);
            $comment->setBlogPostId($row['blogPost_id']);
            $comments[] = $comment;
        }
        return $comments;
    }

    /**
     * postComment : Insert en bdd le commentaire 
     */
    public function postComment($postId, $userId, $content, $title)
    {
        $dbConnect = $this->dbConnect();
        $comments = $dbConnect->prepare('INSERT INTO comment(status, blogPost_id,user_id, content,title,date) VALUES(0,?,?,?,?,NOW())');
        $affectedLines = $comments->execute(array($postId, $userId, $content, $title));
        return $affectedLines;
    }

    /**
     * updateStatus : mets à jour le status du commentaire
     */
    public function updateStatus($postId, $userId)
    {
        $dbConnect = $this->dbConnect();
        $comments = $dbConnect->prepare('UPDATE INTO comment(status) VALUES(1,NOW())');
        $affectedLines = $comments->execute($postId, $userId);
        return $affectedLines;
    }
}
