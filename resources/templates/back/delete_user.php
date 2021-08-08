<?php
    
    require_once('../../resources/config.php');

    if(isset($_GET['delete_user_id'])){

        $query = query("DELETE FROM users WHERE user_id = " . escapeString($_GET['delete_user_id']) . " ");
        confirm($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>User delete successfully ): </h5>");
        redirect("index.php?users");

    }else {

        redirect("index.php?users");

    }


?>