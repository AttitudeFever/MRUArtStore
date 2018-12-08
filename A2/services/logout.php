<?php
//logout functionality
session_start();

unset($_SESSION['sessionID']); //remove session

header("Location: {$_SERVER['HTTP_REFERER']}"); //redirect to same page

//session_destroy();
?>