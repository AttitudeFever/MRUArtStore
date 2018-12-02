<?php
session_start();
require_once ('../includes/db-connection.php');

    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

        $userName = $_POST['username'];
        $password = $_POST['password']; 
        

        $salt = getSalt($userName);
        $digest = md5($password . $salt);
        
        $hashed_pass = getDigest($userName, $digest);
        
        if ($hashed_pass == $digest){
            $customerID = getCustomerID($userName, $digest);
            $clientName = getClientName($customerID);
            $_SESSION['sessionID'] = $customerID;
            $_SESSION['customerName'] = $clientName;
            header('Location: ../index.php');
        }else{
            header("Location: {$_SERVER['HTTP_REFERER']}");
        }
    }

    function getSalt($userName){
        
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sth = $pdo->prepare("SELECT salt FROM CustomerLogon WHERE UserName = ?");
        $sth->bindValue(1,$userName,PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch();
        return $result[0];
        $pdo =null;
    }
    
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