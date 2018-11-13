<?php

define('DBHOST', 'localhost');
define('DBNAME', 'art');
define('DBUSER', getenv('C9_USER'));
define('DBPASS', '');
define('DBCONNSTRING',"mysql:host=" . DBHOST . ";dbname=" . DBNAME . ";charset=utf8mb4;");

?>