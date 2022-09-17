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

    $rec_sql = "SELECT dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='No'";
    $res=mysqli_query($conn, $rec_sql);
    $totalowe = 0;
    while ($row=mysqli_fetch_array($res)) {
        $totalowe += $row["Cost"];
    }

    $rec_sql = "SELECT dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='Yes'";
    $res=mysqli_query($conn, $rec_sql);
    $totalreimb = 0;
    while ($row=mysqli_fetch_array($res)) {
        $totalreimb += $row["Cost"];
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
            <li><a class="active" href="./landing.php">Expenses</a></li>
            <li><a  href="./projects.php">Project Tracker</a></li>
          </ul>
    </nav>

    <div>
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Welcome to CUSF Stats</em></p>
    </div>

    <div class="cancel">
        <a href="./landing.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    <div class="stats">
        <table class="stattable">
            <tr>
                <td>Number of ongoing projects:</td>
                <td></td>
            </tr>
            <tr>
                <td>Money Currently Owed:</td>
                <td>£ <?=$totalowe?></td>
            </tr>
            <tr>
                <td>Total money reimbursed:</td>
                <td>£ <?=$totalreimb?></td>
            </tr>
            <tr>
                <td>Number of system users:</td>
                <td></td>
            </tr>
            <tr>
                <td>Rockets launched:</td>
                <td>4</td>
            </tr>
        </table>
    </div>

    <img id="pulsar" src="./Images/Pulsar.jpg" alt="White Dwarf" width="650" 
     height="400">
    
</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>