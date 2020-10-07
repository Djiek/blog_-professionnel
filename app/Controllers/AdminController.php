<?php

namespace blogProfessionnel\app\Controllers;


require_once('app/Models/PostManager.php');
require_once('app/Models/CommentManager.php');
require_once('app/Models/UserManager.php');

use blogProfessionnel\app\Models\CommentManager;
use \blogProfessionnel\app\Models\PostManager;

class AdminController
{

    // public function isLogged()
    // {
    //      if(isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1){
    //          return true;
    //      }
    // }


    //addPostForm sans requete, le controler appel une vue
    public function addPostForm()
    {
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            require('App/Views/addBlogPost.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }

    function addBlogPost($title, $chapo, $content)
    {
        $postManager = new PostManager(); // Création d'un objet
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            $affectedLines = $postManager->addBlogPost($title, $chapo, $content);
            if ($affectedLines === false) {
                $_SESSION['error'] = "Impossible d\'ajouter le blog post !";
                header('Location: app/Views/addBlogPost.php');
            } else {
                $_SESSION['flash']['success'] = "Le blogPost a été enregistré en base de donnée.";
                header('Location: index.php?action=addPostForm');
            }
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour pouvoir ajouter un post';
            header('Location: index.php?action=connection');
        }
    }

    public function updateStatusComment()
    {
        $postManager = new PostManager;
        $posts = $postManager->getPost($_GET['id']);
        $commentManager = new CommentManager();
        $comments = $commentManager->UpdateStatusComment($_GET['id']);

        $_SESSION['flash']['success'] = 'Le commentaire a été validé';
        //require('app/Views/ViewPost.php');
        header('Location: index.php?action=ViewPostComment');
    }

    public function deleteComment()
    {
        $postManager = new PostManager;
        $posts = $postManager->getPost($_GET['id']);
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->deleteComment($_GET['id']);
        if ($affectedLines === false) {
            $_SESSION['error'] = 'Impossible de supprimer le commentaire';
            header('Location: index.php?action=inscriptionForm');
        } else {
            $_SESSION['flash']['success'] = 'Le commentaire à été suprimé';
            header('Location: index.php?action=success');
        }

        // $comments = $commentManager->deleteComment($_GET['id']);

        // //require('app/Views/ViewPostComment.php');
        // // header('Location: "index.php?action=ViewPostComment&id="'.$_GET['id']);
        //  header('Location: index.php?action=ViewPostComment');
    }

    function ViewPostComment()
    {

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            $postManager = new PostManager;
            $commentManager = new CommentManager();
            $posts = $postManager->getPost($_GET['id']);
            $comments = $commentManager->getCommentsWithoutStatusWithId($_GET['id'], $currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('app/Views/viewPost.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }

    public function managementCommentPage()
    {

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            //$postManager = new PostManager;
            $comment = new CommentManager();
            $commentManager = new CommentManager();
            //   $posts = $postManager->getPost($_GET['id']);
            $comments = $comment->getCommentsWithoutStatus($currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('App/Views/managementCommentPage.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }
}
