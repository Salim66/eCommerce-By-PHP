<?php

/**
 * Create redirect function
 */
function redirect($loaction){
    header("location: $loaction");
}


/**
 * Crearte query function
 */
function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
}


/**
 * Create database conection confirm failed function
 */
function confirm($result){
    global $connection;

    if(!$result){
        die("Query Failed " . mysqli_error($connection));
    }

}


/**
 * Create escape String function
 */
function escapeString($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}


/**
 * Create fetch array function 
 */
function fetchArray($result){
    return mysqli_fetch_array($result);
}



?>