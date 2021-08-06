<?php 

//============== Helper Functions ==============//

/**
 * Order last id
 */
function orderLastID(){
    global $connection;
    return mysqli_insert_id($connection);
}

/**
 * Create setMessage function for session value set
 */
function setMessage($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg; 
    }else {
        $msg = "";
    }
}


/**
 * Create displayMessage function for session value show
 */
function displayMessage(){
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


/**
 * Create redirect function
 */
function redirect($loaction){
    header("location: $loaction");
}


/**
 * Crearte query function
 */
function query($sql){
    global $connection;
    return mysqli_query($connection, $sql);
}


/**
 * Create database conection confirm failed function
 */
function confirm($result){
    global $connection;

    if(!$result){
        die("Query Failed " . mysqli_error($connection));
    }

}


/**
 * Create escape String function
 */
function escapeString($string){
    global $connection;
    return mysqli_real_escape_string($connection, $string);
}


/**
 * Create fetch array function 
 */
function fetchArray($result){
    return mysqli_fetch_array($result);
}






/*********************************** FRONT END FUNCTIONS ************************************/


//============== Product Functions ==============//

/**
 * Create get product function
 */
function getProducts(){
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetchArray($query)){
        
        $product = <<<DELIMITER

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="http://placehold.it/320x150" alt=""></a>
                    <div class="caption">
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    
                        <a class="btn btn-primary" target="_self" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                    </div>
                    
                </div>
            </div>

        DELIMITER;

        echo $product;

    }
}



//============== Category Functions ===============//

/**
 * Create get all category function 
 */
function getCategory(){
    $query = query("SELECT * FROM categories");
    confirm($query); 
        
    while($row = fetchArray($query)){

        $categories_link = <<<DELIMETER

            <a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>

        DELIMETER;

        echo $categories_link;
    }
}


/**
 * Create productCategory function
 */
function getProductINCatPage($category_id){
    $query = query("SELECT * FROM products WHERE product_category_id = " . escapeString($category_id) . " ");
    confirm($query);

    while($row = fetchArray($query)){
        $product = <<<DELIMETER

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_description']}</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

        DELIMETER;
        
        echo $product;
    }
}



//==================== Shop Page ====================//

function getProductINShopPage(){
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetchArray($query)){
        
        $product = <<<DELIMITER

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img src="http://placehold.it/320x150" alt=""></a>
                    <div class="caption">
                        <h4 class="pull-right">&#36;{$row['product_price']}</h4>
                        <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    
                        <a class="btn btn-primary" target="_self" href="../resources/cart.php?add={$row['product_id']}">Add to cart</a>
                    </div>
                    
                </div>
            </div>

        DELIMITER;

        echo $product;

    }
}






//=================== User Login Function ====================//

function userLogin(){
    if(isset($_POST['submit'])){

        $username = escapeString($_POST['username']);
        $password = escapeString($_POST['password']);

        $query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ");
        confirm($query);

        if(mysqli_num_rows($query) == 0){
            setMessage("Your username and password are wrong!");
            redirect("login.php");
        }else {
            // setMessage("Welcome to Admin {$username}");
            $_SESSION['username'] = $username;
            redirect("admin");
        }

    }
}



//===================== Customer Contact Function ======================//
// mail(to, subject, message, information);

function sendMessage() {

    if(isset($_POST['submit'])){ 

        $to          =   "user@example.com";
        $from_name   =   $_POST['name'];
        $subject     =   $_POST['subject'];
        $email       =   $_POST['email'];
        $message     =   $_POST['message'];

        $headers = "From: {$from_name} {$email}";

        $result = mail($to, $subject, $message, $headers);


        if(!$result) {
            setMessage("Sorry we could not send your message");
            redirect("contact.php");
        } else {
            setMessage("Your Message has been sent");
            redirect("contact.php");
        }

    }
}









/*********************************** BACK END FUNCTIONS ************************************/


//====================== Display Orders =====================//
function displayOrders(){
    // Query for orders get from database
    $query = query("SELECT * FROM orders");
    confirm($query);

    $i = 1;
    while($row = fetchArray($query)){

        $orders = <<<DELIMETER

            <tr>
                <td>{$i}</td>
                <td>{$row['order_amount']}</td>
                <td>{$row['order_transaction']}</td>
                <td>{$row['order_currency']}</td>
                <td>{$row['order_status']}</td>
                <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        DELIMETER;

        $i++;
        echo $orders;

    }

}



//=================== Display All Products =====================//
function getProductsInAdmin(){

    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetchArray($query)){

        $products = <<<DELIMETER

            <tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_title']}<br>
                <a href="index.php?edit_product&id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
                </td>
                <td>{$row['product_category_id']}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td><a class="btn btn-danger" href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        DELIMETER;

        echo $products;

    }

}


//=================== Product Add ===================//
// function addProduct(){

//     if(isset($_POST['publish'])){

//         $product_title             = escapeString($_POST['product_title']);
//         $product_category_id       = escapeString($_POST['product_category_id']);
//         $product_price             = escapeString($_POST['product_price']);
//         $product_description       = escapeString($_POST['product_description']);
//         $product_short_description = escapeString($_POST['product_short_description']);
//         $product_quantity          = escapeString($_POST['product_quantity']);
//         $product_image             = escapeString($_FILES['file']['name']);
//         $image_temp_location       = escapeString($_FILES['file']['tmp_name']);

//         move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);
//         echo UPLOAD_DIRECTORY;

//         // $query = query("INSERT INTO products (product_title, product_category_id, product_price, product_description, product_short_description, product_quantity, product_image) VALUES ('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description }', '{$product_short_description}', '{$product_quantity}', '{$product_image}')");
    
//         // confirm($query);
//         // // setMessage("New product was added ): ");
//         // setMessage("<h4 class='alert alert-success'>Product added successfully ):<button class='close' data-dismiss='alert'>&times;</button></h4>");
//         // redirect('index.php?products');

//     }

// }




















?>