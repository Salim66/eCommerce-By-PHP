<?php addCategory(); ?>
<h1 class="page-header">
  Product Categories

  
</h1>


<div class="col-md-4">
    <h5 class="shadow" style="background-color: white; border-left-color: green; border-left-width: 20px;"><?php displayMessage(); ?></h5>
    <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="cat_title" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" name="add_category" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>id</th>
            <th>Title</th>
        </tr>
            </thead>


    <tbody>
        
        <?php showCategoryInAdmin(); ?>

    </tbody>

        </table>

</div>