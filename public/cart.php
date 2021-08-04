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
            unset($_SESSION['total_amount']);
            unset($_SESSION['total_quantity']);
            redirect("checkout.php");
        }else {
            redirect("checkout.php");
        }
    }


    if(isset($_GET['delete'])){
        $_SESSION['product_'.$_GET['delete']] = 0;
        unset($_SESSION['total_amount']);
        unset($_SESSION['total_quantity']);
        redirect("checkout.php");
    }


    // product show in cart page
    function cart() {

        $total = 0;
        $quantity = 0;

        $item_name = 1;
        $item_number = 1;
        $item_amount = 1;
        $item_quantity = 1;

        foreach ($_SESSION as $name => $value) {
            
            if($value > 0){

                if(substr($name, 0, 8) == 'product_'){

                    $length = strlen($name);
                    $len = $length - 8;
                    $id = substr($name, 8, $len);
                    // $length = explode('_', $name); 
                    // $id = substr($name, 8, $length[1]);


                    $query = query("SELECT * FROM products WHERE product_id = " . escapeString($id) . " " );
                    confirm($query);
    
                    while($row = fetchArray($query)){
                        
                        $sub_total = $row['product_price'] * $value;

                        $product = <<<DELIMETER
    
                                <tr>
                                    <td>{$row['product_title']}</td>
                                    <td>&#36;{$row['product_price']}</td>
                                    <td>{$value}</td>
                                    <td>&#36;{$sub_total}</td>
                                    <td>
                                        <a class="btn btn-warning" href="cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                                        <a class="btn btn-success" href="cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a class="btn btn-danger" href="cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                
                                </tr>

                                <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                                <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                                <input type="hidden" name="amount_{$item_amount}" value="{$row['product_price']}">
                                <input type="hidden" name="quantity_{$item_quantity}" value="{$row['product_quantity']}">
    
                        DELIMETER;
    
                        echo $product;

                        $item_name++;
                        $item_number++;
                        $item_amount++;
                        $item_quantity++;
                    }

                    $total += $sub_total;
                    $quantity += $value;

                    $_SESSION['total_amount']   = $total;
                    $_SESSION['total_quantity'] = $quantity;
    
                }

            }


        }

        

    }



?>