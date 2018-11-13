<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration</title>
        <link rel = "stylesheet" href = "css/registration.css">
        <script src ="js/registration-functionality.js"></script>
    </head>
    <body id = registerBody>
        <div id="register_panel">
            <h2>Futureproof Registration for Premium Membership <img id="logo" src="images/logo.png"/></h2>
                <div class = "RegisterFormBody" >
                    <form method = "GET" action="" id="registrationForm">

                            <label>First Name:</label> <input type= "text" name="firstName" id="firstName"> <br>
                            <label>Last Name: </label><input type= "text" name="lastName" id="lastName"> <br>
                            <label>City: </label><input type= "text" name="city" id="city" id=city> <br>
                            <label>Country: </label><input type="text" name="country" id="country"> <br>
                            <label> E-mail:</label> <input type="text" name="e-mail" id=email> <br>
                            <label> Password: </label><input type="text" name="password" id=password><br>
                            <input type="submit" value="Sign up">
                            <button id="cancel" type="button">Cancel</button>

                    </form>
                </div>
        </div>
    </body>
</html>