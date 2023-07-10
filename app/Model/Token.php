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

    public function __construct(string $token, string $expiry, int $userId, string $userName, string $password)
    {
        $this->token = password_hash($token, PASSWORD_DEFAULT);
        $this->expiry = $expiry;
        $this->userId = $userId;
        $this->userName = $userName;
        $this->password = $password;
    }
    public function saveToken()
    {
        $tokenValue = $this->getToken();
        $expiryValue = $this->getExpiry();
        $passwordValue = $this->getPassword();
        $userNameValue = $this->getUserName();
        $userIdValue = $this->getUserId();
        $result = DbConn::executeQuery("INSERT INTO `user_tokens` (`token`, `expiry`, `pwd`, `userName`, `user_id`) VALUES ('$tokenValue', '$expiryValue', '$passwordValue', '$userNameValue', '$userIdValue');");
    }

    // public function verify_token(Token $token)
    // {
    //     $token_id = $token->getToken();
    //     $token_id = $token_id
    //     $result = DbConn::executeQuery("SELECT `userName`, `userName`, `email`, `password`, `role` FROM `users` WHERE `userName` ='$userName'");
    //     if ($result->rowCount() === 0) {
    //         return false;
    //     }

    // }
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
}