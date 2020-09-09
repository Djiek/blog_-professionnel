<?php

namespace blogProfessionnel\app\Controllers;

require_once('app/Services/Form.php');

use \blogProfessionnel\app\Services\Form;



class MainController
{

    function home()
    {
        require('app/Views/home.php');
    }

    function downloadCv()
    {
        return 'location:../public/image/cv.pdf';
    }


    public function postContact()
    {

        if (isset($_POST) && isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['message'])) {
            extract($_POST); //pour simplifier l'ecriture de $_post['*']
            if (empty($name)) {
                $nameError = new Form();
                $nameError->nameError($name);
                die();
            }
            if (!empty($name) && !empty($firstname) && !empty($email) && !empty($message)) {
                $mail = new Form();
                $mail->mail($name, $firstname, $email, $message);
                echo "le mail a bien été envoyé.";
            } else {
                echo "Vous n'avez pas rempli tout les champs.";
            }
        }
    }
}
