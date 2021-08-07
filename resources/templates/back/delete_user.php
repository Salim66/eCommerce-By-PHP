<?php
    
    require_once('../../config.php');

    if(isset($_GET['id'])){

        $query = query("DELETE FROM users WHERE user_id = " . escapeString($_GET['id']) . " ");
        confirm($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>User delete successfully ): </h5>");
        redirect("../../../public/admin/index.php?users");

    }else {

        redirect("../../../public/admin/index.php?users");

    }


?>