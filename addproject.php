<?php 
    $date = date('d-m-Y');

    include('/societies/cuspaceflight/management_mysqlconnect.inc.php');
    include("auth_session.php");

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

        $last_editor = $_POST['last_user'];
        $last_edited = $_POST['last_time_change'];
        $change_comments = $_POST['change_comments'];
    
        $sql_r = "INSERT INTO projects (dateval, name_sys , system_id, personnel_1, personnel_2, personnel_3, parent_proj, TPM_1, TPM_2, TPM_3,
                 progress, parent_require, child_require, related_require, comments, current_sol, current_defi, critical_path, last_editor,
                 last_edited, change_comments) 
                VALUES ('$date_proj', '$name', '$ids', '$person_1', '$person_2', '$person_3', '$parent_proj', '$tpm_1', '$tpm_2', '$tpm_3',
                 '$progress', '$p_require', '$c_require', '$r_require','$comment','$current_sol', '$current_defi', '$crit_path', '$last_editor', 
                 '$last_edited', '$change_comments')";
        if (mysqli_query($conn, $sql_r)) {
            $result = "New record created successfully";
            header( "refresh:1;url=./projects.php" );
        }
        else {
            $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    
    }
?>



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
            <li><a class="active" href="./projects.php">Project Tracker</a></li>
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
            $rec_sql = "SELECT ID, name_sys, system_id, progress, dateval, parent_require, child_require  FROM `management_projects`";
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
            $rec_sql2 = "SELECT ID, Namedesc, sys_id, dateval FROM `management_requirements`";
            $res=mysqli_query($conn, $rec_sql2);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
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
        <h3>CUSF Expenses and Project Management</h3>
        <p><em>Add a New Project</em></p>
    </div>

    <div class="cancel">
        <a href="./projects.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    
    <div class="createexpform">
        <form class="createexpform" method="POST" id="projectform">
            <p class="createexpform">
            <label for="q1">Date</label>
            <input type="text" id="q1" name="date" value="<?php echo $date?>">
            </p>

            <p class="createexpform">
            <span><label for="q2">Project Name</label></span>
            <input type="text" id="q2" name="Name">
            </p>

            <p class="createexpform">
            <span><label for="q3">ID</label></span>
            <input type="text" id="q3" name="_ID">
            </p>

            <p class="createexpform">
            <span><label for="q4">Responsible Personnel:</label></span>
            <select id="q4" name="Personnel_1">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Name_list FROM `management_users`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Name_list"] . ">" . $row["Name_list"] . "</option>";
                }
                ?>
            </select>

            <select id="q4" name="Personnel_2">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Name_list FROM `management_users`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Name_list"] . ">" . $row["Name_list"] . "</option>";
                }
                ?>
            </select>
            
            <select id="q4" name="Personnel_3">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Name_list FROM `management_users`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Name_list"] . ">" . $row["Name_list"] . "</option>";
                }
                ?>
            </select>
            </p>


            <p  class="createexpform">
            <label for="q5">Parent Project</label>
            <select id="q5" name="p_project">
                <option value="blank">----</option>
                <?php
                $rec_sql = "SELECT name_sys FROM `management_projects`";
                $res=mysqli_query($conn, $rec_sql);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["name_sys"] . ">" . $row["name_sys"] . "</option>";
                }

            ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q6">Technical Performance Metric:</label>
            <input type="text" list="tpms" id="q6" name="tpm1">,
            <input type="text" list="tpms" name="tpm2">,
            <input type="text" list="tpms" name="tpm3">
 
            <datalist id="tpms">
                <option value="Mass"></option>
                <option value="Length"></option>
                <option value="Cost"></option>
                <option value="Volume"></option> 
                <option value="No. of parts"></option> 
                <option value="Machining Complexity"></option> 
            </datalist>
            </p>

            <p  class="createexpform2">
            <label for="q7">Progress State</label>
            <select id="q7" name="progress_state">
                <option value="blank">----</option>
                <option value="SRR">System Requirements Review</option>
                <option value="PDR">Preliminary Design Review</option>
                <option value="CDR">Critical Design Review</option>
                <option value="B/BT">Benchtop/Breadboard Test</option>
                <option value="MRR">Manufacture Readiness Review</option>
                <option value="TRR">Test Readiness Review</option>
                <option value="SAR">System Acceptance Review</option>
                <option value="MRC">Mission Readiness Check</option>
                <option value="PMAR">Post-mission Assessment Review</option>
                <option value="Complete">Documentation Complete</option>
            </select>
            <br>
            <span id="note"><em>Please only select an option if the exit criteria have been met.</em></spam>
            </p>

            <p  class="createexpform">
            <label for="q8">Parent Requirements</label>
            <select id="q8" name="p_requirements">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `management_requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }

                ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q9">Child Requirements</label>
            <select id="q9" name="c_requirements">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `management_requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }

                ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q10">Related Requirements</label>
            <select id="q10" name="r_requirements">
                <option value="blank">----</option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `management_requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }

                mysqli_close($conn);
                ?>
            </select>
            </p>

            <p class="requiretitle">
            System Overview
            </p>

            <p  class="createexpform4">
            <label for="q12">Current Solution</label>
            <br>
            <textarea style="resize: none;" id="q12" name="current_sol" rows="4" cols="100"></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q13">Deficiencies in Current Solution</label>
            <br>
            <textarea style="resize: none;" id="q13" name="defi_sol" rows="4" cols="100"></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q14">Additional Critical-Path Work</label>
            <br>
            <textarea style="resize: none;" id="q14" name="crit_path" rows="4" cols="100"></textarea>
            </p>

            <p  class="createexpform3">
            <label for="q15">Comments</label>
            <br>
            <textarea style="resize: none;" id="q15" name="extradetail" rows="4" cols="100"></textarea>
            </p>

            <p class="createexpform">
            <span><label style="color: red;" for="q17">Last Editor</label></span>
            <input type="text" id="q17" name="last_user" value="<?=$_SESSION['Name']?>" readonly>
            </p>

            <p class="createexpform">
            <span><label style="color: red;" for="q18">Last Edited</label></span>
            <input type="text" id="q18" name="last_time_change" value="<?=$date?>" readonly>
            </p>

            <p  class="createexpform4">
            <label style="color: red;" for="q19">Change Comments</label>
            <br>
            <textarea style="resize: none;" id="q19" name="change_comments" rows="4" cols="100"></textarea>
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
