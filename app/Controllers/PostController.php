<?php

namespace App\Controllers;

use App\Models\PostManager;
use App\Models\CommentManager;
use App\Services\Request;

class PostController
{

    private $request;

    public function __construct($request)
    {
        $this->request  = $request;
        $this->request = new Request();
    }

    /**
     *  Gere la vue ou s'affiche la lise des posts publié
     */
    public function listPosts()
    {
        $page = $this->request->get("page");
        if (isset($page) && !empty($page)) {
            $currentPage = (int) $page;
        } else {
            $currentPage = 1;
        }
        $postManager = new PostManager();
        $posts = $postManager->getPosts($currentPage);
        $pageOfNumber = $postManager->countPost();

        require('app/Views/listPostsView.php');
    }

    /**
     * pour voir sur la vue d'un post, un post defini par son id
     */
    public function post()
    {
        $page = $this->request->get("page");
        if (isset($page) && !empty($page)) {
            $currentPage = (int) $page;
        } else {
            $currentPage = 1;
        }
        $get = $this->request->get('id');
        $postManager = new PostManager;
        $commentManager = new CommentManager();
        $posts = $postManager->getPost($get);
        $comments = $commentManager->getComments($get, $currentPage);
        $pageOfNumber = $commentManager->countComment($get, $currentPage);
        require('app/Views/postView.php');
    }

    /**
     * gere la partie pour ajouter un commentaire
     */
    public function addComment($postId, $userId, $content, $title)
    {
        $commentManager = new CommentManager();
        $sessionUser = $this->request->session('User');
        $sessionAdmin = $this->request->session('Admin');
        if (isset($sessionUser) || isset($sessionAdmin)) {
            $affectedLines = $commentManager->postComment($postId, $userId, $content, $title);
            if ($affectedLines === false) {
                $this->request->setSession('error', "Impossible d'ajouter le commentaire !");
                header('Location: index.php?action=post&id=' . $postId);
            } else {
                $this->request->setSession('success', "Votre commentaire a été pris en compte et sera traité par un administrateur dans les meilleurs délais.");
                header('Location: index.php?action=post&id=' . $postId);
            }
        } else {
            $this->request->setSession('error', "Vous devez être connecté pour ajouter un commentaire.");
            header('Location: index.php?action=connection');
        }
    }
}
