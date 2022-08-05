<?php

require_once("tools/DBconnection.php");
require("entities/admin.php");

session_start();

$admin = new admin;

$admin = $_SESSION['admin'];

if($admin != null){

 $admin = null;

 session_destroy();

 $_SESSION['admin'] = null;

 header("Location:login.php");

}else{
  header("Location:login.php");
}



?>