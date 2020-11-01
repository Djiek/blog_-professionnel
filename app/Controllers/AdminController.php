<?php

namespace blogProfessionnel\app\Controllers;

require_once 'app/Models/PostManager.php';
require_once 'app/Models/CommentManager.php';
require_once 'app/Models/UserManager.php';
require_once 'app/Services/Request.php';

use blogProfessionnel\app\Models\CommentManager;
use \blogProfessionnel\app\Models\PostManager;
use blogProfessionnel\app\Services\Request;

class AdminController
{
    /**
     * supprime un post
     */
    public function postDelete()
    {
        $request = new Request();
        $get = $request->get('id');
        $postManager = new PostManager;
        $affectedLines = $postManager->deletePost($get);
        if ($affectedLines === false) {
            $_SESSION['error'] = "Impossible de supprimer le blog post !";
            header('Location: index.php?action=listPosts');
        }

        $_SESSION['flash']['success'] = "Le blogPost a été supprimé.";
        header('Location: index.php?action=listPosts');
    }

    /**
     * envoie sur la page de modification d'un post
     */
    public function postModify()
    {   $request = new Request();
        $get = $request->get('id');
        $postManager = new PostManager;
        $posts = $postManager->getPost($get);
        require('App/Views/postModify.php');
    }

    /**
     *  modifie un post
     */
    public function modifyBlogPost()
    {
        $request = new Request();
        $getId = $request->get('id');
        $postTitle = $request->post('title');
        $postChapo = $request->post('chapo');
        $postContent = $request->post('content');
        $postManager = new PostManager;
        $affectedLines = $postManager->ModifyPost($getId, $_SESSION['User']['id'], $postTitle, $postChapo, $postContent);
        if ($affectedLines === false) {
            $_SESSION['error'] = "Impossible de modifier le blog post !";
        } else {
            $_SESSION['flash']['success'] = "Le blogPost a été modifié.";
        }
        header('Location: index.php?action=post&id=' . $getId);
    }

    /**
     * envoie sur la page pour ajouter un blogpost
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
     *  ajoute un blop post
     */
    public function addBlogPost($title, $chapo, $content, $userId)
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
     * modifie le status d'un commentaire pour l'ajouter sur la view
     */
    public function updateStatusComment()
    {   $request = new Request();
        $getId = $request->get('id');
        $getPostId = $request->get('postId');
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->UpdateStatusComment($getPostId, $getId);
        if ($affectedLines === false) {
            $_SESSION['error'] = 'Impossible de valider le commentaire';
        } else {
            $_SESSION['flash']['success'] = 'Le commentaire a été validé';
        }
        header('Location: index.php?action=ViewPostComment&id=' . $getPostId);
    }

    /**
     *  supprime un commentaire
     */
    public function deleteComment()
    {
        $request = new Request();
        $getId = $request->get('id');
        $getPostId = $request->get('postId');
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->deleteComment( $getPostId,  $getId);
        if ($affectedLines === false) {
            $_SESSION['error'] = 'Impossible de supprimer le commentaire';
        } else {
            $_SESSION['flash']['success'] = 'Le commentaire a été supprimé';
        }
        header('Location: index.php?action=ViewPostComment&id=' . $getPostId);
    }

    /**
     * page pour voirles commentaires en attente de verification sur le post associé
     */
    public function ViewPostComment()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) $_GET['page'];
        } else {
            $currentPage = 1;
        }
        if (isset($_SESSION['User']) && $_SESSION['User']['admin'] == 1) {
            $request = new Request();
            $getId = $request->get('id');
            $postManager = new PostManager;
            $commentManager = new CommentManager();
            $posts = $postManager->getPost($getId );
            $comments = $commentManager->getCommentsWithoutStatusWithId($getId, $currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('app/Views/viewPost.php');
        } else {
            $_SESSION['error'] = 'Vous devez être administrateur pour acceder à cette page';
            header('Location: index.php?action=connection');
        }
    }

    /**
     *   page pour voir tout les commentaires attente de verification
     */
    public function managementCommentPage()
    {

        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $currentPage = (int) $_GET['page'];
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
