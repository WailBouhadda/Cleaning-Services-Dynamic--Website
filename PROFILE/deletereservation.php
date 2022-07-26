<?php

require_once("../tools/DBconnection.php");

$DB = new DBconnection;

if(isset($_GET['idres'])){


    $idreservation = $_GET['idres'];

    $deletereservation = "DELETE FROM reservation WHERE idreservation = ".$idreservation;


    if($DB->executeSQL($deletereservation)){

        header("Location:listreservation.php");

    }else{

        header("Location:listreservation.php");

    }


}else{
    
    header("Location:listreservation.php");
}

?>