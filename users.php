<?php 
    $date = date('d-m-Y');
    require('db.php');
    include("auth_session.php");

    $pwd_string = NULL;

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $pwd = bin2hex(openssl_random_pseudo_bytes(4));
        $submit_pwd = md5($pwd);
        $pwd_string = "Your OTP for this user is $pwd";

        $name = $_POST['name'];
        $CRSid = $_POST['crsid'];
        $email = $_POST['email'];
        $admin_check = $_POST['admin'];

        $sql_r = "INSERT INTO users (Name_list, username, email, password, create_datetime, Admin_list) 
                VALUES ('$name', '$CRSid', '$email', '$submit_pwd', '$date', '$admin_check')";
        if (mysqli_query($conn, $sql_r)) {
            $result = "New record created successfully";
            header( "refresh:10;url=./users.php" );
        }

        else {
            $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylesheet.css">
    <title>Document</title>
    
    <style>

    </style>
</head>


<body>
    <nav class="topnav">
        <ul class="navbar">
            <li><a class="active" href="./projects.php">Project Tracker</a></li>
          </ul>
    </nav>



    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
            <div class="new_expense">
                <h4>Users</h4>
            </div>
            <br>

            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql2 = "SELECT ID, Name_list, username, Admin_list FROM `management_users`";
            $res=mysqli_query($conn, $rec_sql2);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["Name_list"]."</td>\n";
                echo "\t<td>".$row["username"]."</td>\n";
                echo "\t<td>".$row["Admin_list"]."</td>\n";

                if ($_SESSION['Admin']=='Admin'){
                    echo "\t<td>";
                    echo "<form method='post' action='./deleteuser.php'>";
                    echo "<input type='hidden' name='ID_delete' value='" . $row["ID"] . "'>";
                    echo "<input type='submit' value='Delete'>";    
                }

                echo "</form>";
                echo "</tr>\n";
            }
            ?>
            </table>
            </div>

        </div>

    </div>

    <div class="welcome_text">
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Add a User</em></p>
    </div>

    <div class="cancel">
        <a href="./projects.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    
    <div class="createexpform">
        <form class="createexpform" method="POST" id="projectform">
            <p class="createexpform">
            <label for="q1">Name</label>
            <input type="text" id="q1" name="name">
            </p>

            <p class="createexpform">
            <label for="q2">CRSID</label>
            <input type="text" id="q2" name="crsid">
            </p>

            <p class="createexpform">
            <label for="q3">Email</label>
            <input type="text" id="q3" name="email">
            </p>

            <p class="createexpform2">Admin Status
            <br>
            <input type="radio" id="q4" name="admin" value="Admin">
            <label for="q4">Admin</label>
            <input type="radio" id="q5" name="admin" value="User">
            <label for="q5">User</label>
            </p>

            <?php
                if ($_SESSION['Admin']=='Admin'){
                    echo '<p class="createexpform">
                    <input type="submit" value="Submit">
                    <input type="reset">
                    </p>';
                }
            ?>

            <p style='color:red;' class="createexpform">
                <?=$pwd_string?>
            </p>

        </form>
    </div>

</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>