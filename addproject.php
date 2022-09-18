<?php 
    $date = date('d-m-Y');
    $servername = "localhost";
    $database = "cusf_test";
    $username = "root";
    // Create connection
    $conn1 = mysqli_connect($servername, $username, "", $database);
    // Check connection
    if (!$conn1) {
      die("Connection failed: " . mysqli_connect_error());
    }
 
    $connection = "Connected successfully";
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
            $res=mysqli_query($conn1, $rec_sql);
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
            $res=mysqli_query($conn1, $rec_sql2);
            while ($row=mysqli_fetch_array($res)) {
                echo "<tr>\n";
                echo "\t<td>".$row["dateval"]."</td>\n";
                echo "\t<td>".$row["Namedesc"]."</td>\n";
                echo "\t<td>".$row["sys_id"]."</td>\n";
                echo "</tr>\n";
            }

            mysqli_close($conn1);
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
        <form class="createexpform" method="POST" action="./projects.php" id="projectform">
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
            <input type="text" id="q4" name="Personnel_1">,
            <input type="text" name="Personnel_2">,
            <input type="text" name="Personnel_3">
            </p>

            <p  class="createexpform">
            <label for="q5">Parent Project</label>
            <select id="q5" name="p_project">
                <option value="blank">----</option>
                <option value="Sample Project">Sample Project</option>
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
                <option value="Sample Requirements_p">Sample Requirements</option>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q9">Child Requirements</label>
            <select id="q9" name="c_requirements">
                <option value="blank">----</option>
                <option value="Sample Requirements_c">Sample Requirements</option>
            </select>
            </p>

            <p  class="createexpform">
            <label for="q10">Related Requirements</label>
            <select id="q10" name="r_requirements">
                <option value="blank">----</option>
                <option value="Sample Requirements_r">Sample Requirements</option>
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
            <label for="q11">Comments</label>
            <br>
            <textarea style="resize: none;" id="q11" name="extradetail" rows="4" cols="100"></textarea>
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
