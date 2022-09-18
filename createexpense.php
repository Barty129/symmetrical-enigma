<?php 
    $date = date('d-m-Y');
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
        $date_sub = $_POST['date'];
        $approver = $_POST['approver'];
        $proposer = $_POST['proposer'];
        $cost = $_POST['cost'];
        $description = $_POST['description'];
        $reimburse = $_POST['reimburse'];
        $sql = "INSERT INTO expenses (dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed) VALUES ('$date_sub', '$description', '$cost', '$proposer', '$approver', '$reimburse', '$reimburse')";
        if (mysqli_query($conn, $sql)) {
            $result = "New record created successfully";
            header( "refresh:1;url=./landing.php" );
        }
        else {
            $result =  "Error: " . $sql . "<br>" . mysqli_error($conn2);
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
            $rec_sql = "SELECT dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='No'";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td><a href='./viewedit.php'>".$row["Namedesc"]."</a></td>\n";
                echo "\t<td>".$row["Proposer"]."</td>\n";
                echo "\t<td>"."£".$row["Cost"]."</td>\n";

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
            $rec_sql = "SELECT dateval, Namedesc, Cost, Proposer, Approver, Reciept, reimbursed FROM `expenses`" ."WHERE reimbursed='Yes'";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td><a href='./viewedit.php'>".$row["Namedesc"]."</a></td>\n";
                echo "\t<td>".$row["Proposer"]."</td>\n";
                echo "\t<td>"."£".$row["Cost"]."</td>\n";

                echo "</tr>\n";
            }

            mysqli_close($conn);
            ?>
            </table>
            </div>

        </div>

    </div>

    <div class="welcome_text">
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Add a New Expense</em></p>
    </div>

    <div class="cancel">
        <a href="./landing.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    
    <div class="createexpform">
        <form class="createexpform" method="POST">
            <p class="createexpform">
            <label for="q1">Date</label>
            <input type="text" id="q1" name="date" value="<?php echo $date?>">
            </p>

            <p class="createexpform">
            <span><label for="q3">Purchase Name</label></span>
            <input type="text" id="q3" name="description">
            </p>

            <p class="createexpform">
            <span><label for="q2">Cost £</label></span>
            <input type="text" id="q2" name="cost"><span>   inc VAT, delivery etc</span>
            </p>
            
            <p  class="createexpform2">
            <label for="propose">Proposed By</label>
            <select id="propose" name="proposer">
                <option value="blank">----</option>
                <option value="CUSF Checkbook">CUSF Checkbook</option>
            </select>
            <br>
            <span id="note"><em>The name of the person who spent his/her own money. If it was paid for with the society chequebook, set this to "CUSF Chequebook".</em></spam>
            </p>

            <p class="createexpform2">
            <label for="approve">Approved By</label>
            <select id="approve" name="approver">
                <option value="blank">----</option>
                <option value="Barty Wardell">Barty Wardell</option>
                <option value="Abhijit Pandit">Abhijit Pandit</option>
                <option value="Jamie Russell">Jamie Russell</option>
                <option value="Kailen Patel">Kailen Patel</option>
                <option value="John Durrell">John Durrell</option>
            </select>
            <br>
            <span id="note"><em>This should be the second person who agreed that the purchase should be made.</em></span>
            </p>

            <p class="createexpform">
            <label for="file">Purchase Receipt</label>
            <input type="file" id="myFile" name="filename">
            </p>

            <p class="createexpform">
            <label for="q4" id="reimburse">Reimbursed</label>
            <select id="q4" name="reimburse">
                <option value="blank">----</option>
                <option value="No">No</option>
                <option value="Yes">Yes</option>
            </select>
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

