<?php require_once('config.php') ?>

<?php


    if(isset($_GET['add'])){


        $query = query("SELECT * FROM products WHERE product_id = " .escapeString($_GET['add']). " ");
        confirm($query);


        while($row = fetchArray($query)){

            if($row['product_quantity'] != $_SESSION['product_'.$_GET['add']]){
                $_SESSION['product_'.$_GET['add']] += 1;
                redirect("../public/checkout.php");
            }else {
                setMessage("We only have ".$row['product_quantity']. " {$row['product_title']} " . " available.");
                redirect("../public/checkout.php");
            }

        }

    }


    if(isset($_GET['remove'])){
        $_SESSION['product_'.$_GET['remove']]--;

        if($_SESSION['product_'.$_GET['remove']] < 1){
            unset($_SESSION['total_amount']);
            unset($_SESSION['total_quantity']);
            redirect("../public/checkout.php");
        }else {
            redirect("../public/checkout.php");
        }
    }


    if(isset($_GET['delete'])){
        $_SESSION['product_'.$_GET['delete']] = 0;
        unset($_SESSION['total_amount']);
        unset($_SESSION['total_quantity']);
        redirect("../public/checkout.php");
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

                        $product_image = displayImage($row['product_image']);

                        $product = <<<DELIMETER
    
                                <tr>
                                    <td>
                                        {$row['product_title']}
                                        <br>
                                        <img width="100" src="../resources/$product_image">
                                    </td> 
                                    <td>&#36;{$row['product_price']}</td>
                                    <td>{$value}</td>
                                    <td>&#36;{$sub_total}</td>
                                    <td>
                                        <a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                                        <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                                        <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                                    </td>
                                
                                </tr>

                                <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                                <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                                <input type="hidden" name="amount_{$item_amount}" value="{$row['product_price']}">
                                <input type="hidden" name="quantity_{$item_quantity}" value="{$value}">
    
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


    //=========== Paypal Show ============//
    function showPaypal(){
        if(isset($_SESSION['total_quantity']) && $_SESSION['total_quantity'] >= 1){

            $paypal = <<<DELIMETER
            
                <input type="image" name="upload"
                src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                alt="PayPal - The safer, easier way to pay online">
            
            DELIMETER;

            return $paypal;

        }
    }



    //================== Order Report ===================//
    // order report
    function report() {

        if(isset($_GET['tx'])){

            // Order table inset
            // Get url value
            $amount      = $_GET['amt'];
            $currency    = $_GET['cc'];
            $transaction = $_GET['tx'];
            $status      = $_GET['st'];
        
            
    

            $total = 0;
            $quantity = 0;

            foreach ($_SESSION as $name => $value) {
                
                if($value > 0){

                    if(substr($name, 0, 8) == 'product_'){

                        $length = strlen($name);
                        $len = $length - 8;
                        $id = substr($name, 8, $len);

                        // Order table inset
                        $send_order = query("INSERT INTO orders (order_amount, order_transaction, order_status, order_currency) VALUES ('{$amount}', '{$transaction}', '{$status}', '{$currency}')");
                        confirm($send_order);

                        $order_last_id = orderLastID();

                        // add to cart product search
                        $query = query("SELECT * FROM products WHERE product_id = " . escapeString($id) . " " );
                        confirm($query);
        
                        while($row = fetchArray($query)){
                            
                            $sub_total = $row['product_price'] * $value;
                            $product_price = $row['product_price'];
                            $product_title = $row['product_title'];

                            // order report
                            $insert_report = query("INSERT INTO reports (product_id, order_id, product_title, product_price, product_quantity) VALUES ('{$id}', '{$order_last_id}', '{$product_title}', '{$product_price}', '{$value}')");
                            confirm($insert_report);

                        }

                        $total += $sub_total;
                        $quantity += $value;

                        $_SESSION['total_amount']   = $total;
        
                    }

                }


            }

    
            session_destroy();
    
        }else {
            redirect("index.php");
        }
      

    }
    



?>



