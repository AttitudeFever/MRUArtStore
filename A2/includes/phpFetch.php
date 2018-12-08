<?php

//Method return JSON DATA into PHP Associative Array, working as a fetch api
function fetch($api){
    
    $JSONdata= file_get_contents($api); //file_get_contents converts the echo'd JSON into text
    return $data = json_decode($JSONdata); //converts from JSON to php Associative Array and return it
}

?>