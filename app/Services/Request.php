<?php

namespace blogProfessionnel\app\Services;

class Request
{
    public function get($key)
    { if (isset($key)){
        return $_GET[$key];
    }
        
    }

    public function post($key)
    { if (isset($key)){
         return $_POST[$key];
    }
    }

    public function session($key)
    {if (isset($key)){
         return $_SESSION[$key];
    }
    }
}
