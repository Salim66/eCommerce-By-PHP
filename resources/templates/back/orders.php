

                


        <div class="col-md-12">
            <div class="row">
                <h1 class="page-header">
                All Orders

                </h1>
                <?php //if(displayMessage() != null){ ?>
                    <h4 class="alert alert-danger"><?php displayMessage(); ?><button class="close" data-dismiss="alert">&times;</button></h4>
                <?php // } ?>
            </div>

            <div class="row">
                <table class="table table-hover">
                    <thead>

                    <tr>
                        <th>S.N</th>
                        <th>Amount</th>
                        <th>Transaction</th>
                        <th>Currency</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <?php displayOrders(); ?>                        

                    </tbody>
                </table>
            </div>
        </div>







