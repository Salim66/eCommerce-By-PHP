<?php
    
    require_once('../../resources/config.php');

    if(isset($_GET['delete_category_id'])){

        $query = query("DELETE FROM categories WHERE cat_id = " . escapeString($_GET['delete_category_id']) . " ");
        confirm($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Category delete successfully ): </h5>");
        redirect("index.php?categories");

    }else {

        redirect("index.php?categories");

    }


?>