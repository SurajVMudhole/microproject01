<?php
session_start();
if(!isset($_SESSION['user'])||$_SESSION['user']!= true ){
    header("location:index.php"); 
    exit();
    }

else{
    session_unset();
    session_destroy();
    header("location:index.php");
    exit();
}

?>