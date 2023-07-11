<!DOCTYPE html>
<html>

<head>
    <title>Login Page </title>

    <link rel="stylesheet" href="app\Views\Styling\Forms.css">
</head>

<body>
    <form method="post" class='Form' action="/Login">
        <h1>Welcome back </h1>
        <?php
        if (isset($_SESSION["invalidCredenitanls"])) {
            $invalidCredenitanls = $_SESSION["invalidCredenitanls"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $invalidCredenitanls . "</p><br>";
        }
        ?>
        <input type="text" name="userName" id="userName" Placeholder="UserName">
        <?php
        if (isset($_SESSION["userNameErr"])) {
            $userNameErr = $_SESSION["userNameErr"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $userNameErr . "</p>";
        }
        ?>
        <input type="password" name="password" id="password" Placeholder="Password">
        <?php
        if (isset($_SESSION["passwordErr"])) {
            $passwordErr = $_SESSION["passwordErr"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $passwordErr . "</p><br>";
        }
        ?>
        <div id="rememberMe">
            <input type="checkbox" name="remember" value="remember">
            <label for="rememberMe">Remember Me</label>
        </div>
        <input type="submit" name="Login" value="Login">
        </br>
        <p id="hyperLinkText">Not one of Us yet? <a href="/SignUp">Sign up here....</a></p>
    </form>
</body>

</html>