<?php 
    $servername = "localhost";
    $database = "cusf_test";
    $username = "root";
    // Create connection
    $conn = mysqli_connect($servername, $username, "", $database);
    // Check connection
    if (!$conn) {
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
            <li><a class="active" href="./landing.php">Expenses</a></li>
            <li><a  href="./projects.php">Project Tracker</a></li>
          </ul>
    </nav>

    <div>
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Welcome to all expenditure</em></p>
    </div>

    <div class="cancel">
        <a href="./landing.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    <div class="allreimbtable">
        <table cellpadding=3 width="750" class="allreimbtable">
            <tr style="font-weight: bold">
            <td>Date</td><td width="280">Description</td><td>Cost</td><td>Purchased by</td><td>Receipt</td><td>Action</td>
            </tr>
            <?php
            $rec_sql = "SELECT dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr id='sidebartable'>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
                echo "\t<td>".$row["Namedesc"]."</td>\n";
                echo "\t<td>".$row["Proposer"]."</td>\n";
                echo "\t<td>"."£".$row["Cost"]."</td>\n";
                echo "\t<td>".$row["reimbursed"]."</td>\n";

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