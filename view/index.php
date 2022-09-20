<?php 
    session_start();

    if(!isset($_SESSION['usuario'])){
        header("Location: login.php");
        die();
    }
    else{
        header("Location: list.php");
        die();
    }
?>