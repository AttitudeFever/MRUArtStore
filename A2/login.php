<?php 
    include('php/nav-bar.inc.php');
?>
<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <title>Login</title>
        <link rel = "stylesheet" href = "css/login.css">
        <script src =""></script>
    </head>
    <body id = "logBody">
        <div id="navigation">
                <?php createNavBar(); ?>
        </div>
        <h2>Login</h2>
        <form method = "GET" action = "php/form-functionality.inc.php" id="logForm">
            <div class = "box" >
                <label class = "formText"><b>Email</b></label><br>
                <input = "email" placeholder = "Enter Email" required id ="inEmail"> <br>
                <label class = "formText"><b>Password</b></label><br>
                <input = "password" placeholder = "Enter Password" required id = "inPass"><br>
                <input type="submit" value="Login" id="loginbtn">
                <!--<button = "button" id ="cancel">Cancel</button> --> <!-- Chris ask me why I did that -->
                <a href="index.php" id="cancel">Cancel</a>
            </div>
            
            <div id = "bot">
                <br>
                <p>
                <a href = "registration.php">Register</a>
                <span></span>
                <a href = "#">Forgot Password?</a> 
                
                </p> 
                
            </div>
        </form>
        
    </body>
</html>