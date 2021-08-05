<?php require_once('../../resources/config.php'); ?>

<?php include(TEMPLATE_BACK . DS . 'header.php'); ?>

<?php

    if(!isset($_SESSION['username'])){
        redirect('../../public');
    }

?>

        <div id="page-wrapper">

            <div class="container-fluid">

                 <!-- FIRST ROW WITH PANELS -->

                <?php
                
                
                    // return project file directory to server path
                    // echo $_SERVER['REQUEST_URI'];

                    if($_SERVER['REQUEST_URI'] == '/php-projects/ecom/public/admin/' || $_SERVER['REQUEST_URI'] == '/php-projects/ecom/public/admin/index.php') {

                        include(TEMPLATE_BACK . DS . 'admin_content.php');

                    }

                    if(isset($_GET['orders'])){
                        include(TEMPLATE_BACK . DS . 'orders.php');
                    }

                    if(isset($_GET['products'])){
                        include(TEMPLATE_BACK . DS . 'products.php');
                    }

                    if(isset($_GET['product'])){
                        include(TEMPLATE_BACK . DS . 'add_product.php');
                    }
                
                    if(isset($_GET['categories'])){
                        include(TEMPLATE_BACK . DS . 'categories.php');
                    }

                    if(isset($_GET['users'])){
                        include(TEMPLATE_BACK . DS . 'users.php');
                    }

                    if(isset($_GET['edit_product'])){
                        include(TEMPLATE_BACK . DS . 'edit_product.php');
                    }
                
                ?>



            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
<?php include(TEMPLATE_BACK . DS . 'footer.php'); ?>