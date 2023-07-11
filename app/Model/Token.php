<?php
namespace App\Model;

use App\Config\DBConfig as DbConn;
use DateTime;
use PDO;

class Token
{
    private $token;
    private $expiry;
    private $userId;
    private $userName;
    private $password;
    private $email;

    public function __construct(string $token, string $expiry, int $userId, string $userName, string $password, string $email)
    {
        $this->token = $token;
        $this->expiry = $expiry;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
        $this->email = $email;

    }
    public function saveToken()
    {
        $tokenValue = $this->getToken();
        $expiryValue = $this->getExpiry();
        $passwordValue = $this->getPassword();
        $userNameValue = $this->getUserName();
        $userEmailValue = $this->getEmail();
        $userIdValue = $this->getUserId();
        $result = DbConn::executeQuery("INSERT INTO `user_tokens` (`token`, `expiry`, `password`, `userName`,`email`, `userId`) VALUES ('$tokenValue', '$expiryValue', '$passwordValue', '$userNameValue','$userEmailValue', '$userIdValue');");
    }

    public static function verifyToken($token)
    {
        $result = DbConn::executeQuery("SELECT `id`, `token`, `expiry`, `password`, `userName` ,`email`,`userId` FROM `user_tokens` WHERE `token`=  '$token'");
        if ($result->rowCount() === 0) {
            return null;
        }
        $result = $result->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public static function deleteToken($token)
    {
        $result = DbConn::executeQuery("DELETE FROM `user_tokens` WHERE `token`=  '$token'");
        if ($result->rowCount() === 0) {
            return null;
        }
        return $result;
    }
    public function getToken(): string
    {
        return $this->token;
    }
    public function getExpiry(): string
    {
        return $this->expiry;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getUserName(): string
    {
        return $this->userName;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getEmail(): string
    {
        return $this->email;
    }

    public function setExpiry(string $expiry): void
    {
        $this->expiry = $expiry;
    }
    public function setToken(string $token): void
    {
        $this->token = $token;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
    public function setUserName(string $userName): void
    {
        $this->userName = $userName;
    }
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

}