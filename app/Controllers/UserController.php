<?php

namespace blogProfessionnel\app\Controllers;

require_once('app/Models/UserManager.php');

use blogProfessionnel\app\Models\UserManager;
use \Exception;

class UserController
{
    function connection()
    {
        require('app/Views/connection.php');
    }

    function logout()
    {
        unset($_SESSION['User']);
        unset($_SESSION['Admin']);
        $_SESSION['flash']['success'] = "vous avez été déconnecté.";
        header('Location: index.php?action=connection');
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
                $longueur = strlen($_POST['password']);
                if ($longueur >= 8) {
                    if ($_POST['password'] === $_POST['cPassword']) {
                        $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
                        if (password_verify($_POST['password'], $hashPassword)) {
                            $_SESSION['flash']['success'] = 'Enregistrement reussi, veuillez vous connecter pour continuer';
                            header('Location: index.php?action=connection');
                            $addUser = $user->addUser($login, $hashPassword, $mail);
                        }
                    } else {
                        $_SESSION['error'] = "Les mots de passe ne sont pas iddentique.";
                        header('Location: index.php?action=inscriptionForm');
                    }
                } else {
                    $_SESSION['error'] = "Le mot de passe doit faire au moins 8 caractères";
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
                    'admin' => $user['admin'],
                    'id' => $user['id'],
                );
                header('Location: index.php?action=home');
            }
        } else {
            $_SESSION['error'] = 'Erreur d\'iddentifiants';
            header('Location: index.php?action=connection');
        }
    }
}
