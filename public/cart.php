<?php require_once('../resources/config.php') ?>

<?php


    if(isset($_GET['add'])){


        $query = query("SELECT * FROM products WHERE product_id = " .escapeString($_GET['add']). " ");
        confirm($query);


        while($row = fetchArray($query)){

            if($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]){
                $_SESSION['product_'.$_GET['add']] += 1;
                redirect("checkout.php");
            }else {
                setMessage("We only have ".$row['product_quantity']. " {$row['product_title']} " . " available.");
                redirect("checkout.php");
            }

        }

    }


    if(isset($_GET['remove'])){
        $_SESSION['product_'.$_GET['remove']]--;

        if($_SESSION['product_'.$_GET['remove']] < 1){
            redirect("checkout.php");
        }else {
            redirect("checkout.php");
        }
    }


    if(isset($_GET['delete'])){
        $_SESSION['product_'.$_GET['delete']] = 0;
        redirect("checkout.php");
    }


    // product show in cart page
    function cart() {

        foreach ($_SESSION as $name => $value) {
            
            if(substr($name, 0, 8) == 'product_'){

                $query = query("SELECT * FROM products");
                confirm($query);

                while($row = fetchArray($query)){

                    $product = <<<DELIMETER

                            <tr>
                                <td>{$row['product_title']}</td>
                                <td>$23</td>
                                <td>3</td>
                                <td>2</td>
                                <td>
                                    <a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                                    <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                                    <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                                </td>
                            
                            </tr>

                    DELIMETER;

                    echo $product;
                }

            }


        }

        

    }



?>