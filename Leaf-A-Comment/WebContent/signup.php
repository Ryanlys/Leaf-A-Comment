<!DOCTYPE html>
<html>
<body>

<?php 

    session_start();
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    if($mysqli -> connect_errno){
        die("Connection failed: " . $mysqli->connect_error);
    } 
    
    $firstname = "";
    $lastname = "";
    $username = "";
    $email = "";
    $password = "";
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (isset($_POST["username"]) && isset($_POST["password"])){
            
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $username = $_POST["username"];
   
            /*echo "firstname: " .$firstname;
            echo "lastname: " .$lastname;
            echo "username: " .$username;
            echo "email: " .$email;
            echo "password: " .$password;*/
            
        }
    }
    
    $header = "Location: login.html";
    $registered = false;
    
    if ($stmt = $mysqli -> prepare("INSERT INTO users(firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?);")){
        
        $stmt -> bind_param("sssss",$firstname, $lastname, $username, $email, $password);
        $stmt -> execute();
        $stmt -> close();
        $registered = true;
        
    } else {
        echo "whoops... ".mysqli_error($mysqli);
    }
    
    if (!$registered){
        $header = "Location: signup.html";
    } 
    
    $mysqli -> close();
    
    header($header); 

?>

</body>
</html>

