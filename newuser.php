<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<?php
    include('/societies/cuspaceflight/management_mysqlconnect.inc.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = $_REQUEST['username'];
        $old_password = $_REQUEST['old_password'];
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $new_password = $_REQUEST['new_password'];
        $password_new = mysqli_real_escape_string($conn, $new_password);

        $query    = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($old_password) . "'";
        $result = mysqli_query($conn, $query) or die(mysql_error());
        $rows = mysqli_num_rows($result);

        if ($rows == 1) {

            $sql_update = "UPDATE `users` SET password='". md5($password_new) ."' WHERE username='" . $username . "' AND password= '" . md5($old_password) . "'";
            $update = mysqli_query($conn, $sql_update);
            echo "<div class='loginform'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='loginform'>
                  <h3>Invalid Information.</h3><br/>
                  <p class='link'>Click here to <a href='newuser.php'>try</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="loginform" action="" method="post">
        <h1 class="login-title">Password Reset</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="password" class="login-input" name="old_password" placeholder="Old Password">
        <input type="password" class="login-input" name="new_password" placeholder="New Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="loginlink"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>
