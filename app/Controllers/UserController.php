<?php

namespace App\Controllers;

use App\Models\UserManager;
use App\Services\Request;
use \Exception;

class UserController
{

    private $request;

    public function __construct($request)
    {
        $this->request  = $request;
        $this->request = new Request();
    }

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
        $this->request->setSession('success', "vous avez été déconnecté.");
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
        $postPassword = $this->request->post('password');
        $postCPassword = $this->request->post('cPassword');
        if ($mailVerify == 0) {
            if ($loginVerify == 0) {
                $longueur = strlen($postPassword);
                if ($longueur >= 8) {
                    if ($postPassword === $postCPassword) {
                        $hashPassword =  password_hash($password, PASSWORD_BCRYPT);
                        if (password_verify($postPassword, $hashPassword)) {
                            $this->request->setSession('success', "Enregistrement reussi, veuillez vous connecter pour continuer");
                            header('Location: index.php?action=connection');
                            $addUser = $user->addUser($login, $hashPassword, $mail);
                        }
                    } else {
                        $this->request->setSession('error', "Les mots de passe ne sont pas iddentique.");
                        header('Location: index.php?action=inscriptionForm');
                    }
                } else {
                    $this->request->setSession('error', "Le mot de passe doit faire au moins 8 caractères");
                    header('Location: index.php?action=inscriptionForm');
                }
            } else {
                $this->request->setSession('error', "Le login existe deja");
                header('Location: index.php?action=inscriptionForm');
            }
        } else {
            $this->request->setSession('error', "L'email existe deja");
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
        $postLogin = $this->request->post('login');
        $postPassword = $this->request->post('password');
        $userManager = new UserManager();
        $user = $userManager->getUser($postLogin);

        if (isset($postLogin) && isset($postPassword)) {
            $isPasswordCorrect = password_verify($postPassword, $user['password']);
            if (!$isPasswordCorrect) {
                $this->request->setSession('error', "Mauvais identifiant ou mot de passe");
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
            $this->request->setSession('error', "Erreur d'iddentifiants");
            header('Location: index.php?action=connection');
        }
    }
}
