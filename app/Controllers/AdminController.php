<?php

namespace App\Controllers;

use App\Models\CommentManager;
use App\Models\PostManager;
use App\Services\Request;

class AdminController
{

    private $request;

    public function __construct()
    {
        $this->request  = new Request();
    }

    /**
     * supprime un post
     */
    public function postDelete()
    {
        $get = $this->request->get('id');
        $postManager = new PostManager;
        $affectedLines = $postManager->deletePost($get);
        if ($affectedLines === false) {
            $this->request->setSession('error', "Impossible de supprimer le blog post !");
            header('Location: index.php?action=listPosts');
        }
        $this->request->setSession('success', "Le blogPost a été supprimé.");
        header('Location: index.php?action=listPosts');
    }

    /**
     * envoie sur la page de modification d'un post
     */
    public function postModify()
    {
        $get = $this->request->get('id');
        $postManager = new PostManager;
        $posts = $postManager->getPost($get);
        require('App/Views/postModify.php');
    }

    /**
     *  modifie un post
     */
    public function modifyBlogPost()
    {
        $getId = $this->request->get('id');
        $postTitle = $this->request->post('title');
        $postChapo = $this->request->post('chapo');
        $postContent = $this->request->post('content');
        $postManager = new PostManager;
        $affectedLines = $postManager->ModifyPost($getId, $_SESSION['User']['id'], $postTitle, $postChapo, $postContent);
        if ($affectedLines === false) {
            $this->request->setSession('error', "Impossible de modifier le blog post !");
        } else {
            $this->request->setSession('success', "Le blogPost a été modifié.");
        }
        header('Location: index.php?action=post&id=' . $getId);
    }

    /**
     * envoie sur la page pour ajouter un blogpost
     */
    public function addPostForm()
    {
        $user = $this->request->session("User");
        if (isset($user) && $_SESSION['User']['admin'] == 1) {
            require('App/Views/addBlogPost.php');
        } else {
            $this->request->setSession('error', "Vous devez être administrateur pour acceder à cette page");
            header('Location: index.php?action=connection');
        }
    }

    /**
     *  ajoute un blop post
     */
    public function addBlogPost($title, $chapo, $content, $userId)
    {
        $user = $this->request->session("User");
        $postManager = new PostManager(); // Création d'un objet
        if (isset($user) && $_SESSION['User']['admin'] == 1) {
            $affectedLines = $postManager->addBlogPost($title, $chapo, $content, $userId);
            if ($affectedLines === false) {
                $this->request->setSession('error', "Impossible d'ajouter le blog post !");
                header('Location: index.php?action=addPostForm');
            } else {
                $this->request->setSession('success', "Le blogPost a été enregistré en base de donnée.");
                header('Location: index.php?action=addPostForm');
            }
        } else {
            $this->request->setSession('error', "Vous devez être administrateur pour pouvoir ajouter un post");
            header('Location: index.php?action=connection');
        }
    }

    /**
     * modifie le status d'un commentaire pour l'ajouter sur la view
     */
    public function updateStatusComment()
    {
        $getId = $this->request->get('id');
        $getPostId = $this->request->get('postId');
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->UpdateStatusComment($getPostId, $getId);
        if ($affectedLines === false) {
            $this->request->setSession('error', "Impossible de valider le commentaire");
        } else {
            $this->request->setSession('success', "Le commentaire a été validé");
        }
        header('Location: index.php?action=ViewPostComment&id=' . $getPostId);
    }

    /**
     *  supprime un commentaire
     */
    public function deleteComment()
    {
        $getId = $this->request->get('id');
        $getPostId = $this->request->get('postId');
        $commentManager = new CommentManager();
        $affectedLines = $commentManager->deleteComment($getPostId,  $getId);
        if ($affectedLines === false) {
            $this->request->setSession('error', "Impossible de supprimer le commentaire !");
        } else {
            $this->request->setSession('success', "Le commentaire a été supprimé");
        }
        header('Location: index.php?action=ViewPostComment&id=' . $getPostId);
    }

    /**
     * page pour voir les commentaires en attente de verification sur le post associé
     */
    public function ViewPostComment()
    {
        $page = $this->request->get("page");
        $user = $this->request->session("User");
        if (isset($page) && !empty($page)) {
            $currentPage = (int) $page;
        } else {
            $currentPage = 1;
        }
        if (isset($user) && $_SESSION['User']['admin'] == 1) {
            $getPostId = $this->request->get('postId');
            $getId = $this->request->get('id');
            if (empty($getPostId)) {
                $commentManager = new CommentManager();
                $commentManager->deleteComment($getPostId,  $getId);
            }
            $postManager = new PostManager;
            $commentManager = new CommentManager();
            $posts = $postManager->getPost($getId);
            $comments = $commentManager->getCommentsWithoutStatusWithId($getId, $currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('app/Views/viewPost.php');
        } else {
            $request->setSession('error', "Vous devez être administrateur pour acceder à cette page");
            header('Location: index.php?action=connection');
        }
    }

    /**
     *   page pour voir tout les commentaires attente de verification
     */
    public function managementCommentPage()
    {
        $user = $this->request->session("User");
        $page = $this->request->get("page");
        if (isset($page) && !empty($page)) {
            $currentPage = (int) $page;
        } else {
            $currentPage = 1;
        }
        if (isset($user) && $_SESSION['User']['admin'] == 1) {
            $comment = new CommentManager();
            $commentManager = new CommentManager();
            $comments = $comment->getCommentsWithoutStatus($currentPage);
            $pageOfNumber = $commentManager->countCommentWithoutId();
            require('App/Views/managementCommentPage.php');
        } else {
            $this->request->setSession('error', "Vous devez être administrateur pour acceder à cette page");
            header('Location: index.php?action=connection');
        }
    }
}
