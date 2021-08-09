<?php
    require_once('../../resources/config.php');

    if(isset($_GET['delete_slide_id'])){

        $find_slide_pic = query("SELECT slide_image FROM slides WHERE slide_id = " . escapeString($_GET['delete_slide_id']) . " LIMIT 1");
        confirm($find_slide_pic);
        $picture_name = fetchArray($find_slide_pic);

        $query = query("DELETE FROM slides WHERE slide_id = ". escapeString($_GET['delete_slide_id']) ."");
        confirm($query);

        $target_path = "../../resources/uploads/{$picture_name['slide_image']}";
        unlink($target_path);

        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid green; color: white;'>Slide delete successfully ): </h5>");
        redirect('index.php?slides');

    }else {
        setMessage("<h5 class='shadow-lg' style='background-color: yellowgreen; padding: 10px; border-left: 5px solid red; color: white;'>Slide Not deleted </h5>");
        redirect('index.php?slides');
    }


?>