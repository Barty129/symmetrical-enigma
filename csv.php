<?php 
 
// Load the database configuration file 
require('db.php');
include("auth_session.php");
 
// Fetch records from database 
$query = "SELECT * FROM projects ORDER BY dateval"; 
$result = mysqli_query($conn, $query);
$num_rows = mysqli_num_rows($result);
 
if($num_rows > 0){ 
    $delimiter = ","; 
    $filename = "ProjectMaster_" . date('d-m-Y') . ".csv"; 
     
    // Create a file pointer 
    $f = fopen('php://memory', 'w'); 
     
    // Set column headers 
    $fields = array('System Name', 'System Code', 'Key Personnel 1', 'Key Personnel 2', 'Key Personnel 3', 'Progress Level'); 
    fputcsv($f, $fields, $delimiter); 
     
    // Output each row of the data, format line as csv and write to file pointer
    while($row = mysqli_fetch_assoc($result)){ 
        $lineData = array($row['name_sys'], $row['system_id'], $row['personnel_1'], $row['personnel_2'], 
        $row['personnel_3'], $row['progress']); 
        fputcsv($f, $lineData, $delimiter); 
    } 
     
    // Move back to beginning of file 
    fseek($f, 0); 
     
    // Set headers to download file rather than displayed 
    header('Content-Type: text/csv'); 
    header('Content-Disposition: attachment; filename="' . $filename . '";'); 
     
    //output all remaining data on a file pointer 
    fpassthru($f); 
} 
exit; 
 
?>

<!DOCTYPE html>
<html lang="en">

</html>