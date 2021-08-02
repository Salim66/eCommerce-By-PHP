<?php 

//============== Helper Functions ==============//

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


//============== Product Functions ==============//

/**
 * Create gell product function
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
                        <h4><a href="product.html">{$row['product_title']}</a>
                        </h4>
                        <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                    
                        <a class="btn btn-primary" target="_self" href="item.php?id={$row['product_id']}">View Tutorial</a>
                    </div>
                    
                </div>
            </div>

        DELIMITER;

        echo $product;

    }
}



?>