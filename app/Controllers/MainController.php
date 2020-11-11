<?php

namespace App\Controllers;

use App\Services\Form;
use App\Services\Request;

class MainController
{

   private $request;

    public function __construct()
    {
        $this->request  = new Request();
    }

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
        $postName = $this->request->post('name');
        $postFirstName = $this->request->post('firstname');
        $postMail = $this->request->post('email');
        $postMail = $this->request->post('message');
        if (isset($postName) && isset($postFirstName) && isset($postMail) && isset($postMail)) {
            extract($_POST);
            if (!empty($name) && !empty($firstname) && !empty($email) && !empty($message)) {
                $mail = new Form();
                $mail->mail($name, $firstname, $email, $message);
                $this->request->setSession('success', "Le mail a bien été envoyé.");
                header('Location: index.php?action=home');
            } else {
                $this->request->setSession('error', "Vous n'avez pas rempli tout les champs.");
                header('Location: index.php?action=home');
            }
        }
    }
}
