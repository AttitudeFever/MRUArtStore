
<!DOCTYPE html>
<html lang = "eng">
    <head>
        <meta charset ="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel = "stylesheet" href = "css/login.css">
        <script src ="js/login-functionality.js"></script>
    </head>
    <body id = "loginBody">
        <div id="login_panel">
        <h2>Futureproof Premium Members Login <img id="logo" src="images/logo.png"/></h2>
        <div class = "formBody" >
            <img src="images/web/login-avtar.png" alt="Avatar" class="avatar" height="200" width="200"><br>
            <form method = "GET" action = "php/form-functionality.inc.php" id="loginForm">
                <div class="upperForm">
                    <label><b>Username</b></label><br>
                    <input type="text" placeholder = "Enter Username" name ="username" required><br>
                    <label><b>Password</b></label><br>
                    <input type= "password" placeholder = "Enter Password" name="password" required><br>
                    <button type="submit">Login</button><br>
                    <input type="checkbox" checked="checked" name="remember"> Remember me<br>
                </div>
                <div class = "bottomForm">
                    <button id="cancel" type="button">Cancel</button>
                    <span><a href = "#">Forgot Password?</a></span><br>
                    <span><a href = "registration.php">Register</a></span>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>