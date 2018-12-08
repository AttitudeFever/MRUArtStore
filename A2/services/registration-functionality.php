<?php
session_start();
require_once('../includes/db-connection.php'); //db connection package

//check if sign up request is made and mendatory fields are not blank
if(isset($_POST['signUp']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['city']) && !empty($_POST['country']) && !empty($_POST['e-mail']) && !empty($_POST['password'])) 
{
    $fName = $_POST['firstName']; //acquire first name
    
    $lName = $_POST['lastName']; //acquire last name
    
    if ($_POST['address'] !=null){ //if address is not blank
        $address = $_POST['address']; //acquire address
    }else{
        $address=""; //otherwise set it empty
    }
    $city = $_POST['city']; //acquire city
    
    if ($_POST['region'] !=null){ //if region is not blank
        $region = $_POST['region']; //accquire region
    }else{
        $region=""; //otherwise set region as empty
    }
    
    $country = $_POST['country']; //acquire country
    
    if ($_POST['postal'] !=null){ //if postal is not blank
        $postal = $_POST['postal']; //acquire postal
    }else{
        $postal =""; //otherwise set postal as empty
    }
    
    $email = $_POST['e-mail']; //acquire email
    
    if ($_POST['phone'] !=null){ //if phone is not blank
        $phone = $_POST['phone']; //acquire phone
    }else{
        $phone =""; //otherwise set phone as blank
    }
    $password = $_POST['password']; //acquire pass
    
    //check whether acquired email already exisit in our db or not using helper method EmailExisitance
    if (EmailExistance($email)){ //if exist set global message and redirects
        $_SESSION['messageExist'] = "'$email' Already Exists in our system, please use another Email ID for registring this account, or "."<a href='login.php'>Login</a>"." with '$email'";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        
    }else{ //email does not exist condion
    
        if (isset($_SESSION['messageExist'])){ //if global email exist message is present then remove it
            unset($_SESSION['messageExist']);
        }
        
        $customerID = createCustomerID(); //create nee customer ID using helpther method createCustomerID
        
        //add customer to customer table in db using helper method addtoCustomer, all paramters are qacquired above earlier
        addToCustomer($customerID, $fName, $lName, $address, $city, $region, $country, $postal, $phone, $email);
        
        //generate 32 chars salt using heler method saltGen
        $salt = saltGen(32);
        
        //generate digest for that acquired pass with concatinated salt and passing it through md5
        $digest = md5($password . $salt);
        
        //add customer login data to customer logon table in db using helper method addToCustomerLogon
        addToCustomerLogon($customerID, $email, $digest, $salt);
        
        //redirect to registration seccess page
        header('Location: registration_success.php');
    }
}


//helper method tp check whether the entered email id already exist in db
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

//helper method to create unique customer ID for thenew customer
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

//helper method to add customer data into customer table, all paramters are acquired earlier
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

//helper method to generate 32 chars of salt
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

//helper method to add customer login data into customer logon table
function addToCustomerLogon($customerID, $email, $digest, $salt)
{
    $state =1; //assume, no explanation is given in assingment
    $dateJoined=date("Y-m-d");
    $dateLastModified=date("Y-m-d");
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO CustomerLogon (CustomerID, UserName, Pass, Salt, State, DateJoined, DateLastModified)";
    $sql .= " VALUES ('$customerID', :UserName, :Pass, :Salt, '$state', '$dateJoined', '$dateLastModified')";
    $sth = $pdo->prepare($sql);
    $sth->bindValue(':UserName',$email, PDO::PARAM_STR);
    $sth->bindValue(':Pass',$digest, PDO::PARAM_STR);
    $sth->bindValue(':Salt',$salt, PDO::PARAM_STR);
    $sth->execute();
    $pdo =null;
}


?>