<?php

namespace blogProfessionnel\app\Models\Entity;

class BlogPost
{
    private $id;
    private $title;
    private $chapo;
    private $content;
    private $date;
    private $status;
    private $userId;
    //private $login;

    // public function __construct(array $row)
    // { $this->hydrate($row);     
    // }

// public function hydrate(array $row)
// {
//   foreach ($row as $key => $value)
//   {
//     $method = 'set'.ucfirst($key);
  
//     // Si le setter correspondant existe.
//     if (method_exists($this, $method))
//     {
//       // On appelle le setter.
//       $this->$method($value);
//     }
//   }
// }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getChapo()
    {
        return $this->chapo;
    }

    /**
     * @param mixed $chapo
     */
    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }


// /**
//      * @return mixed
//      */
//     public function getLogin()
//     {
//         return $this->login;
//     }

    // /**
    //  * @param mixed $chapo
    //  */
    // public function setLogin($login)
    // {
    //     $this->login = $login;
    // }

  
}
