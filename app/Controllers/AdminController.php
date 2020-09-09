<?php

namespace blogProfessionnel\app\Controllers;



class AdminController
{

    public function isLogged($status){
        if (isset($_SESSION['user']) && isset($_SESSION['user']["login"]) && $status ==1){
            return true;
        }else{
            return false;
        }
    }




}
