<?php 
    $date = date('d-m-Y');
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

            <div class="sidebaritems">
                <ul class="sidebaritems">
                    <li class="sidebaritems"> Hello1
                    <li class="sidebaritems"> Hello2
                    <li class="sidebaritems"> Hello3
                </ul>
            </div>

            <div class="new_expense">
                <h4>Non-reimbursed</h4>
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
        <form class="createexpform" method="POST" action="./landing.php">
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
            
            <p  class="createexpform">
            <label for="propose">Proposed By</label>
            <select id="propose" name="proposer">
                <option value="blank">----</option>
                <option value="checkbook">CUSF Checkbook</option>
            </select>
            <br>
            <span id="note"><em>The name of the person who spent his/her own money. If it was paid for with the society chequebook, set this to "CUSF Chequebook" and put your name under "approved by".</em></spam>
            </p>

            <p class="createexpform">
            <label for="approve">Approved By</label>
            <select id="approve" name="approver">
                <option value="blank">----</option>
                <option value="barty">Barty Wardell</option>
                <option value="abhi">Abhijit Pandit</option>
                <option value="jamie">Jamie Russell</option>
                <option value="kailen">Kailen Patel</option>
                <option value="john">John Durrell</option>
            </select>
            <span id="note"><em>This should be the second person who agreed that the purchase should be made.</em></span>
            </p>

            <p class="createexpform">
            <label for="file">Purchase Receipt</label>
            <input type="file" id="myFile" name="filename">
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