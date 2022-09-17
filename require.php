<?php 
    $date = date('d-m-Y');
    $servername = "localhost";
    $database = "cusf_test";
    $username = "root";
    // Create connection
    $conn1 = mysqli_connect($servername, $username, "", $database);
    // Check connection
    if (!$conn1) {
      die("Connection failed: " . mysqli_connect_error());
    }
 
    $connection = "Connected successfully";
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
            <li><a  href="./landing.php">Expenses</a></li>
            <li><a class="active" href="./projects.php">Project Tracker</a></li>
          </ul>
    </nav>

    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
            <div class="new_expense">
                <h4>Projects</h4>
            </div>

            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql = "SELECT name_sys, system_id, progress FROM `projects`";
            $res=mysqli_query($conn1, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["name_sys"]."</td>\n";
                echo "\t<td>".$row["system_id"]."</td>\n";
                echo "\t<td>".$row["progress"]."</td>\n";
                echo "</tr>\n";
            }

            mysqli_close($conn1);
            ?>
            </table>
            </div>

            <div class="new_expense">
                <h4>Requirements</h4>
            </div>

            <div class="sidebaritems">
            </div>

        </div>

    </div>

    <div class="welcome_text">
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Add a New Requirement</em></p>
    </div>

    <div class="cancel">
        <a href="./projects.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    
    <div class="createexpform">
        <form class="createexpform" method="POST" action="./projects.php" id="projectform">
            <p class="createexpform">
            <label for="q1">Date</label>
            <input type="text" id="q1" name="date_r" value="<?php echo $date?>">
            </p>

            <p class="createexpform">
            <span><label for="q2">Requirement Name</label></span>
            <input type="text" id="q2" name="Name_r">
            </p>

            <p class="createexpform">
            <span><label for="q3">ID</label></span>
            <input type="text" id="q3" name="_ID_r">
            </p>


            <p class="createexpform">
            <input type="submit" value="Submit">
            <input type="reset">
            </p>
        </form>
    </div>

</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>
