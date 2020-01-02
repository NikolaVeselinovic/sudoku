<?php 
    include "back-end/user.php";
    session_start();

    if(isset($_SESSION['user'])){
        header("Location: menu.php");
    }else{
        header("Location: login.php");
    }


?>