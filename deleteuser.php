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
    include("auth_session.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $ID_delete = $_POST['ID_delete'];
        $rec_del = "DELETE FROM `users`" ."WHERE ID='" . $ID_delete . "'";
        if (mysqli_query($conn, $rec_del)) {
            $result = "Successfully Deleted";
            header( "refresh:1;url=./users.php" );
        }
        else {
            $result =  "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
?>