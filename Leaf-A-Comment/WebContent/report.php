<?php 
    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    }
    
    $sql = "SELECT * FROM report";
    $data = array();
    
    if($result = $mysqli -> query($sql)){
        
        while($fieldinfo = $result -> fetch_assoc()){

            array_push($data, $fieldinfo);
            
        } $result -> free_result();
    }
    
    echo json_encode($data);
    exit();
    
?>
