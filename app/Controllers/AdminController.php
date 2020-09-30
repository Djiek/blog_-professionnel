<?php

namespace blogProfessionnel\app\Controllers;



class AdminController
{

    public function isLogged($admin){
        if (isset($_SESSION['user']) && isset($_SESSION['user']["login"]) && $admin == 1){
            return true;
        }else{
            return false;
        }
    }




}
