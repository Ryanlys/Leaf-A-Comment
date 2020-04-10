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
            if (isset($_POST["pic"])){
                $profilepicture = $_FILES["pic"]["name"];
            } else {
                $profilepicture = "default.png";
            }
            
        }
    }
    
    $header = "Location: login.html";
    $registered = false;
    
    if ($stmt = $mysqli -> prepare("INSERT INTO users(firstname, lastname, username, email, password, pp) VALUES (?, ?, ?, ?, ?,?);")){
        
        $stmt -> bind_param("ssssss",$firstname, $lastname, $username, $email, $password, $profilepicture);
        $stmt -> execute();
        $stmt -> close();
        $registered = true;
        
    } 
    
    if ($_FILES["pic"]["error"] > 0)
    {
        echo "Error: " . $_FILES["pic"]["error"] . "<br>";
    }
    else
    {
        if (!file_exists("images\\userimg\\".$_FILES["pic"]["name"]))
        {
            move_uploaded_file($_FILES["pic"]["tmp_name"], "images\\userimg\\".$_FILES["pic"]["name"]);
        }
        
    }
    
    if (!$registered){
        $header = "Location: signup.html";
    } 
    
    $mysqli -> close();
    
    header($header); 

?>

</body>
</html>