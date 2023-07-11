<!DOCTYPE html>
<html>

<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" href="app\Views\Styling\HomePage.css">
</head>

<body>
    <?php
    
    ?>
    <div class="navBar">
        <div>
            <?php
            $userName = $_SESSION['userName'];
            echo "Welcome! $userName ";
            ?>
        </div>
        <form action="/Home" style="float: right; display: flex" method="POST">
            <button type="submit" name="adduser">Add User</button>
            <button type="submit" name="edituser">Edit User</button>
            <button type="submit" name="logout">Logout</button>
        </form>

    </div>
    <div class="mainBody">
        <?php
        use App\Model\User;

        echo User::getUsers("`userId`, `userName`, `email`, `password`, `role`"); ?>
    </div>
</body>

</html>