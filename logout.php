<?php
//echo "<script type='text/javascript'> alert('hello'); </script>";
    
    session_start();
    unset($_SESSION['username']);
   
    //session_destroy();
    
    
    header("location:index.php");
    
