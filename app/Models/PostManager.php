<?php

namespace blogProfessionnel\app\Models;

require_once "app/Models/Manager.php";
require_once 'app/Models/Entity/BlogPost.php';

use blogProfessionnel\app\Models\Entity\BlogPost;
use blogProfessionnel\app\Models\Entity\User;
use PDO;

class PostManager extends Manager
{
    public $nbrPerPage = 5;

    /**
     *  va chercher le nombre de page dans la variable declaré 
     */
    public function getNbPerPage()
    {
        return $this->nbrPerPage;
    }

    /**
     *  compte les posts en status 1 pour pouvoir ensuite les afficher sur la vue
     */
    public function countPost()
    {
        $dbName = $this->dbConnect();
        $countPost = $dbName->prepare('SELECT count(id) as nbrPost FROM blogpost WHERE status=1');
        $countPost->setFetchMode(PDO::FETCH_ASSOC);
        $countPost->execute();
        $countPosts = $countPost->fetchAll();

        $nbPerPage = $this->getNbPerPage();
        $pageOfNumber = ceil($countPosts[0]["nbrPost"] / $nbPerPage);
        return $pageOfNumber;
    }

    /**
     * combien de post sur une vue
     */
    public function PostPage($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $postPage = ($currentPage - 1) * $nbPerPage;
        return $postPage;
    }

    /**
     *  va checher les posts en status 1 en leur mettant la limite de pagination pour les afficher sur la vue
     */
    public function getPosts($currentPage)
    {
        $nbPerPage = $this->getNbPerPage();
        $postPage = $this->PostPage($currentPage);
        $dbName = $this->dbConnect();
        $req = $dbName->prepare("SELECT id, title,chapo, content,status,user_id, DATE_FORMAT(dateLastModification, '%d/%m/%Y à %Hh%imin%ss')
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
        return $posts;
    }

    /**
     * va chercher un post pour l'afficher sur la vue
     */
    public function getPost($postId)
    {
        $dbName = $this->dbConnect();
        $req = $dbName->prepare('SELECT blogpost.id, title,chapo, content,status, user_id,user.login,DATE_FORMAT(dateLastModification, \'%d/%m/%Y à %Hh%imin%ss\') 
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
        return $posts;
    }

    /**
     *  ajoute un post en bdd 
     */
    public function addBlogPost($title, $chapo, $content, $user)
    {
        $dbName = $this->dbConnect();
        $post = $dbName->prepare('INSERT INTO blogpost(title,chapo, content,user_id,status,dateLastModification)
             VALUES(?,?, ?, ?,1, NOW())');
        $affectedLines = $post->execute(array($title, $chapo, $content, $user));

        return $affectedLines;
    }

    /**
     * Modifie un post et l'envois en update en bdd
     */
    public function ModifyPost($blogPostId, $userId, $title, $chapo, $content)
    {
        $dbName = $this->dbConnect();
        $req = $dbName->prepare('UPDATE blogpost set title = :title,chapo = :chapo,content = :content,user_id = :userId, dateLastModification = NOW() WHERE id = :blogPostId');
        $req->bindValue(":userId", $userId, PDO::PARAM_INT);
        $req->bindValue(":title", $title);
        $req->bindValue(":chapo", $chapo);
        $req->bindValue(":content", $content);
        $req->bindValue(":blogPostId", $blogPostId);
        $req->execute();
    }

    /**
     * supprime un post en bdd
     */
    public function DeletePost($blogPostId)
    {
        $dbName = $this->dbConnect();
        $req = $dbName->prepare('DELETE FROM `blogpost`WHERE id = :blogPostId');
        $req->bindValue(":blogPostId", $blogPostId, PDO::PARAM_INT);
        $req->execute();
    }
}
