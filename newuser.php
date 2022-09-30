<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<?php
    require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password_new = mysqli_real_escape_string($conn, $password);
        $sql_update = "UPDATE `users` SET password='". md5($password_new) ."' WHERE username='" . $username . "' AND password='CUSF2022'";
        $result   = mysqli_query($conn, $sql_update);
        if ($result) {
            echo "<div class='loginform'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='loginform'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="loginform" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="password" class="login-input" name="password" placeholder="New Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="loginlink"><a href="login.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>