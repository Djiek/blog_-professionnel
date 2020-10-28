<?php

namespace blogProfessionnel\app\Controllers;

require_once 'app/Services/Form.php';

use \blogProfessionnel\app\Services\Form;

class MainController
{
    /**
     * home : pour acceder a la page home
     */
    function home()
    {
        require('app/Views/home.php');
    }

    /**
     * downloadCv : pour telecharger le cv
     */
    function downloadCv()
    {
        return 'location:../public/image/cv.pdf';
    }

    /**
     * postContact : permet d'envoyer le mail via le formulaire de contact
     */
    public function postContact()
    {
        if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['message'])) {
            extract($_POST);
            if (!empty($name) && !empty($firstname) && !empty($email) && !empty($message)) {
                $mail = new Form();
                $mail->mail($name, $firstname, $email, $message);
                $_SESSION['flash']['success'] = 'Le mail a bien été envoyé.';
                header('Location: index.php?action=home');
            } else {
                $_SESSION['error'] =  "Vous n'avez pas rempli tout les champs.";
                header('Location: index.php?action=home');
            }
        }
    }
}
