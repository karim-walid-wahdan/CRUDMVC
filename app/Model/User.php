<?php
namespace App\Model;

use App\Config\DBConfig as DbConn;
use PDO;

class User
{
    private $userId = "";
    private $userName = "";
    private $email = "";
    private $password = "";
    private $role = "";

    public function getUser($userName)
    {
        $result = DbConn::executeQuery("SELECT `userId`, `userName`, `email`, `password`, `role` FROM `users` WHERE `userName` ='$userName'");
        if ($result->rowCount() === 0) {
            return false;
        }
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $user = new User();
        $user->setUserName($result['userName']);
        $user->setEmail($result['email']);
        $user->setPassword($result['password']);
        $user->setRole($result['role']);
        $user->setUserId($result['userId']);
        return $user;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
}