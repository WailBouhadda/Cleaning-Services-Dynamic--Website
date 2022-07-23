<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

 $client = null;

 session_destroy();

 $_SESSION['client'] = null;

 header("Location:../login.php");

}else{
  header("Location:../login.php");
}



?>