<?php

    // require config file
    require_once('../resources/config.php');


    // includes header.php file
    include(TEMPLATE_FRONT . DS . 'header.php');

?>



    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Start Category sectioon -->
            <?php include(TEMPLATE_FRONT . DS . 'side_nav.php'); ?>            
            <!-- !Category sectioon -->

            <div class="col-md-9">

                <!-- Start slider section -->
                <?php include(TEMPLATE_FRONT . DS . 'slider.php'); ?>
                <!-- !slider section -->

                <div class="row">
                    <?php
                    
                        echo $_SESSION['product_1'];
                    
                    ?>

                    <?php
                    
                    getProducts();
                    
                    
                    ?>
                 

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

<?php

    // include footer.php file
    include(TEMPLATE_FRONT . DS . 'footer.php');

?>