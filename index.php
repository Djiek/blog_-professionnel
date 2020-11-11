<?php
session_start();
require_once 'vendor/autoload.php'; 


use App\Controllers\UserController;
use App\Controllers\PostController;
use App\Controllers\MainController;
use App\Controllers\AdminController;
use App\Services\Request;

$request = new Request();
$getAction = $request->get('action');
$getId = $request->get('id');
$postLogin = $request->post('login');
$postPassword = $request->post('password');
$postCPassword = $request->post('cPassword');
$postMail = $request->post('mail');
$postContent = $request->post('content');
$postTitle = $request->post('title');
$postChapo = $request->post('chapo');

try {
    if (isset($getAction)) {
        if ($getAction == 'home') {
            $controller = new MainController(new Request());
            $controller->home();
        } elseif ($getAction == 'post') {
            if (isset($getId) && $getId > 0) {
                $controller = new PostController(new Request());
                $controller->post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'listPosts') {
            $controller = new PostController(new Request());
            $controller->listPosts();
        } elseif ($getAction == 'addPostForm') {
            $controller = new AdminController(new Request());
            $controller->addPostForm();
        } elseif ($getAction == 'login') {
            if (!empty($postLogin) && !empty($postPassword)) {
                if (isset($postLogin) && strlen($postPassword) > 0) {
                    if (!empty($postLogin) && !empty($postPassword)) {
                        $controller = new UserController(new Request());
                        $controller->login();
                    } else {
                        $request->setSession('error', "Tous les champs ne sont pas remplis !");
                        header('Location: index.php?action=connection');
                    }
                }
            } else {
                $request->setSession('error', "Tous les champs ne sont pas remplis !");
                header('Location: index.php?action=connection');
            }
        } elseif ($getAction == 'managementCommentPage') {
            $controller = new AdminController(new Request());
            $controller->managementCommentPage();
        } elseif ($getAction == 'ViewPostComment') {
            if (isset($getId) && $getId > 0) {
                $controller = new AdminController(new Request());
                $controller->ViewPostComment();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'deleteComment') {
            $controller = new AdminController(new Request());
            $controller->deleteComment();
        } elseif ($getAction == 'updateStatusComment') {
            $controller = new AdminController(new Request());
            $controller->updateStatusComment();
        } elseif ($getAction == 'postModify') {
            $controller = new AdminController(new Request());
            $controller->postModify();
        } elseif ($getAction == 'modifyBlogPost') {
            $controller = new AdminController(new Request());
            $controller->modifyBlogPost();
        } elseif ($getAction == 'postDelete') {
            $controller = new AdminController(new Request());
            $controller->postDelete();
        } elseif ($getAction == 'connection') {
            $controller = new UserController(new Request());
            $controller->connection();
        } elseif ($getAction == 'logout') {
            $controller = new UserController(new Request());
            $controller->logout();
        } elseif ($getAction == 'inscriptionForm') {
            $controller = new UserController(new Request());
            $controller->inscriptionForm();
        } elseif ($getAction == 'inscription') {
            if (!empty($postLogin) && !empty($postPassword) && !empty($postMail)  && !empty($postCPassword)) {
                $controller = new UserController(new Request());
                $controller->inscription($postLogin,  $postPassword, $postMail);
            } elseif (!isset($_SESSION[$postLogin])) {
                 $request->setSession('error', "Tous les champs ne sont pas remplis !");
                header('Location: index.php?action=inscriptionForm');
            }
        } elseif ($getAction == 'postContact') {
            $controller = new MainController(new Request());
            $controller->postContact();
        } elseif ($getAction == 'addComment') {
            if (isset($getId) && $getId > 0) {
                if (!empty($postContent) && !empty($postTitle)) {
                    $controller = new PostController(new Request());
                    $controller->addComment($getId, $_SESSION['User']['id'], $postContent, $postTitle);
                } else {
                     $request->setSession('error', "Tous les champs ne sont pas remplis !");
                    header('Location: index.php?action=post&id=' . $getId);
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'addBlogPost') {

            if (!empty($postTitle) && !empty($postChapo) && !empty($postContent)) {
                $controller = new AdminController(new Request());
                $controller->addBlogPost(
                    $postTitle,
                    $postChapo,
                    $postContent,
                    $_SESSION['User']['id']
                );
            } else {
                 $request->setSession('error', "Tous les champs ne sont pas remplis !");
                header('Location: index.php?action=addPostForm');
            }
        }
    } else {
        $controller = new MainController(new Request());
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('app/Views/errorView.php');
}
