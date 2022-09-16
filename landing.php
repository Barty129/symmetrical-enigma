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