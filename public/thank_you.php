<?php require_once('../resources/config.php'); ?>
<?php require_once('cart.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

<?php

    if(isset($_GET['tx'])){

        // Get url value
        $amount     = $_GET['amt'];
        $currency   = $_GET['cc'];
        $transition = $_GET['tx'];
        $status     = $_GET['st'];

    }else {
        redirect("index.php");
    }

?>

      <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include(TEMPLATE_FRONT . DS . 'top_nav.php'); ?>
    </nav>


    <!-- Page Content -->
    <div class="container">

        <h1 class="text-center">Thank You</h1>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>
