<?php
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
    $date_proj_ru = $_POST['date_r_update'];
    $name_rupd = $_POST['Name_r_update'];
    $ids_rupd = $_POST['_ID_r_update'];

    $essential1_rupd = $_POST['essential1'];
    $essential2_rupd = $_POST['essential2'];
    $essential3_rupd = $_POST['essential3'];

    $desirable1_rupd = $_POST['desirable1'];
    $desirable2_rupd = $_POST['desirable2'];
    $desirable3_rupd = $_POST['desirable3'];

    $preferable1_rupd = $_POST['preferable1'];
    $preferable2_rupd = $_POST['preferable2'];
    $preferable3_rupd = $_POST['preferable3'];

    $sysi1_rupd = $_POST['sysi1'];
    $sysi2_rupd = $_POST['sysi2'];
    $sysi3_rupd = $_POST['sysi3']; 
    
    $perfval1_rupd = $_POST['perfval1'];
    $perfval2_rupd = $_POST['perfval2'];
    $perfval3_rupd = $_POST['perfval3']; 

    $intpro1_rupd = $_POST['intpro1'];
    $intpro2_rupd = $_POST['intpro2'];
    $intpro3_rupd = $_POST['intpro3'];

    $failerror1_rupd = $_POST['failerrorhandle1'];
    $failerror2_rupd = $_POST['failerrorhandle2'];
    $failerror3_rupd = $_POST['failerrorhandle3'];

    $designdocu1_rupd = $_POST['designdocu1'];
    $designdocu2_rupd = $_POST['designdocu2'];
    $designdocu3_rupd = $_POST['designdocu3'];

    $funcdocu1_rupd = $_POST['funcdocu1'];
    $funcdocu2_rupd = $_POST['funcdocu2'];
    $funcdocu3_rupd = $_POST['funcdocu3']; 

    $opspro1_rupd = $_POST['opspro1'];
    $opspro2_rupd = $_POST['opspro2'];
    $opspro3_rupd = $_POST['opspro3'];

    //Now look who is good at SQL, TC? - BW
    $sql_r = "INSERT INTO requirements (dateval, Namedesc , sys_id, desirable_1, desirable_2, desirable_3, essential_1, essential_2, essential_3, preferable_1,
    preferable_2, preferable_3, sysint_1, sysint_2, sysint_3, perfvals_1, perfvals_2, perfvals_3, intproc_1, intproc_2, intproc_3, failmodes_1, 
    failmodes_2, failmodes_3, designdocu_1, designdocu_2, designdocu_3, funcdocu_1, funcdocu_2, funcdocu_3, opsproc_1, opsproc_2, opsproc_3) 
   VALUES ('$date_proj_r', '$name_r', '$ids_r', '$essential1_r', '$essential2_r', '$essential3_r', '$desirable1_r', '$desirable2_r', '$desirable3_r', '$preferable1_r', 
      '$preferable2_r', '$preferable3_r', '$sysi1_r', '$sysi2_r','$sysi3_r','$perfval1_r', '$perfval2_r', '$perfval3_r', '$intpro1_r', '$intpro2_r', '$intpro3_r',
     '$failerror1_r', '$failerror2_r', '$failerror3_r', '$designdocu1_r', '$designdocu2_r', '$designdocu3_r', '$funcdocu1_r', '$funcdocu2_r', '$funcdocu3_r', 
     '$opspro1_r', '$opspro2_r', '$opspro3_r')";
    if (mysqli_query($conn1, $sql_r)) {
        $result = "New record created successfully";
        header( "refresh:1;url=./projects.php" );
    }
    else {
        $result =  "Error: " . $sql . "<br>" . mysqli_error($conn2);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
</html>