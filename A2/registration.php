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
                    <form method = "GET" action="" id="registrationForm">

                            <label>First Name:</label> <input type= "text" name="firstName" id="firstName" placeholder = "First Name"> <br>
                            <label>Last Name: </label><input type= "text" name="lastName" id="lastName" placeholder = "Last Name"> <br>
                            <label>City: </label><input type= "text" name="city" id="city" id=city placeholder = "City"> <br>
                            <label>Country: </label><input type="text" name="country" id="country" placeholder = "Country"> <br>
                            <label> E-mail:</label> <input type="text" name="e-mail" id="email" placeholder = "abc@abc.com"> <br>
                            <label> Password: </label><input type="password" name="password" id="password" placeholder = "Password"><br>
                            <label> Re-Enter Password: </label> <input type="password" name="verifyPassword" id="verifyPassword"  placeholder = "Verfiy Password"> <br>
                            <input type="submit" value="SIGN UP" id="signUp" name="signUp">
                            <button id="cancel" type="button">Cancel</button>
                            <p id='error' style = "color: red"></p>
                            <p id="eError" style = "color: red"></p>

                    </form>
               
                </div>
        </div>
    </body>
</html>