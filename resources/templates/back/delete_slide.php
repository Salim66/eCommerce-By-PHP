<?php
    require_once('../../resources/config.php');

    if(isset($_GET['delete_slide_id'])){

        $query = query("DELETE FROM slides WHERE slide_id = ". escapeString($_GET['delete_slide_id']) ."");
        confirm($query);

        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Slide delete successfully ): </h5>");
        redirect('index.php?slides');

    }else {
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid red; color: white;'>Slide Not deleted </h5>");
        redirect('index.php?slides');
    }


?>