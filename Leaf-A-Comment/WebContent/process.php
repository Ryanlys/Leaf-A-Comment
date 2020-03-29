<?php 

    session_start();
    
    $_SESSION["loggedIn"] = false;
    $exist = false;
    $finished = false;
    
    $mysqli = new mysqli("localhost", "root","", "test");
    
    $username = "";
    $email = "";
    $firstname = "";
    $lastname = "";
    $password = "";
    
    if($mysqli -> connect_errno){
        echo "<script type='text/javascript'>alert('error');</script>";
        exit();
    } 
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        if (isset($_POST["username"])){
            
            $sql = "SELECT username FROM users";
            
            if($result = $mysqli -> query($sql)){
                
                while($fieldinfo = $result -> fetch_field()){
                    
                    $a = $fieldinfo -> username;
                    
                    if (strcasecmp($a, $username)!= 0){
                        
                        $exist = true;
                    
                    }
                } $result -> free_result();
            }
        }   
        
        else if($exist == false && isset($_POST['signup'])) {
        
            $username = $_POST["username"];
            $email = $_POST["email"];
            $firstname = $_POST["firstname"];
            $lastname = $_POST["lastname"];
            $password = $_POST["password"];
        
            if ($stmt = $mysqli -> prepare("INSERT INTO users(firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)")){
            
                $stmt -> bind_param("sssss",$firstname, $lastname, $username, $email, $password);
                $stmt -> execute();
                $stmt -> close();
                
                $_SESSION["loggedIn"] = true;
                $finished = true;
            }
        }
    }
    
    $mysqli -> close();
    
    if($finished == true){
        header("Location: login.html");
        exit();
    }
    
    

?>
