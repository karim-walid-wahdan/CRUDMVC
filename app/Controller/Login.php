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
        // Validate username
        if (empty($_POST["userName"])) {
            $_SESSION["userNameErr"] = "Username is required";
            #echo $_SESSION["userNameErr"];
            header("Location: /");
            exit();
        } else {
            $_POST["userName"] = self::sanitize_input($_POST["userName"]);
        }

        // Validate password
        if (empty($_POST["password"])) {
            $_SESSION["passwordErr"] = "Password is required";
            header("Location: /");
            exit();
        } else {
            $_POST["password"] = self::sanitize_input($_POST["password"]);

        }
        // If both username and password are provided, perform further validation
        if (!empty($_POST["userName"]) && !empty($_POST["password"])) {
            $user = new User();
            $user = $user->getUser($_POST["userName"]);
            echo $hash = password_hash("1234", PASSWORD_DEFAULT);
            if ($user == false || !(password_verify($_POST["password"], $user->getPassword()))) {
                $_SESSION["invalidCredenitanls"] = "Invalid credenitanls please try again";
                header("Location: /");
                exit();
            }
            $token = bin2hex(random_bytes(16)); // Generate a random token using random_bytes()
            setcookie("token", $token, time() + (86400 * 30), "/"); // Set the token as a cookie for 30 days
            $token = new Token($token, date("Y-m-d H:i:s"), $user->getUserId(), $user->getUserName(), $user->getPassword());
            $token->saveToken();
            print_r($token);
            echo $_COOKIE["token"]; // Retrieve the token from the cookie or set an empty string as default

        }

    }
    function index()
    {
        require_once 'app/Views/LoginPage.php';
    }



}
?>