
<h1 class="page-header">
  Reports

  
</h1>
<?php displayMessage(); ?>
<div class="col-md-12">

    <table class="table">
        <thead>
            <tr>
                <th>Report Id</th>
                <th>Product Id</th>
                <th>Order Id</th>
                <th>Product Title</th>
                <th>Product Price</th>
                <th>Product Qunatity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            
            <?php getReports(); ?>

        </tbody>

    </table>

</div>