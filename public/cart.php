<?php require_once('../resources/config.php') ?>

<?php


    if(isset($_GET['add'])){


        $query = query("SELECT * FROM products WHERE product_id= " .escapeString($_GET['add']). " ");
        confirm($query);

        while($row = fetchArray($query)){

            if($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]){
                $_SESSION['product_'.$_GET['add']] += 1;
            }else {
                setMessage("We only have ".$row['product_quantity']." available.");
                redirect("checkout.php");
            }

        }


        // $_SESSION['product_' . $_GET['add']] += 1;
        // redirect("index.php");


    }



?>