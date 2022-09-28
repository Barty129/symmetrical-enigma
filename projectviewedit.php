<?php 
    $date = date('d-m-Y');
    require('db.php');
    include("auth_session.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $tracker = $_POST['trackid'];
        $pro_sql = "SELECT ID, dateval, name_sys, system_id, personnel_1, personnel_2, personnel_3, parent_proj, TPM_1, TPM_2, TPM_3,
        progress,  parent_require, child_require, related_require, comments, current_sol, current_defi, critical_path FROM `projects`";
        $res=mysqli_query($conn, $pro_sql);
        while ($row=mysqli_fetch_array($res)) {
                $old_date = $row["dateval"];
                $old_name = $row["name_sys"];
                $old_sysid = $row["system_id"];
                $old_person1 = $row["personnel_1"];
                $old_person2 = $row["personnel_2"];
                $old_person3 = $row["personnel_3"];
                $old_parentproj = $row["parent_proj"];
                $old_tpm1 = $row["TPM_1"];
                $old_tpm2 = $row["TPM_2"];
                $old_tpm3 = $row["TPM_3"];
                $old_progress = $row["progress"];
                $old_parentreq = $row["parent_require"];
                $old_childreq = $row["child_require"];
                $old_relatedreq = $row["related_require"];
                $old_comments = $row["comments"];
                $old_currentsol = $row["current_sol"];
                $old_currentdefi = $row["current_defi"];
                $old_critpath = $row["critical_path"];
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
            $rec_sql = "SELECT ID, name_sys, system_id, progress, dateval, parent_require, child_require  FROM `projects`";
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
            $rec_sql2 = "SELECT ID, Namedesc, sys_id, dateval FROM `requirements`";
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
        <p><em>Add a New Project</em></p>
    </div>

    <div class="cancel">
        <a href="./projects.php"><h4 id="cancel">Cancel</h4></a>
    </div>

    
    <div class="createexpform">
        <form class="createexpform" method="POST" id="projectform" action="./projects.php">
            <p class="createexpform">
            <label for="q1">Date</label>
            <input type="text" id="q1" name="date_update" value="<?=$old_date?>">
            </p>

            <p class="createexpform">
            <span><label for="q2">Project Name</label></span>
            <input type="text" id="q2" name="Name_update" value="<?=$old_name?>">
            </p>

            <p class="createexpform">
            <span><label for="q3">ID</label></span>
            <input type="text" id="q3" name="_ID_update" value="<?=$old_sysid?>">
            </p>

            <p class="createexpform">
            <span><label for="q4">Responsible Personnel:</label></span>
            <input type="text" id="q4" name="Personnel_1_update" value="<?=$old_person1?>">,
            <input type="text" name="Personnel_2_update" value="<?=$old_person2?>">,
            <input type="text" name="Personnel_3_update" value="<?=$old_person3?>">
            </p>

            <p  class="createexpform">
            <label for="q5">Parent Project</label>
            <select id="q5" name="p_project_update">
                <option value="<?=$old_parentproj?>"><?=$old_parentproj?></option>
                <?php
                $rec_sql = "SELECT name_sys FROM `projects`";
                $res=mysqli_query($conn, $rec_sql);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["name_sys"] . ">" . $row["name_sys"] . "</option>";
                }

            ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q6">Technical Performance Metric:</label>
            <input type="text" list="tpms" id="q6" name="tpm1_update" value="<?=$old_tpm1?>">,
            <input type="text" list="tpms" name="tpm2_update" value="<?=$old_tpm2?>">,
            <input type="text" list="tpms" name="tpm3_update" value="<?=$old_tpm3?>">
 
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
            <select id="q7" name="progress_state_update">
                <option value="<?=$old_progress?>"><?=$old_progress?></option>
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
            <select id="q8" name="p_requirements_update">
                <option value="<?=$old_parentreq?>"><?=$old_parentreq?></option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }

                ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q9">Child Requirements</label>
            <select id="q9" name="c_requirements_update">
                <option value="<?=$old_childreq?>"><?=$old_childreq?></option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `requirements`";
                $res=mysqli_query($conn, $rec_sql2);
                while ($row=mysqli_fetch_array($res)) {
                    echo "<option value=" . $row["Namedesc"] . ">" . $row["Namedesc"] . "</option>";

                }

                ?>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q10">Related Requirements</label>
            <select id="q10" name="r_requirements_update">
                <option value="<?=$old_relatedreq?>"><?=$old_relatedreq?></option>
                <?php
                $rec_sql2 = "SELECT Namedesc FROM `requirements`";
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
            <textarea style="resize: none;" id="q12" name="current_sol_update" rows="4" cols="100"><?=$old_currentsol?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q13">Deficiencies in Current Solution</label>
            <br>
            <textarea style="resize: none;" id="q13" name="defi_sol_update" rows="4" cols="100"><?=$old_currentdefi?></textarea>
            </p>

            <p  class="createexpform4">
            <label for="q14">Additional Critical-Path Work</label>
            <br>
            <textarea style="resize: none;" id="q14" name="crit_path_update" rows="4" cols="100"><?=$old_critpath?></textarea>
            </p>

            <p  class="createexpform3">
            <label for="q11">Comments</label>
            <br>
            <textarea style="resize: none;" id="q11" name="extradetail_update" rows="4" cols="100"><?=$old_comments?></textarea>
            </p>

            <input type='hidden' name='save_ID' value='<?=$tracker?>'>
            <input type="submit" value="Save">
        </form>

        <form method="POST" action="./deleteproj.php">
            <input type='hidden' name='ID_delete' value='<?=$tracker?>'>
            <input type="submit" value="Delete">
        </form>



        </form>
    </div>

</body>

<footer class="footer">
    <p><em>The original CUSF expenses system was written in 2009 by Henry Hallam and was updated by Tim Clifford in 2021.</em></p>
    <p>It was then rebuilt in 2022 to include management by Barty Wardell. You can email him <a id="email" href = "mailto: barty.wardell@gmail.com">here</a>.</p>
</footer>

</html>