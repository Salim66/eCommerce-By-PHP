<?php require_once('../resources/config.php'); ?>
<?php require_once('cart.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

<?php

    if(isset($_GET['tx'])){

        // Get url value
        $amount     = $_GET['amt'];
        $currency   = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status     = $_GET['st'];


        $query = query("INSERT INTO orders (order_amount, order_transaction, order_status, order_currency) VALUES ('{$amount}', '{$transaction}', '{$status}', '{$currency}')");

        confirm($query);

        session_destroy();

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
