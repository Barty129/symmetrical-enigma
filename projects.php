<?php
$servername = "localhost";
$database = "cusf_test";
$username = "root";
// Create connection
$conn2 = mysqli_connect($servername, $username, "", $database);
// Check connection
if (!$conn2) {
      die("Connection failed: " . mysqli_connect_error());
}
 
$connection = "Connected successfully";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $date_proj = $_POST['date'];
    $name = $_POST['Name'];
    $ids = $_POST['_ID'];

    $person_1 = $_POST['Personnel_1'];
    $person_2 = $_POST['Personnel_2'];
    $person_3 = $_POST['Personnel_3'];

    $parent_proj = $_POST['p_project'];

    $tpm_1 = $_POST['tpm1'];
    $tpm_2 = $_POST['tpm2'];
    $tpm_3 = $_POST['tpm3'];

    $progress = $_POST['progress_state']; 
    $p_require = $_POST['p_requirements'];
    $c_require = $_POST['c_requirements'];
    $r_require = $_POST['r_requirements']; 

    $comment = $_POST['extradetail'];
    $current_sol = $_POST['current_sol'];
    $current_defi = $_POST['defi_sol'];
    $crit_path = $_POST['crit_path'];

    $sql = "INSERT INTO projects (dateval, name_sys , system_id, personnel_1, personnel_2, personnel_3, parent_proj, TPM_1, TPM_2, TPM_3,
             progress, parent_require, child_require, related_require, comments, current_sol, current_defi, critical_path) 
            VALUES ('$date_proj', '$name', '$ids', '$person_1', '$person_2', '$person_3', '$parent_proj', '$tpm_1', '$tpm_2', '$tpm_3',
             '$progress', '$p_require', '$c_require', '$r_require','$comment','$current_sol', '$current_defi', '$crit_path')";
    if (mysqli_query($conn2, $sql)) {
      $result = "New record created successfully";
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
    <link rel="stylesheet" href="stylesheet.css">
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
            $rec_sql = "SELECT name_sys, system_id, progress, dateval FROM `projects`";
            $res=mysqli_query($conn2, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
                echo "\t<td>".$row["name_sys"]."</td>\n";
                echo "\t<td>".$row["system_id"]."</td>\n";
                echo "\t<td>".$row["progress"]."</td>\n";
                echo "</tr>\n";
            }

            ?>
            </table>
            </div>

            <div class="new_expense">
                <h4>Requirements</h4>
            </div>

            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql2 = "SELECT Namedesc, sys_id, dateval FROM `requirements`";
            $res=mysqli_query($conn2, $rec_sql2);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
                echo "\t<td>".$row["Namedesc"]."</td>\n";
                echo "\t<td>".$row["sys_id"]."</td>\n";
                echo "</tr>\n";
            }

            ?>
            </table>
            </div>

        </div>

    </div>

    <div class="welcome_text">
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Welcome to CUSF Project Management</em></p>
    </div>


    <div class="addexpend"> 
        <a href="./addproject.php"><img id="engine" src="./Images/Engine.jpg" alt="White Dwarf" width="300" 
     height="405"></a>
        <h2 id="addexp">Add New Project</h2>
    </div>

    <div class="stats">
        <a href="./require.php"><img id="nebula" src="./Images/Nebula.jpg" alt="White Dwarf" width="300" 
     height="405"></a>
        <h2 id="stats">Add Requirement</h2>
    </div>

</body>



<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>