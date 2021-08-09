<?php 

//============== Helper Functions ==============//

$upload_directory = 'uploads';

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
    $query = query("SELECT * FROM products WHERE product_quantity >= 1 ");
    confirm($query);

    while($row = fetchArray($query)){
        
        $product_image = displayImage($row['product_image']);

        $product = <<<DELIMITER

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img style="width: 320px; height: 150px;" src="../resources/$product_image" alt=""></a>
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
    $query = query("SELECT * FROM products WHERE product_category_id = " . escapeString($category_id) . " AND product_quantity >= 1 ");
    confirm($query);

    while($row = fetchArray($query)){

        $product_image = displayImage($row['product_image']);

        $product = <<<DELIMETER

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img style="width: 320px; height: 200px;" src="../resources/{$product_image}" alt="">
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
    $query = query("SELECT * FROM products WHERE product_quantity >= 1 ");
    confirm($query);

    while($row = fetchArray($query)){
        
        $product_image = displayImage($row['product_image']);

        $product = <<<DELIMITER

            <div class="col-sm-4 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <a href="item.php?id={$row['product_id']}"><img style="width: 320px; height: 200px;" src="../resources/$product_image" alt=""></a>
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
                <td><a class="btn btn-danger" href="index.php?delete_order_id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        DELIMETER;

        $i++;
        echo $orders;

    }

}



//=================== Display All Products Admin =====================//

//=========== upload Imaage directory ==============//
function displayImage($picture){
    global $upload_directory;

    return $upload_directory . DS . $picture;
}



function getProductsInAdmin(){

    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetchArray($query)){

        $category = showProductCategoryTitle($row['product_category_id']);

        $product_image = displayImage($row['product_image']);

        $products = <<<DELIMETER

            <tr>
                <td>{$row['product_id']}</td>
                <td>{$row['product_title']}<br>
                <a href="index.php?edit_product&id={$row['product_id']}"><img width="100" src="../../resources/$product_image" alt=""></a>
                </td>
                <td>{$category}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td><a class="btn btn-danger" href="index.php?delete_product_id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>

        DELIMETER;

        echo $products;

    }

}


//=============== Show Category name Products table page ===============//
function showProductCategoryTitle($product_category_id){

    $query = query("SELECT * FROM categories WHERE cat_id = '{$product_category_id}' ");
    confirm($query);

    while($cateogry_row = fetchArray($query)){
        return $cateogry_row['cat_title'];
    }

}




//=================== Product Add Admin ===================//
function addProduct(){

    if(isset($_POST['publish'])){

        $product_title             = escapeString($_POST['product_title']);
        $product_category_id       = escapeString($_POST['product_category_id']);
        $product_price             = escapeString($_POST['product_price']);
        $product_description       = escapeString($_POST['product_description']);
        $product_short_description = escapeString($_POST['product_short_description']);
        $product_quantity          = escapeString($_POST['product_quantity']);
        $product_image             = $_FILES['file']['name'];
        $image_temp_location       = $_FILES['file']['tmp_name'];

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query = query("INSERT INTO products (product_title, product_category_id, product_price, product_description, product_short_description, product_quantity, product_image) VALUES ('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description }', '{$product_short_description}', '{$product_quantity}', '{$product_image}')");
    
        confirm($query);
        // setMessage("New product was added ): ");
        setMessage("<h4 class='alert alert-success'>Product added successfully ):<button class='close' data-dismiss='alert'>&times;</button></h4>");
        redirect('index.php?products');

    }

}

//============= show product page under category select HTML =============//
function showCategoryAndProductPage(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetchArray($query)){

        $category_product = <<<DELIMETER

        <option value="{$row['cat_id']}">{$row['cat_title']}</option>

        DELIMETER;

        echo $category_product;
    }

}



//=================== Product update Admin ===================//
function updateProduct(){

    if(isset($_POST['update'])){

        $product_title             = escapeString($_POST['product_title']);
        $product_category_id       = escapeString($_POST['product_category_id']);
        $product_price             = escapeString($_POST['product_price']);
        $product_description       = escapeString($_POST['product_description']);
        $product_short_description = escapeString($_POST['product_short_description']);
        $product_quantity          = escapeString($_POST['product_quantity']);
        $product_image             = $_FILES['file']['name'];
        $image_temp_location       = $_FILES['file']['tmp_name'];

        // check image file is empty
        if(empty($product_image)){
            $query = query("SELECT product_image FROM products WHERE product_id = " . escapeString($_GET['id']) . " ");
            confirm($query);

            while($pic = fetchArray($query)){
                $product_image = $pic['product_image'];
            }
        }

        move_uploaded_file($image_temp_location, UPLOAD_DIRECTORY . DS . $product_image);

        $query  = "UPDATE products SET ";
        $query .= "product_title                = '{$product_title}'             , ";
        $query .= "product_category_id          = '{$product_category_id}'       , ";
        $query .= "product_price                = '{$product_price}'             , ";
        $query .= "product_description          = '{$product_description}'       , ";
        $query .= "product_short_description    = '{$product_short_description}' , ";
        $query .= "product_quantity             = '{$product_quantity}'          , ";
        $query .= "product_image                = '{$product_image}'               ";
        $query .= "WHERE product_id = " . escapeString($_GET['id']);

        
        $update_query = query($query);
        confirm($update_query);
        // setMessage("New product was added ): ");
        setMessage("<h4 class='alert alert-success'>Product updated successfully ):<button class='close' data-dismiss='alert'>&times;</button></h4>");
        redirect('index.php?products');

    }

}


//==================== Show Category In Admin =====================//
function showCategoryInAdmin(){

    $query = query("SELECT * FROM categories");
    confirm($query);

    while($row = fetchArray($query)){

        $categories = <<<DELIMETER

            <tr>
                <td>{$row['cat_id']}</td>
                <td>{$row['cat_title']}</td>
                <td>
                    <a class="btn btn-danger" href="index.php?delete_category_id={$row['cat_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>

        DELIMETER;

        echo $categories;

    }

}


//================== Add Category ====================//
function addCategory(){
    
    if(isset($_POST['add_category'])){
        $cat_title = escapeString($_POST['cat_title']);

        if(empty($cat_title) || $cat_title == " "){
            echo "Category title is required";
        }else {
            $query = query("INSERT INTO categories(cat_title) VALUES('{$cat_title}') ");
            confirm($query);
            setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Category added successfully ): </h5>");
        }
    }

}


//================ Get All Users Admin =================//
function getUsers(){

    $query = query("SELECT * FROM users");
    confirm($query);

    while($row = fetchArray($query)){

        $users = <<<DELIMETER

            <tr>
                <td>{$row['user_id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>                 
                <td>
                    <a class="btn btn-danger" href="index.php?delete_user_id={$row['user_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>

        DELIMETER;

        echo $users;

    }

}



//================ Add user Admin ================//
function addUser(){

    if(isset($_POST['add_user'])){

        $username   = escapeString($_POST['username']);
        $email      = escapeString($_POST['email']);
        $password   = escapeString($_POST['password']);
        $user_photo = $_FILES['file']['name'];
        $user_tmp   = $_FILES['file']['tmp_name'];

        move_uploaded_file($user_tmp, UPLOAD_DIRECTORY . DS . $user_photo);

        $query    = query("INSERT INTO users(username, email, password, photo) VALUES('{$username}', '{$email}', '{$password}', '{$user_photo}')");
        query($query);
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>User added successfully ): </h5>");
        redirect("index.php?users");

    }

}


//=============== Reports Show Admin =================//
function getReports(){

    $query = query("SELECT * FROM reports");
    confirm($query);

    while($row = fetchArray($query)){

        $reports = <<<DELIMETER

            <tr>
                <td>{$row['report_id']}</td>
                <td>{$row['product_id']}</td>
                <td>{$row['order_id']}</td>
                <td>{$row['product_title']}</td>
                <td>{$row['product_price']}</td>
                <td>{$row['product_quantity']}</td>
                <td>
                    <a class="btn btn-danger" href="index.php?delete_report_id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>

        DELIMETER;

        echo $reports;
    }

}







//============================= Slides Functions ===============================//

function addSlides(){

    if(isset($_POST['add_slide'])){

        $slide_title     = escapeString($_POST['slide_title']);
        $slide_image     = $_FILES['file']['name'];
        $slide_image_loc = $_FILES['file']['tmp_name'];

        if(empty($slide_title) || empty($slide_image)){
            echo '<p class="bg-danger p-3">All field are required!</p>';
        }else {


            move_uploaded_file($slide_image_loc, UPLOAD_DIRECTORY . DS . $slide_image);

            $query = query("INSERT INTO slides(slide_title, slide_image) VALUES('{$slide_title}', '{$slide_image}')");
            confirm($query);
            setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Slide added successfully ): </h5>");

        }

    }

}


function getCurrentSlidesInAdmin(){

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while($row = fetchArray($query)){

        $slide_image = displayImage($row['slide_image']);

        $current_slide = <<<DELIMETER

            <img class="img-responsive" style="width: 800px; height: 250px;" src="../../resources/{$slide_image}" alt="Current Slide">

        DELIMETER;

        echo $current_slide;

    }

}


function activeSlides(){

    $query = query("SELECT * FROM slides ORDER BY slide_id DESC LIMIT 1");
    confirm($query);

    while($row = fetchArray($query)){

        $slide_image = displayImage($row['slide_image']);

        $slides_active = <<<DELIMETER

            <div class="item active">
                <img style="height: 300px;" class="slide-image" src="../resources/{$slide_image}" alt="">
            </div>

        DELIMETER;

        echo $slides_active;

    }

}



function getSlides(){

    $query = query("SELECT * FROM slides");
    confirm($query);

    while($row = fetchArray($query)){

        $slide_image = displayImage($row['slide_image']);

        $slides = <<<DELIMETER

            <div class="item">
                <img style="height: 300px;" class="slide-image" src="../resources/{$slide_image}" alt="">
            </div>

        DELIMETER;

        echo $slides;

    }

}



function getSlidesThumnailsInAdmin(){

    $query = query("SELECT * FROM slides ORDER BY slide_id ASC ");
    confirm($query);

    while($row = fetchArray($query)){

        $slide_image = displayImage($row['slide_image']);

        $slide_image_thumb = <<<DELIMETER

            <div class="col-xs-6 col-md-4 slide_contains">
               <a href="index.php?delete_slide_id={$row['slide_id']}">
                    <img class="img-responsive slide_image" src="../../resources/{$slide_image}" alt="Current Slide">
                </a>

                <div class="caption">
                    <p>{$row['slide_title']}</p>
                </div>
            </div>
           

        DELIMETER;

        echo $slide_image_thumb;

    }

}












?>