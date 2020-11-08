<?php

namespace App\Services;

class Form
{
    /**
     *  envois un mail apres que l'utilisateur ai rempli le formulaire sur la page home
     */
    public function mail($name, $firstname, $email, $message)
    {
        $message = str_replace("\'", "'", $message);
        $destinataire = "marine.richini@gmail.com";
        $subject = "Formulaire de contact";
        $message = "Nouveau message. /n
        Nom : $name /n
        Prénom : $firstname :n
        Email : $email /n
        Message : $message";
        $heading = " From: $name /n Reply-To : $email";
        //  mail($destinataire,$subject,$message,$heading);     //a ouvrir quand ce sera en ligne pour recevoir le mail
    }
}
