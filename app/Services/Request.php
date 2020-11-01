<?php

namespace blogProfessionnel\app\Services;

class Request
{
    public function get($key)
    { 
        return $_GET[$key];
    }

    public function post($key)
    {
         return $_POST[$key];
    }

    public function session($key)
    {
         return $_SESSION[$key];
    }
}
