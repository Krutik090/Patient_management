<?php

require "config.php";
$obj = new PetientData();

// Getting the Update ID from the Get Method from URL 
if (isset($_GET["del_id"])) {
    
    $rid = $_GET["del_id"];
    $obj->deleteData($rid);
    $rows = $obj->search($rid);
    $path = $rows->report;
    // Check if the file exists
    if (file_exists($path)) {
        // Attempt to delete the file
        if (unlink($path)) {
            echo "<script> alert('File deleted successfully') </script>.";
        } else {
            echo "<script> alert('Unable to delete the file. Check permissions or file locks') </script>";
        }
    } else {
        echo "</script> alert('File does not exist') </script>";
    }


}