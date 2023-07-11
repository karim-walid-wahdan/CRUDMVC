<!DOCTYPE html>
<html>

<head>
    <title>SignUp Page </title>
    <link rel="stylesheet" href="app\Views\Styling\Forms.css">
</head>

<body>
    <form method="post" class='Form' action="/SignUp">
        <h1>Sign Up</h1>
        <?php
        if (isset($_SESSION["invalidCredenitanls"])) {
            $invalidCredenitanls = $_SESSION["invalidCredenitanls"];
            session_unset();
            session_destroy();
            echo "<p class='error'>" . $invalidCredenitanls . "</p><br>";
        }
        ?>
        <input type="text" name="userName" Placeholder="Username" value=<?php echo isset($_SESSION["userName"]) ? $_SESSION["userName"] : "" ?>>
        <?php if (isset($_SESSION["userNameErr"])) {
            $usernameErr = $_SESSION["userNameErr"];
            echo "<p class='error'>" . $usernameErr . "</p>";
            session_unset();
            session_destroy();
        }
        ?>
        <input type="email" name="email" Placeholder="Email" value=<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : "" ?>>
        <?php if (isset($_SESSION["emailErr"])) {
            $emailErr = $_SESSION["emailErr"];
            echo "<p class='error'>" . $emailErr . "</p>";
            session_unset();
            session_destroy();
        }
        ?>
        <input type="password" name="password" Placeholder="Password">
        <?php if (isset($_SESSION["passwordErr"])) {
            $passwordErr = $_SESSION["passwordErr"];
            echo "<p class='error'>" . $passwordErr . "</p><br>";
            session_unset();
            session_destroy();
        }
        ?>
        <input type="password" name="confirmPassword" Placeholder="Confirm Password">
        <?php if (isset($_SESSION["confirmPasswordErr"])) {
            $confirmPasswordErr = $_SESSION["confirmPasswordErr"];
            echo "<p class='error'>" . $confirmPasswordErr . "</p><br>";
        }
        ?>
        <input type="submit" name="SignUp" value="Sign Up">
        </br>
        <p id="hyperLinkText">Already a member? <a href="/Login">Sign In here...</a></p>
    </form>
</body>

</html>