<?php require "../config.php" ;
$obj = new PetientData();
if(isset($_GET['r_id'])){
    $rid = $_GET['r_id'];
    $sid = $_GET['s_id'];
         $obj->updateStatus($rid,$sid);   
}