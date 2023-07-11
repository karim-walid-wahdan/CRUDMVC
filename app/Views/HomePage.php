<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" href="app\Views\Styling\HomePage.css">
</head>

<body>
    <div class="navBar">
        <div>
            <?php
            $userName = $_SESSION['userName'];
            echo "Welcome! $userName ";
            ?>
        </div>
        <div style="float: right;">
            <form action="logout.php" method="Get">
                <input type="submit" value="Logout">
            </form>
        </div>

    </div>
    <div class="mainBody">
        <?php
        use App\Model\User;

        echo User::getUsers("`userId`, `userName`, `email`, `password`, `role`"); ?>
    </div>
</body>

</html>