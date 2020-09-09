<?php

namespace blogProfessionnel\app\Controllers;
// Chargement des classes
require_once('app/Models/PostManager.php');
require_once('app/Models/UserManager.php');
require_once('app/Models/ConnectionManager.php');
require_once('app/Models/CommentManager.php');
require_once('app/Services/Form.php');

use \blogProfessionnel\app\Models\PostManager;
use \blogProfessionnel\app\Models\ConnectionManager;
use \blogProfessionnel\app\Models\CommentManager;
use blogProfessionnel\app\Models\UserManager;
use \Exception;


class PostController
{

    //addPostForm sans requete, le controler appel une vue
    public function addPostForm()
    {
        require('App/Views/addBlogPost.php');
    }

    function addBlogPost($title, $chapo, $content)
    {
        $postManager = new PostManager(); // Création d'un objet

        $affectedLines = $postManager->addBlogPost($title, $chapo, $content);
        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le blog post !');
        } else {
            header('Location: index.php?action=successAddPost');
        }
    }

    function listPosts()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $postManager = new PostManager(); // Création d'un objet
        $posts = $postManager->getPosts($currentPage); // Appel d'une fonction de cet objet

        $pageOfNumber = $postManager->countPost();
        // $PostPage = $postManager->PostPage();

        require('app/Views/listPostsView.php');
    }

    function connection()
    {
        require('app/Views/connection.php');
    }

    function inscriptionForm()
    {
        require('app/Views/inscription.php');
    }

    function inscription($login, $password, $mail)
    {
        $user = new UserManager;
        $mailVerify = $user->emailVerify($mail);
        $loginVerify = $user->loginVerify($login);
        if ($mailVerify == 0) {
            if ($loginVerify == 0) {
                if ($_POST['password'] === $_POST['cPassword']) {
                    $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
                    if (password_verify($_POST['password'], $hashPassword)) {
                        $addUser = $user->addUser($login, $hashPassword, $mail);
                    } else {
                        echo 'Invalid password.';
                    }
                } else {
                    throw new Exception('Les mots de passe ne sont pas iddentique.');
                }
            } else {
                throw new Exception('le login existe deja');
            }
        } else {
            throw new Exception('l\'email existe deja');
        }
        if ($addUser === false) {
            throw new Exception('erreur lors de l\'inscription !');
        } else {
            header('Location: index.php?action=home');
        }
    }

    function login()
    {
        $connectionManager = new ConnectionManager();
        $user = $connectionManager->getUser($_POST["login"]);
        //  $id = $connectionManager->getId();
        //  $mail = $connectionManager->getMail();
        // $login = $connectionManager->getLogin();
        // Appel d'une fonction de cet objet

        if (isset($_POST["login"]) && isset($_POST["password"])) {
            // Comparaison du pass envoyé via le formulaire avec la base
            $isPasswordCorrect = password_verify($_POST['password'], $user['password']);
            if (!$isPasswordCorrect) {
                echo 'Mauvais identifiant ou mot de passe !';
            } else {
                $users = $connectionManager->connectionUser($_POST["login"], $_POST["password"]);
                echo 'Vous êtes connecté !';
                require('app/Views/home.php');
            }
        } else {
            throw new Exception('Erreur d\'iddentifiants.');
        }
    }

    function post()
    {
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $_GET['page'] = intval($_GET['page']);
            $currentPage = $_GET['page'];
        } else {
            $currentPage = 1;
        }
        $postManager = new PostManager;
        $commentManager = new CommentManager();
        $post = $postManager->getPost($_GET['id']);
        $comments = $commentManager->getComments($_GET['id'], $currentPage);
        $pageOfNumber = $commentManager->countComment($_GET['id'], $currentPage);
        // $CommentPage = $commentManager->commentPage($currentPage);
        require('app/Views/postView.php');
    }

    function success()
    {
        require('app/Views/success.php');
    }

    function successAddPost()
    {
        require('app/Views/successAddPost.php');
    }

    function addComment($postId, $userId, $content, $title)
    {
        $commentManager = new CommentManager();

        $affectedLines = $commentManager->postComment($postId, $userId, $content, $title);

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=success');
        }
    }
}
