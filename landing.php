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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $date_update = $_POST['date_update'];
    $approver_update = $_POST['approver_update'];
    $proposer_update = $_POST['proposer_update'];
    $cost_update = $_POST['cost_update'];
    $description_update = $_POST['description_update'];
    $reimburse_update = $_POST['reimburse_update'];
    $update_select = $_POST['save_ID'];
    $sql_update = "UPDATE `expenses` SET dateval='$date_update', Namedesc='$description_update', Cost='$cost_update', Proposer='$proposer_update', 
        Approver='$approver_update', Reciept='$reimburse_update', reimbursed='$reimburse_update'
         " . "WHERE ID='" . $update_select . "'";
    if (mysqli_query($conn, $sql_update)) {
        $result = "Record Updated";
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
    
</head>


<body>
    <nav class="topnav">
        <ul class="navbar">
            <li><a class="active" href="./landing.php">Expenses</a></li>
            <li><a  href="./projects.php">Project Tracker</a></li>
          </ul>
    </nav>


    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
            <div class="new_expense">
                <h4>Non-reimbursed</h4>
            </div>

            <br>
            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql = "SELECT ID, dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='No'";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["Namedesc"]."</td>\n";
                echo "\t<td>".$row["Proposer"]."</td>\n";
                echo "\t<td>"."£".$row["Cost"]."</td>\n";
                

                echo "\t<td>";
                echo "<form method='post' action='./viewedit.php'>";
                echo "<input type='hidden' name='trackid' value='" . $row["ID"] . "'>";
                echo "<input type='submit' value='View/Edit'>";
                echo "</form>";
                echo "</tr>\n";
            }

            ?>
            </table>
            </div>

            <br>
            <div class="new_expense">
                <h4>Reimbursed</h4>
            </div>

            <br>
            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql = "SELECT ID, dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='Yes'";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td><a href='./viewedit.php'>".$row["Namedesc"]."</a></td>\n";
                echo "\t<td>".$row["Proposer"]."</td>\n";
                echo "\t<td>"."£".$row["Cost"]."</td>\n";

                echo "\t<td>";
                echo "<form method='post' action='./viewedit.php'>";
                echo "<input type='hidden' name='trackid' value='" . $row["ID"] . "'>";
                echo "<input type='submit' value='View/Edit'>";
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
        <p><em>Welcome to CUSF Expenses</em></p>
    </div>

    <div class="addexpend"> 
        <a href="./createexpense.php"><img id="engine" src="./Images/Engine.jpg" alt="White Dwarf" width="300" 
     height="405"></a>
        <h2 id="addexp">Add new expense</h2>
    </div>

    <div class="stats">
        <a href="./tally.php"><img id="nebula" src="./Images/Nebula.jpg" alt="White Dwarf" width="300" 
     height="405"></a>
        <h2 id="stats">See Stats</h2>
    </div>

    <div class="allreimb">
    <a href="./allreimb.php"><h2 id="allreimb">All Reimbursements</h2></a>
    </div>


    
</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>