<?php require_once('../resources/config.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include(TEMPLATE_FRONT . DS . 'top_nav.php'); ?>
    </nav>

    <!-- Page Content -->
    <div class="container">
        <?php
        
            $query = query("SELECT * FROM categories WHERE cat_id = " . escapeString($_GET['id']) . " ");
            confirm($query);
            
            $category = fetchArray($query);
        
        ?>

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1><?php echo $category['cat_title']; ?></h1>
        </header>

        <hr>

        <!-- Page Features -->
        <div class="row text-center">


         <?php   getProductINCatPage($_GET['id']);  ?>


        </div>
        <!-- /.row -->

        <hr>
<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>