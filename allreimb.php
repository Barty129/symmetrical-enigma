<?php 
require('db.php');
include("auth_session.php");
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

    <div>
        <h3>CUSF Project Management</h3>
        <p><em>Welcome to all projects</em></p>
    </div>

    <div class="cancel">
        <a href="./projects.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    <div class="allreimbtable">
        <table cellpadding=3 width="750" class="allreimbtable">
            <tr style="font-weight: bold">
            <td>Date</td><td width="280">Name</td><td>ID</td><td>Progress State</td>
            </tr>
            <?php
            $rec_sql = "SELECT ID, name_sys, system_id, progress, dateval, parent_require, child_require FROM `projects`";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr id='sidebartable'>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
                echo "\t<td>".$row["name_sys"]."</td>\n";
                echo "\t<td>".$row["system_id"]."</td>\n";
                echo "\t<td>".$row["progress"]."</td>\n";
            
                echo "</tr>\n";
            }

            ?>
        </table>
    </div>
    
</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>