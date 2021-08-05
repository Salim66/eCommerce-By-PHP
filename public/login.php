<?php require_once('../resources/config.php') ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    
        <?php include(TEMPLATE_FRONT . DS . 'top_nav.php'); ?>

    </nav>

    <!-- Page Content -->
    <div class="container">

      <header>
            <h1 class="text-center">Login</h1>
            <?php if(isset($_SESSION['message'])): ?>
                <h5 class="text-center alert alert-danger" style="color: orangered;"><?php echo displayMessage(); ?><button class="close" data-dismiss="alert">&times;</button></h5>
            <?php endif; ?> 
        <div class="col-sm-4 col-sm-offset-5">         
            <form class="" action="" method="POST">
                <?php userLogin() ?>
                <div class="form-group"><label for="">
                    username<input type="text" name="username" class="form-control" autocomplete="off"></label>
                </div>
                 <div class="form-group"><label for="password">
                    Password<input type="password" name="password" class="form-control" autocomplete="off"></label>
                </div>

                <div class="form-group">
                  <input type="submit" name="submit" class="btn btn-primary" >
                </div>
            </form>
        </div>  


    </header>


        </div>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>