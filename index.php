<?php
session_start();
require_once 'app/Controllers/PostController.php';
require_once 'app/Controllers/UserController.php';
require_once 'app/Controllers/AdminController.php';
require_once 'app/Controllers/MainController.php';
require_once 'app/Services/Request.php';

use blogProfessionnel\App\Controllers\UserController;
use blogProfessionnel\App\Controllers\PostController;
use blogProfessionnel\App\Controllers\MainController;
use blogProfessionnel\App\Controllers\AdminController;
use blogProfessionnel\app\Services\Request;

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
            $controller = new MainController();
            $controller->home();
        } elseif ($getAction == 'post') {
            if (isset($getId) && $getId > 0) {
                $controller = new PostController();
                $controller->post();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'listPosts') {
            $controller = new PostController();
            $controller->listPosts();
        } elseif ($getAction == 'addPostForm') {
            $controller = new AdminController();
            $controller->addPostForm();
        } elseif ($getAction == 'login') {
            if (!empty($postLogin) && !empty($postPassword)) {
                if (isset($postLogin) && strlen($postPassword) > 0) {
                    if (!empty($postLogin) && !empty($postPassword)) {
                        $controller = new UserController();
                        $controller->login();
                    } else {
                        $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                        header('Location: index.php?action=connection');
                    }
                }
            } else {
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                header('Location: index.php?action=connection');
            }
        } elseif ($getAction == 'managementCommentPage') {
            $controller = new AdminController();
            $controller->managementCommentPage();
        } elseif ($getAction == 'ViewPostComment') {
            if (isset($getId) && $getId > 0) {
                $controller = new AdminController();
                $controller->ViewPostComment();
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'deleteComment') {
            $controller = new AdminController();
            $controller->deleteComment();
        } elseif ($getAction == 'updateStatusComment') {
            $controller = new AdminController();
            $controller->updateStatusComment();
        } elseif ($getAction == 'postModify') {
            $controller = new AdminController();
            $controller->postModify();
        } elseif ($getAction == 'modifyBlogPost') {
            $controller = new AdminController();
            $controller->modifyBlogPost();
        } elseif ($getAction == 'postDelete') {
            $controller = new AdminController();
            $controller->postDelete();
        } elseif ($getAction == 'connection') {
            $controller = new UserController();
            $controller->connection();
        } elseif ($getAction == 'logout') {
            $controller = new UserController();
            $controller->logout();
        } elseif ($getAction == 'inscriptionForm') {
            $controller = new UserController();
            $controller->inscriptionForm();
        } elseif ($getAction == 'inscription') {
            if (!empty($postLogin) && !empty($postPassword) && !empty($postMail  && !empty($postCPassword))) {
                $controller = new UserController();
                $controller->inscription($postLogin,  $postPassword, $postMail);
            } elseif (!isset($_SESSION[$postLogin])) {
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=inscriptionForm');
            }
        } elseif ($getAction == 'postContact') {
            $controller = new MainController();
            $controller->postContact();
        } elseif ($getAction == 'addComment') {
            if (isset($getId) && $getId > 0) {
                if (!empty($postContent) && !empty($postTilte)) {
                    $controller = new PostController();
                    $controller->addComment($getId, $_SESSION['User']['id'], $postContent, $postTilte);
                } else {
                    $_SESSION['error'] = "Tous les champs ne sont pas remplis !";
                    header('Location: index.php?action=post&id=' . $getId);
                }
            } else {
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($getAction == 'addBlogPost') {

            if (!empty($postTilte) && !empty($postChapo) && !empty($postContent)) {
                $controller = new AdminController();
                $controller->addBlogPost(
                    $postTilte,
                    $postChapo,
                    $postContent,
                    $_SESSION['User']['id']
                );
            } else {
                $_SESSION['error'] = "Tous les champs ne sont pas remplis !!";
                header('Location: index.php?action=addPostForm');
            }
        }
    } else {
        $controller = new MainController();
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('app/Views/errorView.php');
}
