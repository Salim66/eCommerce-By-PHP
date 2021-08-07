<?php
    
    require_once('../../config.php');

    if(isset($_GET['id'])){

        $query = query("DELETE FROM reports WHERE report_id = " . escapeString($_GET['id']) . " ");
        confirm($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Report delete successfully ): </h5>");
        redirect("../../../public/admin/index.php?reports");

    }else {

        redirect("../../../public/admin/index.php?reports");

    }


?>