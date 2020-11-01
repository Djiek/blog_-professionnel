<?php

namespace blogProfessionnel\app\Controllers;

require 'app/Services/Form.php';
require 'app/Services/Request.php';

use \blogProfessionnel\app\Services\Form;
use blogProfessionnel\app\Services\Request;

class MainController
{
    /**
     * pour acceder a la page home
     */
    public function home()
    {
        require('app/Views/home.php');
    }

    /**
     *  pour telecharger le cv
     */
    public function downloadCv()
    {
        return 'location:../public/image/cv.pdf';
    }

    /**
     * permet d'envoyer le mail via le formulaire de contact
     */
    public function postContact()
    {
        $request = new Request();
        $postName = $request->post('name');
        $postFirstName = $request->post('firstname');
        $postMail = $request->post('email');
        $postMail = $request->post('message');
        if (isset($postName) && isset($postFirstName) && isset($postMail) && isset($postMail)) {
            extract($_POST);
            if (!empty($name) && !empty($firstname) && !empty($email) && !empty($message)) {
                $mail = new Form();
                $mail->mail($name, $firstname, $email, $message);
                $_SESSION['success'] = 'Le mail a bien été envoyé.';
                header('Location: index.php?action=home');
            } else {
                $_SESSION['error'] =  "Vous n'avez pas rempli tout les champs.";
                header('Location: index.php?action=home');
            }
        }
    }
}
