<?php
    
    require_once('../../config.php');

    if(isset($_GET['id'])){

        $query = query("DELETE FROM categories WHERE cat_id = " . escapeString($_GET['id']) . " ");
        confirm($query);
        setMessage("Category deleted successfully ): ");
        redirect("../../../public/admin/index.php?categories");

    }else {

        redirect("../../../public/admin/index.php?categories");

    }


?>