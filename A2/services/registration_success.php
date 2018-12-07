<?php 
session_start();
if (isset($_SESSION['sessionID'])){
   header('Location: index.php');
}

header( "refresh:2;url=../login.php" );

?>

<!DOCTYPE html>

<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <link rel = "stylesheet" href = "../css/registration_success.css">
       
    </head>
    <body id = "successBody">
         <div id="successBox">
             <p>Registration Successful, you are now Premium Member of Futureproof Art Store</p>
             <img src='../images/web/success.png' id="success" alt='Registration Successful'/>
            <p id="loadingPara">Redirecting to login page <img src='../images/web/loading2.gif' id="loading" alt-'loading'/></p>
           <p>If the page dosent automatically redirect, you can <a href="login.php">Click Here</a> to Login</p>
        </div>
    </body>
</html>
    
