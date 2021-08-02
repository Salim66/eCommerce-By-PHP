<div class="col-md-3">
    <p class="lead">Shop Name</p>
    <div class="list-group">

        <?php

            // Create query for all category
            $sql = "SELECT * FROM categories";
            // Execute the query
            $send_query = mysqli_query($connection, $sql);

            if(!$send_query){
                die("Query Failed " . mysqli_error($connection));
            }

            
            // Fetch query data
            while($row = mysqli_fetch_array($send_query)){
                echo "<a href='category.html' class='list-group-item'>{$row['cat_title']}</a>";
            }
        
        
        
        ?>


    </div>
</div>