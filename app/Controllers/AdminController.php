<?php

namespace blogProfessionnel\app\Controllers;

require_once 'app/Models/PostManager.php';
require_once 'app/Models/CommentManager.php';
require_once 'app/Models/UserManager.php';

use blogProfessionnel\app\Models\CommentManager;
use \blogProfessionnel\app\Models\PostManager;

class AdminController
{
    /**
     * postDelete : supprime un post
     */
    public function postDelete()
    {
        $postManager = new PostManager;
        $affectedLines = $postManager->deletePost($_GET['id']);
        if ($affectedLines === false) {
            $_SESSION['error'] = "Impossible de supprimer le blog post !";
            header('Location: index.php?action=listPosts');
        }

        $_SESSION['flash']['success'] = "Le blogPost a été supprimé.";
        header('Location: index.php?action=listPosts');
    }

    /**
     * postModify : envoie sur la page de modification d'un post
     */
    public function postModify()
    {
        $postManager = new PostManager;
        $posts = $postManager->getPost($_GET['id']);
        require('App/Views/postModify.php');
    }

    /**
     * modifyBlogPost : modifie un post
     */
    public function modifyBlogPost()
    {
        $postManager = new PostManager;
        $affectedLines = $postManager->ModifyPost($_GET['id'], $_SESSION['User']['id'], $_POST['title'], $_POST['chapo'], $_POST['content']);
        if ($affectedLines === false) {
            $_SESSION['error'] = "Impossible de modifier le blog post !";
        } else {
            $_SESSION['flash']['success'] = "Le blogPost a été modifié.";
        }
        header('Location: index.php?action=post&id=' . $_GET['id']);
    }

    /**
     * addPostForm : envoie sur la page pour ajouter un blogpost
     */
    public function addPostForm()
    {
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            require('App/Views/addBlogPost.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }

    /**
     * addBlogPost : ajoute un blop post
     */
    function addBlogPost($title, $chapo, $content, $userId)
    {
        $postManager = new PostManager(); // Création d'un objet
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            $affectedLines = $postManager->addBlogPost($title, $chapo, $content, $userId);
            if ($affectedLines === false) {
                $_SESSION['error'] = "Impossible d'ajouter le blog post !";
                header('Location: index.php?action=addPostForm');
            } else {
                $_SESSION['flash']['success'] = "Le blogPost a été enregistré en base de donnée.";
                header('Location: index.php?action=addPostForm');
            }
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour pouvoir ajouter un post';
            header('Location: index.php?action=connection');
        }
    }

    /**
     * updateStatusComment : modifie le status d'un commentaire pour l'ajouter sur la view
     */
    public function updateStatusComment()
    {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->UpdateStatusComment($_GET['postId'], $_GET['id']);
        if ($affectedLines === false) {
            $_SESSION['error'] = 'Impossible de valider le commentaire';
        } else {
            $_SESSION['flash']['success'] = 'Le commentaire a été validé';
        }
        header('Location: index.php?action=ViewPostComment&id=' . $_GET['postId']);
    }

    /**
     * deleteComment : supprime un commentaire
     */
    public function deleteComment()
    {
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->deleteComment($_GET['postId'], $_GET['id']);
        if ($affectedLines === false) {
            $_SESSION['error'] = 'Impossible de supprimer le commentaire';
        } else {
            $_SESSION['flash']['success'] = 'Le commentaire a été supprimé';
        }
        header('Location: index.php?action=ViewPostComment&id=' . $_GET['postId']);
    }

    /**
     * ViewPostComment : page pour voirles commentaires en attente de verification sur le post associé
     */
    function ViewPostComment()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = (int) $_GET['page'];
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

    /**
     * managementCommentPage :  page pour voir tout les commentaires attente de verification
     */
    public function managementCommentPage()
    {

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = (int) $_GET['page'];
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            $comment = new CommentManager();
            $commentManager = new CommentManager();
            $comments = $comment->getCommentsWithoutStatus($currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('App/Views/managementCommentPage.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }
}
