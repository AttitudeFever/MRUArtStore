<?php
session_start();
require_once('../includes/db-connection.php');

//checks if the email exists in query, also that it isn't an empty string
if(isset($_GET['signUp']) && !empty($_GET['firstName']) && !empty($_GET['lastName'])&& !empty($_GET['city'])&& !empty($_GET['country'])&& !empty($_GET['e-mail'])&& !empty($_GET['password']))
{
    
    $fName = $_GET['firstName'];
    $lName = $_GET['lastName'];
    $city = $_GET['city'];
    $country = $_GET['country'];
    $email = $_GET['e-mail'];
    $password = $_GET['password'];
    
    $salt = saltGen(6);
    $digest = md5($password . $salt);
    $dataEmail = getEmail($email);
    $custID = createCustomerID();
    
    if($dataEmail !== "")
    {
        echo "Email Already Exist";
    }
    else
    {
        addToCustomerLogon($custID, $cmail, $digest, $salt);
    }
}
// https://www.exchangecore.com/blog/how-create-random-string-php/
//creates a random string of characters with ur choice of length 
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

function getEmail($customerEmail)
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS); //sets up connection to database
    $sql = "SELECT Email";
    $sql .= "FROM Customers";
    $sql .= "WHERE $customerEmail = Email"; // SQL statements that grabs email from db
    $result = $pdo -> query($sql);
    return $result; //if blank string is returned, it means nothing in the database matches the customers email info.
    $pdo = null;
    
}

//once validated, customer email will be added to the table of customerLogOn and customer 
//CustomerId should be generated somehow via javascript (retrieving largest ID and then adding 1), need to enquire about city and address
//assignment itself doesn't ask us to input for the other columns, will assume null for now until we can verify. 
function addToCustomer($customerID, $firstName, $lastName, $country, $customerEmail)
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO Customers";
    $sql .= "VALUES ($customerID, $firstName, $lastName, null, null, null, $country, null, null, $customerEmail)";
    $formatted = prepare($sql);
    $formatted -> execute(); //returns true or false depending on query success
    $pdo = null;
}

//Grabs the highest customer ID and then adds plus 1 to create new customer ID. 
 function createCustomerID(){
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS); //setup PDO connection here
        $sql = "SELECT MAX(CustomerID) FROM CustomerLogon";
        $result = $sql->query(); // query should return highest customer ID 
        return $result + 1;
        $pdo = null;
    }

function addToCustomerLogon($customerID, $customerEmail, $pass, $salt)
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "INSERT INTO CustomerLogon";
    $sql .= "VALUES ($customerID, $customerEmail, $pass, $salt, 1, date('Y-m-d H:i:s'), getlastmod())";
    $formatted = prepare($sql);
    $formatted->execute();
    $pdo = null; 
}

//below is a function for retrieving from table for testing, will delete later. 
function retrieve()
{
    $pdo = new PDO(DBCONNSTRING, DBUSER, DBPASS);
    $sql = "SELECT * FROM Customers WHERE customerID = 30";
    $result = $sql->query();
    return $result;
    $pdo = null; //close connection
}



?>


<!--used similiar concepts //https://www.youtube.com/watch?v=HLx-zbl6siM-->