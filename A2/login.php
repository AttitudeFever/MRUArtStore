<?php
session_start();

if (isset($_SESSION['sessionID'])){ //if user is already login then this page is not accessable
   header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Login</title>
        <link rel = "stylesheet" href = "css/login.css">
        <script src ="js/login-functionality.js"></script>
    </head>
    <body id = "loginBody">
        <div id="login_panel">
        <h2>Futureproof Premium Members Login <img id="logo" src="images/web/logo.png"/></h2>
        <div class = "formBody" >
            <img src="images/web/login-avtar.png" alt="Avatar" class="avatar" height="200" width="200"><br>
            <form method = "post" action = "services/login-functionality.php" id="loginForm">
                <div class="upperForm">
                    <label><b>Username</b></label><br>
                    <input type="text" placeholder = "Enter Email" name ="username" required><br>
                    <label><b>Password</b></label><br>
                    <input type= "password" placeholder = "Enter Password" name="password" required><br>
                    <button type="submit" value="login" name="login">Login</button><br>
                </div>
                <div class = "bottomForm">
                    <button id="cancel" type="button">Cancel</button>
                    <span><a href = "#">Forgot Password?</a></span><br>
                    <span><a href = "registration.php">Register</a></span>
                    <?php 
                        //check if login error msg exist 
                        if (isset($_SESSION['message'])){ //show login error msg
                            $errormsg = $_SESSION['message'];
                            echo "<p id='errormsg'>$errormsg</p>";
                        }
                    ?>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>