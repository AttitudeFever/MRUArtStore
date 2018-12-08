<?php
session_start();
require_once ('../includes/db-connection.php'); //db connection package
    
    //check if login request asked and username and pass is not null
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        $userName = $_POST['username']; //acquire username
        $password = $_POST['password']; //acquire pass
        

        $salt = getSalt($userName); //acqure salt for that user using method getSalt
        $digest = md5($password . $salt); //generate digest for that pass user entered through md5
        
        $hashed_pass = getDigest($userName, $digest); //acquire actual digest exisit on db for that username using helper method getDigest
        
        //when generated digest and acual digest from db matches login conditions are met
        if ($hashed_pass == $digest){ 
            $customerID = getCustomerID($userName, $digest); //acquire customer ID for that customer from db using helper method getCustomerID
            $clientName = getClientName($customerID); //acquire customer name from db using helper method getClientName
            $_SESSION['sessionID'] = $customerID; //create a unique login in session for that customer using their unique customer ID
            $_SESSION['customerName'] = $clientName; //customer name is saved in a global login session
            if (isset($_SESSION['message'])){ //login fail message if exists remove it 
                unset($_SESSION['message']);
            }
            header('Location: ../index.php');
        }else{ //invaid user name pass message is stored in global session when login fail happens
            $_SESSION['message'] = "Invalid Username or Password, please try again !";  //create login fail message
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }


    //helper method to get salt for that user
    //@param username is the username of the customer
    function getSalt($userName){
        
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sth = $pdo->prepare("SELECT salt FROM CustomerLogon WHERE UserName = ?");
        $sth->bindValue(1,$userName,PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result[0];
        $pdo =null;
    }
    
    //helper method to get digest for that user from db
    //@param username is the username of the customer, $digest is the gebrated digest for that user
    function getDigest($userName, $digest){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sth = $pdo->prepare("SELECT Pass FROM CustomerLogon WHERE UserName = ? AND Pass = ?");
        $sth->bindValue(1,$userName,PDO::PARAM_STR);
        $sth->bindValue(2,$digest,PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result[0];
        $pdo =null;
    }
    
    //helper method to get ID for that user
    //@param username is the username of the customer, $digest is the gebrated digest for that user
    function getCustomerID($userName, $digest){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sth = $pdo->prepare("SELECT CustomerID FROM CustomerLogon WHERE UserName = ? AND Pass = ?");
        $sth->bindValue(1,$userName,PDO::PARAM_STR);
        $sth->bindValue(2,$digest,PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result[0];
        $pdo =null;
    }
    
    //helper method to get name for that user
    //@param username is the username of the customer
    function getClientName($customerID){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sth = $pdo->prepare("SELECT FirstName FROM Customers 
        INNER JOIN CustomerLogon ON Customers.CustomerID = CustomerLogon.CustomerID
        WHERE Customers.CustomerID = $customerID");
        $sth->execute();
        $result = $sth->fetch();
        return $result[0];
        $pdo =null;
    }
 
?>