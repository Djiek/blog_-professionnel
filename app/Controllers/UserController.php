<?php

namespace blogProfessionnel\app\Controllers;

require_once 'app/Models/UserManager.php';
require_once 'app/Services/Request.php';

use blogProfessionnel\app\Models\UserManager;
use blogProfessionnel\app\Services\Request;
use \Exception;

class UserController
{
    /**
     * pour avoir acces a la view connection
     */
    public function connection()
    {
        require('app/Views/connection.php');
    }

    /**
     * permets de deconnecté l'utilisateur connecté
     */
    public function logout()
    {
        unset($_SESSION['User']);
        unset($_SESSION['Admin']);
        $_SESSION['success'] = "vous avez été déconnecté.";
        header('Location: index.php?action=connection');
    }

    /**
     *  pour avoir acces au formulaire d'inscription
     */
    public function inscriptionForm()
    {
        require('app/Views/inscription.php');
    }

    /**
     * inscription des utilisateurs
     */
    public function inscription($login, $password, $mail)
    {
        $user = new UserManager;
        $mailVerify = $user->emailVerify($mail);
        $loginVerify = $user->loginVerify($login);
        $request = new Request();
        $postPassword = $request->post('password');
        $postCPassword = $request->post('cPassword');
        if ($mailVerify == 0) {
            if ($loginVerify == 0) {
                $longueur = strlen($postPassword);
                if ($longueur >= 8) {
                    if ($postPassword === $postCPassword) {
                        $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
                        if (password_verify($_POST['password'], $hashPassword)) {
                            $_SESSION['success'] = 'Enregistrement reussi, veuillez vous connecter pour continuer';
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

    /**
     *  connection de l'utilisateur 
     */
    public function login()
    {
        $request = new Request();
        $postLogin = $request->post('login');
        $postPassword = $request->post('password');
        $userManager = new UserManager();
        $user = $userManager->getUser($postLogin);

        if (isset($postLogin) && isset($postPassword)) {
            $isPasswordCorrect = password_verify($postPassword, $user['password']);
            if (!$isPasswordCorrect) {
                $_SESSION['error'] = 'Mauvais identifiant ou mot de passe';
                header('Location: index.php?action=connection');
            } else {
                $users = $userManager->connectionUser($postLogin, $postPassword);
                $_SESSION['User'] = array(
                    'login' => $postLogin,
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
