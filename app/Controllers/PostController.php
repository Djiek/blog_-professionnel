<?php

namespace blogProfessionnel\app\Controllers;
// Chargement des classes
require_once('app/Models/PostManager.php');
require_once('app/Models/UserManager.php');
require_once('app/Models/CommentManager.php');
require_once('app/Services/Form.php');

use \blogProfessionnel\app\Models\PostManager;
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
            $_SESSION['error'] = "Impossible d\'ajouter le blog post !";
            require('app/Views/addBlogPost.php');
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

    function logout()
    {
        unset($_SESSION['User']);
        $_SESSION['flash']['success'] = "vous avez été déconnecté.";
        header('Location: index.php?action=connection');
    }

    function inscriptionForm()
    {
        require('app/Views/inscription.php');
    }

    function inscription($login, $password, $mail)
    {
        $_SESSION['error'] = [];
        $user = new UserManager;
        $mailVerify = $user->emailVerify($mail);
        $loginVerify = $user->loginVerify($login);

        if ($mailVerify == 0) {
            if ($loginVerify == 0) {
                $longueur = strlen($_POST['password']);
                // if ($longueur < 8) {
                //     $_SESSION['error'] = "Le mot de passe doit faire au moins 8 caractères";
                //     //require('app/Views/inscription.php');
                //     header('Location: index.php?action=inscriptionForm');
                // }
                if ($_POST['password'] === $_POST['cPassword']) {
                    $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
                    if (password_verify($_POST['password'], $hashPassword)) {
                        $addUser = $user->addUser($login, $hashPassword, $mail);
                    } else {
                        $_SESSION['error'] = 'Invalid password.';
                        header('Location: index.php?action=inscriptionForm');
                    }
                } else {
                    $_SESSION['error'] = "Les mots de passe ne sont pas iddentique.";
                    header('Location: index.php?action=inscriptionForm');
                }
            } else {
                $_SESSION['error'] = "Le login existe deja";
                header('Location: index.php?action=inscriptionForm');
            }
        } else {
            $_SESSION['error'] = "L\'email existe deja";
            header('Location: index.php?action=inscriptionForm');
        }
        if ($addUser === false) {
            throw new Exception('Erreur lors de l\'inscription.');
            header('Location: index.php?action=inscriptionForm');
        } else {
            header('Location: index.php?action=inscriptionForm');
        }
    }

    function login()
    {
        $userManager = new UserManager();
        $user = $userManager->getUser($_POST["login"]);

        if (isset($_POST["login"]) && isset($_POST["password"])) {
            $isPasswordCorrect = password_verify($_POST['password'], $user['password']);
            if (!$isPasswordCorrect) {
                $_SESSION['error'] = 'Mauvais identifiant ou mot de passe';
                header('Location: index.php?action=connection');
            } else {
                $users = $userManager->connectionUser($_POST["login"], $_POST["password"]);
                $_SESSION['User'] = array(
                    'login' => $_POST['login'],
                );
                header('Location: index.php?action=home');
            }
        } else {
            $_SESSION['error'] = 'Erreur d\'iddentifiants';
            header('Location: index.php?action=connection');
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
        $posts = $postManager->getPost($_GET['id']);
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
            $_SESSION['error'] = 'Impossible d\'ajouter le commentaire !';
            header('Location: index.php?action=inscriptionForm');
        } else {
            header('Location: index.php?action=success');
        }
    }
}
