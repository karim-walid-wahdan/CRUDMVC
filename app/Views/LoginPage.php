<!DOCTYPE html>
<html>

<head>
    <title>Login Page </title>

    <link rel="stylesheet" href="app\Views\Styling\Styles.css">
</head>

<body>
    <?php

    // Function to sanitize input data
    ?>

    <form method="post" class='Form' action="/login">
        <h1>Login Page</h1>
        <?php if (isset($_SESSION["invalidCredenitanls"])) {
            $invalidCredenitanls = $_SESSION["invalidCredenitanls"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $invalidCredenitanls . "</p><br>";
        }
        ?>
        <input type="text" name="userName" id="userName" Placeholder="UserName">
        <?php if (isset($_SESSION["userNameErr"])) {
            $userNameErr = $_SESSION["userNameErr"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $userNameErr . "</p>";
        }
        ?>


        <input type="password" name="password" id="password" Placeholder="Password">
        <?php if (isset($_SESSION["passwordErr"])) {
            $passwordErr = $_SESSION["passwordErr"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $passwordErr . "</p><br>";
        }
        ?>
        <div id="rememberMe">
            <input type="checkbox" value="remember">
            <label for="rememberMe">Remember Me</label>
        </div>
        <input type="submit" name="Login" value="Login">
        </br>
        <p id="signUpText">Not one of Us yet? <a href="/Signup">Sign up here....</a></p>
    </form>
</body>

</html>