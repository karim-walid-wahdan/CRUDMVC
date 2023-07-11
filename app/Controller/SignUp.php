<?php
namespace App\Controller;

use App\Model\User as User;
use App\Model\Token as Token;

class SignUp
{
    static function sanitize_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    function signUp()
    {
        session_start();
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
            header("Location: /SignUp");
            exit();
        }
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';

        if (!preg_match($pattern, $_POST['email'])) {
            $_SESSION["emailErr"] = "Please provide a proper email format";
            header("Location: /SignUp");
            exit();
        }
        if (!($_POST["confirmPassword"] === $_POST["password"])) {
            $_SESSION["confirmPasswordErr"] = "Passwords don't match please try again";
            header("Location: /SignUp");
            exit();
        } else {
            $_POST["password"] = password_hash(self::sanitize_input($_POST["password"]), PASSWORD_DEFAULT);
        }
        extract($_POST);
        $user = new User($userName, $email, $password);
        if ($user->getUser($userName) || $user->getUser($email)) {
            $_SESSION["invalidCredenitanls"] = "the userName or email provided is already registered";
            header("Location: /SignUp");
            exit();
        }
        $user->registerUser();
        $_SESSION["userName"] = $user->getUserName();
        $_SESSION["userId"] = $user->getUserId();
        $_SESSION["role"] = $user->getRole();
        $_SESSION['loggedIn'] = "true";
        header("Location: /Home");
    }
    function index()
    {
        if ((isset($_SESSION['loggedIn']))) {
            unset($_SESSION['loggedIn']);
        }
        require_once 'app/Views/SignUpPage.php';
    }
}