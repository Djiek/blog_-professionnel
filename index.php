<?php
session_start();
require('app/Controllers/PostController.php');
require('app/Controllers/MainController.php');

use blogProfessionnel\App\Controllers\PostController;
use blogProfessionnel\App\Controllers\MainController;

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'home') {
            $controller = new MainController();
            $controller->home();
        } elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $controller = new PostController();
                $controller->post();
            } else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'listPosts') {
            $controller = new PostController();
            $controller->listPosts();
        } elseif ($_GET['action'] == 'success') {
            $controller = new PostController();
            $controller->success();
        } elseif ($_GET['action'] == 'successAddPost') {
            $controller = new PostController();
            $controller->successAddPost();
        } elseif ($_GET['action'] == 'addPostForm') {
            $controller = new PostController();
            $controller->addPostForm();
        } elseif ($_GET['action'] == 'login') {
             if (!empty($_POST['login']) && !empty($_POST['password']) ){
            if (isset($_POST['login']) && $_POST['password'] > 0) {
                $_SESSION['User'] = array(
                    'login' => $_POST['login'],
                );

                if (!empty($_POST['login']) && !empty($_POST['password'])) {
                    $controller = new PostController();
                    $controller->login();
                } else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
             }
        } elseif ($_GET['action'] == 'connection') {
            $controller = new PostController();
            $controller->connection();

        } elseif ($_GET['action'] == 'inscriptionForm') {
            $controller = new PostController();
            $controller->inscriptionForm();

        } elseif ($_GET['action'] == 'inscription') {
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['mail']  && !empty($_POST['cPassword']))) {
                    $controller = new PostController();
                    $controller->inscription($_POST['login'],  $_POST['password'], $_POST['mail']); //$hashPassword
            } else {
                // Autre exception
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
        } elseif ($_GET['action'] == 'postContact') {
            $controller = new MainController();
            $controller->postContact();
        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['content']) && !empty($_POST['title'])) {
                    $controller = new PostController();
                    $controller->addComment($_GET['id'], 1, $_POST['content'], $_POST['title']);
                } else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                // Autre exception
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        } elseif ($_GET['action'] == 'addBlogPost') {
            //  if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['content']) && !empty($_POST['title']) && !empty($_POST['chapo'])) {
                $controller = new PostController();
                $controller->addBlogPost(
                    /**$_GET['id'],**/
                    $_POST['content'],
                    $_POST['title'],
                    $_POST['chapo']
                );
            } else {
                // Autre exception
                throw new Exception('Tous les champs ne sont pas remplis !');
            }
            // }
            // else {
            //     // Autre exception
            //     throw new Exception('Aucun identifiant de billet envoyé');
            // }
        }
    } else {
        $controller = new MainController();
        $controller->home();
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require('app/Views/errorView.php');
}
