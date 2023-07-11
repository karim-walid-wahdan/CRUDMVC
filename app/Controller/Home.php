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

    static function loadHomePage()
    {
        
    }
    function index()
    {
        if (!isset($_SESSION["loggedIn"])) {
            header("Location: /");
        }
        require_once 'app/Views/HomePage.php';
    }

}