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
    public function __construct(string $userName, string $email, string $password, string $role = "endUser", int $userId = null, )
    {
        $this->userId = $userId;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }
    public function getUser($userName)
    {
        $result = DbConn::executeQuery("SELECT `userId`, `userName`, `email`, `password`, `role` FROM `users` WHERE `userName` ='$userName'OR `email`='$userName'");
        if ($result->rowCount() === 0) {
            return false;
        }
        $result = $result->fetch(PDO::FETCH_ASSOC);
        $this->setUserName($result['userName']);
        $this->setEmail($result['email']);
        $this->setPassword($result['password']);
        $this->setRole($result['role']);
        $this->setUserId($result['userId']);
        return true;
    }
    public function registerUser()
    {
        $userName = $this->getUserName();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $result = DbConn::executeQuery("INSERT INTO `users` (`userName`, `email`, `password`)  VALUES ('$userName', '$email', '$password');");
        print_r($result);
    }
    public static function getUsers(string $dataNeeded): string
    {
        $result = DbConn::executeQuery("SELECT $dataNeeded FROM `users`");
        $result = $result->fetchAll(PDO::FETCH_ASSOC);
        $dataNeeded = substr($dataNeeded, 1, -1);
        $dataNeeded = explode("`, `", $dataNeeded);

        $table = '<table class="datatable">';
        $table .= '<thead><tr>';

        foreach ($dataNeeded as $column) {
            $table .= '<th>' . $column . '</th>';
        }

        $table .= '</tr></thead>';
        $table .= '<tbody>';

        foreach ($result as $row) {
            $table .= '<tr>';

            foreach ($dataNeeded as $column) {
                $table .= '<td>' . $row[$column] . '</td>';
            }

            $table .= '</tr>';
        }

        $table .= '</tbody>';
        $table .= '</table>';

        return $table;
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