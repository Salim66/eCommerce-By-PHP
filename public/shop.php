<?php require_once('../resources/config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include(TEMPLATE_FRONT . DS . 'top_nav.php'); ?>
    </nav>

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1 class="text-center text-uppercase">Shop</h1>
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">


         <?php   getProductINShopPage();  ?>


        </div>
        <!-- /.row -->

        <hr>
<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>