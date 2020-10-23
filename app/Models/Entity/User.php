<?php

namespace blogProfessionnel\app\Models\Entity;

class User
{
    private $userId;
    private $email;
    private $login;
    private $password;
    private $admin;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $id
     */
    public function setId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $password
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
}
