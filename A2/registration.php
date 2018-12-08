<?php
session_start();
if (isset($_SESSION['sessionID'])){ //if user is already logged in then this page is not accessable
   header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/web/logo.png">
        <title>Registration</title>
        <link rel = "stylesheet" href = "css/registration.css">
        <script src ="js/registration-functionality.js"></script>
    </head>
    <body id = registerBody>
        <div id="register_panel">
            <h2><img id="logo" src="images/web/logo.png"/> Futureproof Registration for Premium Membership </h2>
                <div class = "RegisterFormBody" >
                    <form method = "POST" action="services/registration-functionality.php" id="registrationForm">
                            
                            <label>First Name*:</label> <input type= "text" name="firstName" id="firstName" placeholder = "First Name"> <br>
                            <label>Last Name*: </label><input type= "text" name="lastName" id="lastName" placeholder = "Last Name"> <br>
                            <label>Address: </label><input type= "text" name="address" id="address" placeholder = "Address"> <br>
                            <label>City*: </label><input type= "text" name="city" id="city" placeholder = "City"> <br>
                            <label>Region: </label><input type= "text" name="region" id="region" placeholder = "Region"> <br>
                            <label>Country*: </label><input type="text" name="country" id="country" placeholder = "Country"> <br>
                            <label>Postal Code: </label><input type= "text" name="postal" id="postal" id="postal" placeholder = "Postal Code"> <br>
                            <label> E-mail*:</label> <input type="email" name="e-mail" id="email" placeholder = "abc@abc.com"> <br>
                            <label> Phone#:</label> <input type="tel" name="phone" id="phone" placeholder = "Phone#"> <br>
                            <label> Password*: </label><input type="password" name="password" id="password" placeholder = "Password Max 6 Characters"><br>
                            <label> Re-Enter Password*: </label> <input type="password" name="verifyPassword" id="verifyPassword"  placeholder = "Verify Password"> <br>
                            <input type="submit" value="SIGN UP" id="signUp" name="signUp">
                            <button id="cancel" type="button">Cancel</button>
                            <p id="error"></p>
                            <p id="eError"></p>
                            <p id="pError"></p>
                            <p id="fError"></p>
                            <?php
                                //if email already exist error is present 
                                if (isset($_SESSION['messageExist'])){ //show msg
                                    $msg = $_SESSION['messageExist'];
                                    echo "<p id='emailExist'>$msg</p>";
                                }
                            ?>

                    </form>
               
                </div>
        </div>
    </body>
</html>