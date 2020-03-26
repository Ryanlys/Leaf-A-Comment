<?php

    $servername = "localhost";
    $dbUsername = "root";
    $password = "";
    $dbName = "test";
    
    $conn = mysqli_connect($servername,$dbUsername,$password,$dbName);
    
    if($conn)
    {
        echo "Connection successful \n";
    }
    else
    {
        die("Connection failed: ".mysqli_connect_error());
    }

?>