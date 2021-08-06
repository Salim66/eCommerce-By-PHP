
<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Add Product
</h1>
</div>
  
<?php


    if(isset($_POST['publish'])){

        $product_title             = escapeString($_POST['product_title']);
        $product_category_id       = escapeString($_POST['product_category_id']);
        $product_price             = escapeString($_POST['product_price']);
        $product_description       = escapeString($_POST['product_description']);
        $product_short_description = escapeString($_POST['product_short_description']);
        $product_quantity          = escapeString($_POST['product_quantity']);
        $product_image             = $_FILES['file']['name'];
        $image_temp_location       = $_FILES['file']['tmp_name'];

        $target_path = UPLOAD_DIRECTORY . DS . $product_image;

        move_uploaded_file($image_temp_location, $target_path);

        $query = query("INSERT INTO products (product_title, product_category_id, product_price, product_description, product_short_description, product_quantity, product_image) VALUES ('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description }', '{$product_short_description}', '{$product_quantity}', '{$product_image}')");
    
        confirm($query);
        // setMessage("New product was added ): ");
        setMessage("<h4 class='alert alert-success'>Product added successfully ):<button class='close' data-dismiss='alert'>&times;</button></h4>");
        redirect('index.php?products');

    }





?>


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60">
      </div>
    </div>



    <div class="form-group">
           <label for="product-title">Product Short Description</label>
      <textarea name="product_short_description" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>




</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>

        <select name="product_category_id" id="" class="form-control">
            <option value="">Select Category</option>

            
           
        </select>


</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" name="product_quantity" class="form-control">
    </div>


<!-- Product Tags -->


   <!--  <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div>
 -->
    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>
