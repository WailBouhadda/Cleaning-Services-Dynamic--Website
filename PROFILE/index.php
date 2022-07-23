<?php


require("../entities/client.php");

session_start();

$client = new client;

$admin = $_SESSION['client'];

if($client != null){

    header("Location:dashboard.php");

}else{
    header("Location:../login.php");
}





?>