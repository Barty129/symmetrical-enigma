<?php 
    $date = date('d-m-Y');
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
        $ID_delete = $_POST['ID_delete'];
        $rec_del = "DELETE FROM `requirements`" ."WHERE ID='" . $ID_delete . "'";
        if (mysqli_query($conn, $rec_del)) {
            $result = "Successfully Deleted";
            header( "refresh:1;url=./projects.php" );
        }
        else {
            $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

?>