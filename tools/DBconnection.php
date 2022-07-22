<?php 

class DBconnection{


private $conn = null;

 public function connect(){

  $conn = new mysqli("localhost","root","","cleaningservices");


  if ($conn->connect_error) {

    die("Connection failed: " . mysqli_connect_error());

  }

  return $conn;
 }


 public function executeSQL($sql){

  $con = $this->connect();
  $result = $con->query($sql);

  return $result;
}

}


?>