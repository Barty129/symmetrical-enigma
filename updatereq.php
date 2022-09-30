<?php
$servername = "localhost";
$database = "cusf_test";
$username = "root";
// Create connection
$conn = mysqli_connect($servername, $username, "", $database);
// Check connection
if (!$conn) {
      die("connection failed: " . mysqli_connect_error());
}
 
$connection = "connected successfully";
include("auth_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $update_select = $_POST['save_ID'];

    $date_proj_rupd = $_POST['date_r_update'];
    $name_rupd = $_POST['Name_r_update'];
    $ids_rupd = $_POST['_ID_r_update'];
    $relap_rupd = $_POST['rela_project_update'];
    $user_rupd = $_POST['Personnel_1_update'];

    $essential1_rupd = $_POST['essential1_update'];
    $essential2_rupd = $_POST['essential2_update'];
    $essential3_rupd = $_POST['essential3_update'];

    $desirable1_rupd = $_POST['desirable1_update'];
    $desirable2_rupd = $_POST['desirable2_update'];
    $desirable3_rupd = $_POST['desirable3_update'];

    $preferable1_rupd = $_POST['preferable1_update'];
    $preferable2_rupd = $_POST['preferable2_update'];
    $preferable3_rupd = $_POST['preferable3_update'];

    $sysi1_rupd = $_POST['sysi1_update'];
    $sysi2_rupd = $_POST['sysi2_update'];
    $sysi3_rupd = $_POST['sysi3_update']; 
    
    $perfval1_rupd = $_POST['perfval1_update'];
    $perfval2_rupd = $_POST['perfval2_update'];
    $perfval3_rupd = $_POST['perfval3_update']; 

    $intpro1_rupd = $_POST['intpro1_update'];
    $intpro2_rupd = $_POST['intpro2_update'];
    $intpro3_rupd = $_POST['intpro3_update'];

    $failerror1_rupd = $_POST['failerrorhandle1_update'];
    $failerror2_rupd = $_POST['failerrorhandle2_update'];
    $failerror3_rupd = $_POST['failerrorhandle3_update'];

    $designdocu1_rupd = $_POST['designdocu1_update'];
    $designdocu2_rupd = $_POST['designdocu2_update'];
    $designdocu3_rupd = $_POST['designdocu3_update'];

    $funcdocu1_rupd = $_POST['funcdocu1_update'];
    $funcdocu2_rupd = $_POST['funcdocu2_update'];
    $funcdocu3_rupd = $_POST['funcdocu3_update']; 

    $opspro1_rupd = $_POST['opspro1_update'];
    $opspro2_rupd = $_POST['opspro2_update'];
    $opspro3_rupd = $_POST['opspro3_update'];

    $last_user_upds = $_POST['last_user_upd'];
    $last_changed_upds = $_POST['last_time_upd'];
    $change_comments_upds = $_POST['change_comments_upd'];



    $sql_update = "UPDATE `requirements` SET dateval='$date_proj_rupd', Namedesc='$name_rupd', sys_id='$ids_rupd', Related_project='$relap_rupd', personName='$user_rupd', desirable_1='$desirable1_rupd', desirable_2='$desirable2_rupd', desirable_3='$desirable3_rupd',
        essential_1='$essential1_rupd', essential_2='$essential2_rupd', essential_3='$essential3_rupd', preferable_1='$preferable1_rupd', preferable_2='$preferable2_rupd', preferable_3='$preferable3_rupd', 
        sysint_1='$sysi1_rupd', sysint_2='$sysi2_rupd', sysint_3='$sysi3_rupd', perfvals_1='$perfval1_rupd', perfvals_2='$perfval2_rupd', perfvals_3='$perfval3_rupd', 
        intproc_1='$intpro1_rupd', intproc_2='$intpro2_rupd', intproc_3='$intpro3_rupd', failmodes_1='$failerror1_rupd', failmodes_2='$failerror2_rupd', failmodes_3='$failerror3_rupd',
        designdocu_1='$designdocu1_rupd', designdocu_2='$designdocu2_rupd', designdocu_3='$designdocu3_rupd', funcdocu_1='$funcdocu1_rupd', funcdocu_2='$funcdocu2_rupd', 
        funcdocu_3='$funcdocu3_rupd', opsproc_1='$opspro1_rupd', opsproc_2='$opspro2_rupd', opsproc_3='$opspro3_rupd', last_editor='$last_user_upds', last_edited='$last_changed_upds', change_comments='$change_comments_upds'
         " . " WHERE ID='" . $update_select . "'";
    //Now look who is good at SQL, TC? - BW
    if (mysqli_query($conn, $sql_update)) {
        $result = "Record Updated";
        header( "refresh:2;url=./projects.php" );
    }
    else {
        $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
</html>