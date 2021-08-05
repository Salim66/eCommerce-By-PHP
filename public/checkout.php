<?php require_once('../resources/config.php'); ?>
<?php //require_once('cart.php'); ?>
<?php include(TEMPLATE_FRONT . DS . 'header.php'); ?>


      <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <?php include(TEMPLATE_FRONT . DS . 'top_nav.php'); ?>
    </nav>


    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">
    <?php if(!empty(displayMessage())){

        echo "<h4 class='text-center alert alert-danger'><?php displayMessage(); ?><button class='close' data-dismiss='alert'>&times;</button></h4>";

     } ?>
      <h1>Checkout</h1>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="sb-5ehm87019775@business.example.com">
<!-- <input type="hidden" name="business" value="edwindiaz123-facilitator@gmail.com"> -->
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="upload" value="1">
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
           <th>Action</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart(); ?>
        </tbody>
    </table>
    <?php echo showPaypal(); ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION['total_quantity']) ? $_SESSION['total_quantity'] : '0' ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#36;<?php echo isset($_SESSION['total_amount']) ? $_SESSION['total_amount'] : '0.00' ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


</div>
<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . 'footer.php'); ?>
