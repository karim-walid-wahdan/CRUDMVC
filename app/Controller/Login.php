<?php
namespace App\Controller;

use App\Model\User as User;
use App\Model\Token as Token;

class Login
{
    static function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function login()
    {

        $error = false;
        foreach ($_POST as $key => $input) {
            if (empty($_POST[$key])) {
                $_SESSION[$key . "Err"] = $key . " is required";
                $error = true;
            } else {
                unset($_SESSION[$key . "Err"]);
                $_POST[$key] = self::sanitize_input($_POST[$key]);
                $_SESSION[$key] = $_POST[$key];
            }
        }
        if ($error) {
            header("Location: /");
            exit();
        }
        // If both username and password are provided, perform further validation
        if (!empty($_POST["userName"]) && !empty($_POST["password"])) {
            $user = new User("", "", "");
            $user->getUser($_POST["userName"]);
            if ($user == null || !(password_verify($_POST["password"], $user->getPassword()))) {
                $_SESSION["invalidCredenitanls"] = "Invalid credenitanls please try again";
                header("Location: /");
                exit();
            }
            if (isset($_POST["remember"]) && $_POST["remember"] === "remember" && !(isset($_COOKIE["token"]))) {
                $token = bin2hex(random_bytes(16)); // Generate a random token using random_bytes()
                setcookie("token", $token, time() + (86400 * 30), "/"); // Set the token as a cookie for 30 days
                $token = new Token($token, date("Y-m-d H:i:s"), $user->getUserId(), $user->getUserName(), $user->getPassword(), $user->getEmail());
                $token->saveToken();
            } else if (isset($_COOKIE["token"])) {
                Token::deleteToken($_COOKIE["token"]);
                setcookie("token", null, time() - 3600, "/");
            }
            $_SESSION["loggedIn"] = "true";
            $_SESSION["userName"] = $user->getUserName();
            $_SESSION["userId"] = $user->getUserId();
            $_SESSION["role"] = $user->getRole();
            header("Location: /Home");
        }

    }
    function index()
    {
        if (isset($_COOKIE["token"]) || (isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] === "true")) {
            echo isset($_COOKIE["token"]) ? $_COOKIE["token"] : "";
            $result = Token::verifyToken((isset($_COOKIE["token"]) ? $_COOKIE["token"] : ""));
            if ($result !== null) {
                $user = new User("", "", "");
                $user->getUser($result["userName"]);
                $_SESSION["userName"] = $user->getUserName();
                $_SESSION["userId"] = $user->getUserId();
                $_SESSION["role"] = $user->getRole();
                $_SESSION["loggedIn"] = "true";
            }
            header("Location: /Home");
            exit();
        }
        require_once 'app/Views/LoginPage.php';
    }



}
?>