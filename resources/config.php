<?php 

    // Create site path
    defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
    defined("TEMPLATE_FRONT") ? null : define("TEMPLATE_FRONT", __DIR__ . DS . 'templates\front');
    defined("TEMPLATE_BACK") ? null : define("TEMPLATE_BACK", __DIR__ . DS . 'templates\back');


    echo TEMPLATE_FRONT; echo"<br>";
    echo TEMPLATE_BACK;

    




?>