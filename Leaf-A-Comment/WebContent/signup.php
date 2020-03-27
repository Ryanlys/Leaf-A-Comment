<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        echo "error";
        exit();
    } else{
        echo "Connected! \n";
    }
    
    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    
    $exist=false;
    
    $sql = "SELECT username FROM users";
    
    if($result = $mysqli -> query($sql)){
        while($fieldinfo = $result -> fetch_field()){
            $a = $fieldinfo -> username;
            if ($a == $username){
                $exist=true;
                echo "username taken, try again";
            }
        }
        $result -> free_result();
    } else
        echo "something's wrong...";
        
    
    if (!$exist && $stmt = $mysqli -> prepare("INSERT INTO users(firstname, lastname, username, email, passwoerd) VALUES (?, ?, ?, ?, ?)")){
        
        $stmt -> bind_param("sssss",$firstname, $lastname, $username, $email, $password);
        $stmt -> execute();
        echo "We got you ".$firstname. " !";
        $stmt -> close();
    } else
        echo "failure to add you :(";
    
    $mysqli -> close();

?>

</body>
</html>

