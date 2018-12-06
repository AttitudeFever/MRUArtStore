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
        addToCustomer($fName, $lName, $address, $city, $region, $country, $postal, $phone, $email);
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

function addToCustomer($fName, $lName, $address, $city, $region, $country, $postal, $phone, $email)
{
    $privacy =1;
    $clientID =55;
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO Customers (CustomerID, FirstName, LastName, Address, City, Region, Country, Postal, Phone, Email, Privacy)";
    $sql .= " VALUES ($clientID, '$fName', '$lName', :Address, '$city', :Region, '$country', :Postal, :Phone, '$email', $privacy)";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':Address',!empty($address) ? $address : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Region',!empty($region) ? $region : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Postal',!empty($postal) ? $postal : NULL, PDO::PARAM_STR);
    $sth->bindValue(':Phone',!empty($phone) ? $phone : NULL, PDO::PARAM_INT);
    $sth->execute();
    $pdo =null;
}


?>