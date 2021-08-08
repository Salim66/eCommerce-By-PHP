<?php
    require_once('../../resources/config.php');

    if(isset($_GET['delete_product_id'])){

        $query = query("DELETE FROM products WHERE product_id = ". escapeString($_GET['delete_product_id']) ."");
        confirm($query);

        // setMessage("Product deleted successfully ):");
        setMessage("<h4 class='alert alert-success'>Product deleted successfully ):<button class='close' data-dismiss='alert'>&times;</button></h4>");
        redirect('index.php?products');

    }else {
        setMessage("<h4 class='alert alert-danger'>Product not deleted!<button class='close' data-dismiss='alert'>&times;</button></h4>");
        redirect('index.php?products');
    }


?>