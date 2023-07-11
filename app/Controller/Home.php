<?php
namespace App\Controller;

use App\Model\User as User;
use App\Model\Token as Token;

class Home
{
    static function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    static function handleHome()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['adduser'])) {

            } elseif (isset($_POST['edituser'])) {

            } elseif (isset($_POST['logout'])) {
                if (isset($_COOKIE["token"])) {
                    Token::deleteToken($_COOKIE["token"]);
                    setcookie("token", null, time() - 3600, "/");
                }
                unset($_SESSION["loggedIn"]);
                header("Location: /Login");
            }



        }
    }
    function index()
    {
        if (!isset($_SESSION["loggedIn"])) {
            header("Location: /");
        }
        require_once 'app/Views/HomePage.php';
    }

}