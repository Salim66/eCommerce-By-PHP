<?php
    
    require_once('../../resources/config.php');

    if(isset($_GET['delete_report_id'])){

        $query = query("DELETE FROM reports WHERE report_id = " . escapeString($_GET['delete_report_id']) . " ");
        confirm($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Report delete successfully ): </h5>");
        redirect("index.php?reports");

    }else {

        redirect("index.php?reports");

    }


?>