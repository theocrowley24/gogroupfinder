<?php
//Written by Theo Crowley
//http://theocrowley.com/

deleteOld();

function deleteOld(){
    //Database params
    //Insert your own
    $servername = "";
    $username = "";
    $password = "";
    $dbname = "";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
        
    // Check connection
    if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM raids WHERE `unix` < (UNIX_TIMESTAMP() - 7200);";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}

?>

