<?php
$date = date('d-m-Y');
include('/societies/cuspaceflight/management_mysqlconnect.inc.php');
include("auth_session.php");


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $tracker = $_POST['trackid'];
    $rev_sql = "SELECT dateval, Namedesc, sys_id, Related_project, personName, desirable_1, desirable_2, desirable_3, essential_1, essential_2, essential_3, preferable_1,
    preferable_2, preferable_3, sysint_1, sysint_2, sysint_3, perfvals_1, perfvals_2, perfvals_3, intproc_1, intproc_2, intproc_3, failmodes_1,
    failmodes_2, failmodes_3, designdocu_1, designdocu_2, designdocu_3, funcdocu_1, funcdocu_2, funcdocu_3, opsproc_1, opsproc_2, opsproc_3,
    last_editor, last_edited, change_comments FROM `management_requirements`" ."WHERE ID='" . $tracker . "'";
    $res=mysqli_query($conn, $rev_sql);
        while ($row=mysqli_fetch_array($res)) {
            $old_date = $row["dateval"];
            $old_name = $row["Namedesc"];
            $old_id = $row["sys_id"];
            $old_project = $row["Related_project"];
            $old_user = $row["personName"];

            $old_des1 = $row["desirable_1"];
            $old_des2 = $row["desirable_2"];
            $old_des3 = $row["desirable_3"];

            $old_essen1 = $row["essential_1"];
            $old_essen2 = $row["essential_2"];
            $old_essen3 = $row["essential_3"];

            $old_pref1 = $row["preferable_1"];
            $old_pref2 = $row["preferable_2"];
            $old_pref3 = $row["preferable_3"];

            $old_sysint1 = $row["sysint_1"];
            $old_sysint2 = $row["sysint_2"];
            $old_sysint3 = $row["sysint_3"];

            $old_perval1 = $row["perfvals_1"];
            $old_perval2 = $row["perfvals_2"];
            $old_perval3 = $row["perfvals_3"];

            $old_intpro1 = $row["intproc_1"];
            $old_intpro2 = $row["intproc_2"];
            $old_intpro3 = $row["intproc_3"];

            $old_failm1 = $row["failmodes_1"];
            $old_failm2 = $row["failmodes_2"];
            $old_failm3 = $row["failmodes_3"];

            $old_desdoc1 = $row["designdocu_1"];
            $old_desdoc2 = $row["designdocu_2"];
            $old_desdoc3 = $row["designdocu_3"];

            $old_fundoc1 = $row["funcdocu_1"];
            $old_fundoc2 = $row["funcdocu_2"];
            $old_fundoc3 = $row["funcdocu_3"];

            $old_opspro1 = $row["opsproc_1"];
            $old_opspro2 = $row["opsproc_2"];
            $old_opspro3 = $row["opsproc_3"];

            $previous_user = $row["last_editor"];
            $previous_change = $row["last_edited"];
            $previous_comments = $row["change_comments"];
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
        <h3>CUSF Project Management</h3>
        <p><em>Add a New Requirement</em></p>
    </div>

    <div class="cancel">
        <a href="./index.php"><h4 id="cancel">Cancel</h4></a>
    </div>


    <div class="createexpform">
        <form class="createexpform" method="POST" id="projectform" action="./updatereq.php">
            <p class="createexpform">
            <label for="q1">Date</label>
            <input type="text" id="q1" name="date_r_update" value="<?=$old_date?>">
            </p>

            <p class="createexpform">
            <span><label for="q2">Requirement Name</label></span>
            <input type="text" id="q2" name="Name_r_update" value="<?=$old_name?>">
            </p>

            <p class="createexpform">
            <span><label for="q3">ID</label></span>
            <input type="text" id="q3" name="_ID_r_update" value="<?=$old_id?>">
            </p>

            <p  class="createexpform">
            <label for="q15">Related Project</label>
            <select id="q15" name="rela_project_update">
                <option value="<?=$old_project?>"><?=$old_project?></option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `management_requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }
            ?>
            </select>
            </p>

            <p class="createexpform">
            <span><label for="q16">Responsible Personnel:</label></span>
            <select id="q16" name="Personnel_1_update">
                <option value="<?=$old_user?>"><?=$old_user?></option>
                <?php
                $rec_sql2 = "SELECT Name_list FROM `management_users`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Name_list"] . ">" . $row["Name_list"] . "</option>";
                }
                ?>
            </select>
            </p>

            <p class="requiretitle">
            Functional Requirements
            </p>

            <p  class="createexpform4">
            <label for="q4">Essential</label>
            <br>
            1. <textarea style="resize: none;" id="q4" name="essential1_update" rows="1" cols="100"><?=$old_essen1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="essential2_update" rows="1" cols="100"><?=$old_essen2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="essential3_update" rows="1" cols="100"><?=$old_essen3?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q5">Desirable</label>
            <br>
            1. <textarea style="resize: none;" id="q5" name="desirable1_update" rows="1" cols="100"><?=$old_des1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="desirable2_update" rows="1" cols="100"><?=$old_des2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="desirable3_update" rows="1" cols="100"><?=$old_des3?></textarea>
            </p>

            <p  class="createexpform4" id="bottomfour">
            <label for="q6">Preferable</label>
            <br>
            1. <textarea style="resize: none;" id="q6" name="preferable1_update" rows="1" cols="100"><?=$old_pref1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="preferable2_update" rows="1" cols="100"><?=$old_pref2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="preferable3_update" rows="1" cols="100"><?=$old_pref3?></textarea>
            </p>

            <p class="requiretitle">
            Integration Requirements
            </p>

            <p  class="createexpform4">
            <label for="q7">System Interfaces</label>
            <br>
            1. <textarea style="resize: none;" id="q7" name="sysi1_update" rows="1" cols="100"><?=$old_sysint1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="sysi2_update" rows="1" cols="100"><?=$old_sysint2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="sysi3_update" rows="1" cols="100"><?=$old_sysint3?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q8">Performance Validations</label>
            <br>
            1. <textarea style="resize: none;" id="q8" name="perfval1_update" rows="1" cols="100"><?=$old_perval1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="perfval2_update" rows="1" cols="100"><?=$old_perval2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="perfval3_update" rows="1" cols="100"><?=$old_perval3?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q9">Integration Processes</label>
            <br>
            1. <textarea style="resize: none;" id="q9" name="intpro1_update" rows="1" cols="100"><?=$old_intpro1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="intpro2_update" rows="1" cols="100"><?=$old_intpro2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="intpro3_update" rows="1" cols="100"><?=$old_intpro3?></textarea>
            </p>

            <p  class="createexpform4" id="bottomfour">
            <label for="q10">Failure Modes and Error Handling</label>
            <br>
            1. <textarea style="resize: none;" id="q10" name="failerrorhandle1_update" rows="1" cols="100"><?=$old_failm1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="failerrorhandle2_update" rows="1" cols="100"><?=$old_failm2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="failerrorhandle3_update" rows="1" cols="100"><?=$old_failm3?></textarea>
            </p>

            <p class="requiretitle">
            Reporting Requirements
            </p>

            <p  class="createexpform4">
            <label for="q12">Design Documentation</label>
            <br>
            1. <textarea style="resize: none;" id="q12" name="designdocu1_update" rows="1" cols="100"><?=$old_desdoc1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="designdocu2_update" rows="1" cols="100"><?=$old_desdoc2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="designdocu3_update" rows="1" cols="100"><?=$old_desdoc3?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q13">Functionality Documentation</label>
            <br>
            1. <textarea style="resize: none;" id="q13" name="funcdocu1_update" rows="1" cols="100"><?=$old_fundoc1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="funcdocu2_update" rows="1" cols="100"><?=$old_fundoc2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="funcdocu3_update" rows="1" cols="100"><?=$old_fundoc3?></textarea>
            </p>

            <p  class="createexpform4" id="bottomfour">
            <label for="q14">Operations Procedures</label>
            <br>
            1. <textarea style="resize: none;" id="q14" name="opspro1_update" rows="1" cols="100"><?=$old_opspro1?></textarea>
            <br>
            2. <textarea style="resize: none;" name="opspro2_update" rows="1" cols="100"><?=$old_opspro2?></textarea>
            <br>
            3. <textarea style="resize: none;" name="opspro3_update" rows="1" cols="100"><?=$old_opspro3?></textarea>
            </p>

            <p class="createexpform">
            <span><label style="color: red;" for="q17">Last Editor</label></span>
            <input type="text" id="q17" name="last_user_upd" value="<?=$_SESSION['Name']?>" readonly>
            </p>

            <p class="createexpform">
            <span><label style="color: red;" for="q18">Last Edited</label></span>
            <input type="text" id="q18" name="last_time_upd" value="<?=$date?>" readonly>
            </p>

            <p  class="createexpform4">
            <label style="color: red;" for="q19">Change Comments</label>
            <br>
            <textarea style="resize: none;" id="q19" name="change_comments_upd" rows="4" cols="100"></textarea>
            </p>

            
            <p class="createexpform4" style="color: red;">Last edited by <?=$previous_user?> on <?=$previous_change?>.
            <br><u>Previous Comment:</u> <?=$previous_comments?></p>

            <input type='hidden' name='save_ID' value='<?=$tracker?>'>
            <input type="submit" value="Save">
        </form>

        <form method="POST" action="./deletereq.php">
            <input type='hidden' name='ID_delete' value='<?=$tracker?>'>
            <input type="submit" value="Delete">
        </form>


            <br>
        </form>
    </div>

</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>
