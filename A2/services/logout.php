<?php
session_start();
unset($_SESSION['sessionID']);
header("Location: {$_SERVER['HTTP_REFERER']}");
//session_destroy();
?>