<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" href="css/reset.css">
<link rel="stylesheet" href="css/forall.css">
<link rel="stylesheet" href="css/login.css">
<script type="text/javascript">
     function validateForm(){
        
        var e = document.resetPassword.pass.value;
        var f = document.resetPassword.pass2.value;
        
        if(e != f){
            alert("passwords don't match, please retype, thanks!");
            return false;
        } else{
            return true;
        }
    }
</script>
<title>Password Reset</title>
</head>
<body>
    <header id="top">
    
        <img id="logo" alt="whoops" src="images/logo.png">
        
        <form id="search" method="get" action="search.php">
            <input type="text" name="search" placeholder="type in keyword"><button type="submit">search</button>
        </form>
        
        <nav>
            <ul>
                <li class="navButton"><a href="main.php"><button>Home</button></a></li>
            </ul>
        </nav>
        
    </header>

    <main>
        <h1>Hi, please reset your password</h1>
        <form name='resetPassword' method='post' action='resetPassword.php' onSubmit='return validateForm()'>
            <fieldset>
                <p id='password'>
                    <label>Password:</label>
                    <input id='pw' type='password' name='pass' pattern = '([A-z0-9]){7,14}' placeholder='enter 7-14 characters' required>
                    <br><br>
                    <label>Re-enter Password:</label>
                    <input id='pw2' type='password' name='pass2' pattern = '([A-z0-9]){7,14}' placeholder='enter 7-14 characters' required>
                    <input type="hidden" name = "uid" value=<?php $a = $_REQUEST["id"]; echo "'$a'";?>>
                </p>
                <?php
                    $uid = $_REQUEST["id"];
                    if ($uid == $_SESSION["reset"])
                    {
                        echo "<button type='submit'>Reset</button>";
                    }
                    else
                    {
                        echo "<h1> Hi, please do not do this. :) </h1>";
                    }
                ?>
            </fieldset>
        </form>
    </main>
    
    <footer>
        <nav>
            <ul>
                <li class="navButton"><a href="main.html">Home</a></li>
                <li class="navButton"><a href="account.html">Account</a></li>
                <li class="navButton"><a href="login.html">Log In</a></li>
            </ul>
        </nav>
        <p>2020 &copy; Leaf A Comment</p>
        <a href="#top">back to top</a></span></p>
    </footer>

</body>
</html>
