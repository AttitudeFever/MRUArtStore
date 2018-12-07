<?php
session_start();
require_once('../includes/db-connection.php');

if(isset($_POST['signUp']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['e-mail']) && !empty($_POST['password'])) 
{
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    if ($_POST['address'] !=null){
        $address = $_POST['address'];
    }else{
        $address="";
    }
    $city = $_POST['city'];
    if ($_POST['region'] !=null){
        $region = $_POST['region'];
    }else{
        $region="";
    }
    $country = $_POST['country'];
    if ($_POST['postal'] !=null){
        $postal = $_POST['postal'];
    }else{
        $postal ="";
    }
    $email = $_POST['e-mail'];
    if ($_POST['phone'] !=null){
        $phone = $_POST['phone'];
    }else{
        $phone ="";
    }
    $password = $_POST['password'];
    
    if (EmailExistance($email)){
        $_SESSION['messageExist'] = "'$email' Already Exists in our system, please use another Email ID for registring this account, or "."<a href='login.php'>Login</a>"." with '$email'";
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }else{
        if (isset($_SESSION['messageExist'])){
            unset($_SESSION['messageExist']);
        }
        $customerID = createCustomerID();
        addToCustomer($customerID, $fName, $lName, $address, $city, $region, $country, $postal, $phone, $email);
        
        $salt = saltGen(32);
        $digest = md5($password . $salt);
        addToCustomerLogon($customerID, $email, $digest, $salt);
        
        header('Location: registration_success.php');
    }
}

function EmailExistance($email)
{
    $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
    $sth = $pdo->prepare("SELECT Email FROM Customers");
    $sth->execute();
    while ($result = $sth->fetch()) {  
        $Email_List[] = $result['Email'];
    }
    $pdo =null;
    return in_array($email, $Email_List);
}

function createCustomerID()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT MAX(CustomerID) FROM Customers";
    $sth = $pdo->prepare($sql);
    $sth->execute();
    $result = $sth->fetch();
    $pdo = null; 
    return $result[0]+1;
}

function addToCustomer($customerID, $fName, $lName, $address, $city, $region, $country, $postal, $phone, $email)
{
    $privacy =1; //assume, no explanation is given in assingment
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO Customers (CustomerID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy)";
    $sql .= " VALUES ('$customerID', '$fName', '$lName', :Address, '$city', :Region, '$country', :Postal, :Phone, '$email', '$privacy')";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':Address',!empty($address) ? $address : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Region',!empty($region) ? $region : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Postal',!empty($postal) ? $postal : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Phone',!empty($phone) ? $phone : NULL, PDO::PARAM_INT);
    $sth->execute();
    $pdo =null;
}

function saltGen($length){ 
    $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $charsLength = strlen($characters) -1;
    $string = "";
    for($i=0; $i<$length; $i++){
        $randNum = mt_rand(0, $charsLength);
        $string .= $characters[$randNum];
    }
    return $string;
}

function addToCustomerLogon($customerID, $email, $digest, $salt)
{
    $state =1; //assume, no explanation is given in assingment
    $dateJoined=date("Y-m-d");
    $dateLastModified=date("Y-m-d");
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO CustomerLogon (CustomerID, UserName, Pass, Salt, State, DateJoined, DateLastModified)";
    //$sql .= " VALUES ('$customerID', '$email', '$digest', '$salt', '$state', '$dateJoined', '$dateLastModified')";
    $sql .= " VALUES ('$customerID', :UserName, :Pass, :Salt, '$state', '$dateJoined', '$dateLastModified')";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':UserName',$email, PDO::PARAM_STR);
    $sth->bindValue(':Pass',$digest, PDO::PARAM_STR);
    $sth->bindValue(':Salt',$salt, PDO::PARAM_STR);
    $sth->execute();
    $pdo =null;
}


?>