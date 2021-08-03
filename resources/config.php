<?php 

    ob_start(); //The function will be called when the output buffer is flushed (sent) or cleaned (with ob_flush, ob_clean or similar function) or when the output buffer is flushed to the browser at the end of the request

    session_start();
    session_destroy();

    // Create site path
    defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
    defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . 'templates\front');
    defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . 'templates\back');


    //DB Connection Constant
    defined("DB_HOST") ? null : define("DB_HOST", "localhost");
    defined("DB_USER") ? null : define("DB_USER", "root");
    defined("DB_PASS") ? null : define("DB_PASS", "");
    defined("DB_NAME") ? null : define("DB_NAME", "ecom_db");

    // Database connection
    $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    
    // require all neccessary file for all file reqire just this one file execute all the code
    require_once("functions.php");



?>