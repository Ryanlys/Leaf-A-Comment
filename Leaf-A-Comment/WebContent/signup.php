<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $_SESSION["loggedIn"] = false;
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        //echo "error \n";
        exit();
    } else{
        //echo "Connected! \n";
    }
    
    $firstname = $_REQUEST["firstname"];
    $lastname = $_REQUEST["lastname"];
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $password = $_REQUEST["password"];
    
    $header = "Location: login.html";
    
    if ($stmt = $mysqli -> prepare("INSERT INTO users(firstname, lastname, username, email, passwoerd) VALUES (?, ?, ?, ?, ?)")){
        
        $stmt -> bind_param("sssss",$firstname, $lastname, $username, $email, $password);
        $stmt -> execute();
        echo "We got you ".$firstname. " !";
        $stmt -> close();
        
        $_SESSION["loggedIn"] = true;
        
    } 
    
    if ($_SESSION["loggedIn"] == false)
        $header = "Location: signup.html";;
    
    $mysqli -> close();
    
    header($header); 

?>

</body>
</html>

