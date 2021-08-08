<?php
    require_once('../../resources/config.php');

    if(isset($_GET['delete_order_id'])){

        $query = query("DELETE FROM orders WHERE order_id = ". escapeString($_GET['delete_order_id']) ."");
        confirm($query);

        setMessage("Order deleted successfully ):");
        redirect('index.php?orders');

    }else {
        setMessage("Order not deleted");
        redirect('index.php?orders');
    }


?>