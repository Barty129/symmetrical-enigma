<?php
include('/societies/cuspaceflight/management_mysqlconnect.inc.php');
include("auth_session.php");

$connection = "Connected successfully";


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $update_select = $_POST['save_ID'];

    $date_proj_upds = $_POST['date_update'];
    $name_upds = $_POST['Name_update'];
    $ids_upds = $_POST['_ID_update'];

    $person_1_upds = $_POST['Personnel_1_update'];
    $person_2_upds = $_POST['Personnel_2_update'];
    $person_3_upds = $_POST['Personnel_3_update'];

    $parent_proj_upds = $_POST['p_project_update'];

    $tpm_1_upds = $_POST['tpm1_update'];
    $tpm_2_upds = $_POST['tpm2_update'];
    $tpm_3_upds = $_POST['tpm3_update'];

    $progress_upds = $_POST['progress_state_update']; 
    $p_require_upds = $_POST['p_requirements_update'];
    $c_require_upds = $_POST['c_requirements_update'];
    $r_require_upds = $_POST['r_requirements_update']; 

    $comment_upds = $_POST['extradetail_update'];
    $current_sol_upds = $_POST['current_sol_update'];
    $current_defi_upds = $_POST['defi_sol_update'];
    $crit_path_upds = $_POST['crit_path_update'];

    $last_user_upds = $_POST['last_user_upd'];
    $last_changed_upds = $_POST['last_time_upd'];
    $change_comments_upds = $_POST['change_comments_upd'];

    $sql_update = "UPDATE management_projects SET dateval='$date_proj_upds', name_sys='$name_upds' , system_id='$ids_upds', personnel_1='$person_1_upds', personnel_2='$person_2_upds', 
    personnel_3='$person_3_upds', parent_proj='$parent_proj_upds', TPM_1='$tpm_1_upds', TPM_2='$tpm_1_upds', TPM_3='$tpm_1_upds', progress='$progress_upds', 
    parent_require='$p_require_upds', child_require='$c_require_upds', related_require='$r_require_upds', comments='$comment_upds', current_sol='$current_sol_upds',
    current_defi='$current_defi_upds', critical_path='$crit_path_upds', last_editor='$last_user_upds', last_edited='$last_changed_upds', change_comments='$change_comments_upds' " . "WHERE ID='" . $update_select . "'";

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
    <link rel="stylesheet" href="stylesheet.css">
    <title>Document</title>
    
    <style>

    </style>
</head>


<body>
    <nav class="topnav">
        <ul class="navbar">
            <li><a class="active" href="./index.php">Project Tracker</a></li>
          </ul>
    </nav>


    <div class="wrapper">
        <!--Top menu -->
        <div class="sidebar">
            <div class="new_expense">
                <h4>Projects</h4>
            </div>
            <br>
            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql = "SELECT ID, name_sys, system_id, progress, dateval, parent_require, child_require FROM management_projects";
            $res=mysqli_query($conn, $rec_sql);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["name_sys"]."</td>\n";
                echo "\t<td>".$row["system_id"]."</td>\n";
                echo "\t<td>".$row["progress"]."</td>\n";
                echo "\t<td>";
                echo "<form method='post' action='./projectviewedit.php'>";
                echo "<input type='hidden' name='trackid' value='" . $row["ID"] . "'>";
                echo "<input type='submit' value='View/Edit'>";
                echo "</form>";
                echo "</tr>\n";
                echo "<tr>\n";
                echo "\t<td>Parent Requirements:</td>\n";
                echo "\t<td><em>".$row["parent_require"]."</em></td>\n";
                echo "</tr>\n";
                echo "<tr id='subnote'>\n";
                echo "\t<td>Child Requirements:</td>\n";
                echo "\t<td><em>".$row["child_require"]."</em></td>\n";
                echo "</tr>\n";
            }
            ?>

            </table>
            </div>
            
            <br>
            <div class="new_expense">
                <h4>Requirements</h4>
            </div>
            <br>
            <div class="sidebaritems">
            <table cellpadding=3 width="580" class="sidebartable">
                <tr>
                </tr>
            <?php
            $rec_sql2 = "SELECT ID, Namedesc, sys_id, dateval FROM management_requirements";
            $res=mysqli_query($conn, $rec_sql2);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["Namedesc"]."</td>\n";
                echo "\t<td>".$row["sys_id"]."</td>\n";

                echo "\t<td>";
                echo "<form method='post' action='./requireviewedit.php'>";
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
        <h3>CUSF Project Management</h3>
        <p><em>Welcome to CUSF Project Management, <?=$_SESSION['Name']?></em></p>
    </div>

    <div class="cancel">
        <a href="./logout.php"><h4 id="cancel">Logout</h4></a>
    </div>

    <?php
    if ($_SESSION['Admin']=='Admin'){
        echo '<div class="cancel">
        <a href="./users.php"><h4 id="users">Users</h4></a>
        </div>';
    }
    ?>


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

    <div class="allreimb">
    <a href="./allreimb.php"><h2 id="allreimb">All Projects</h2></a>
    </div>
</body>



<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>