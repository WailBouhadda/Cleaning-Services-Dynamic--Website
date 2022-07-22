<?php
  
  require_once("tools/DBconnection.php");

class registerDAO{

    private $DB = null;


    public function clientregister($c){

            $test = 0;
            $this->DB = new DBconnection;

            $clientexistSQL = "SELECT * FROM users WHERE email = '".$c->getEmail()."' and telephone = '".$c->getTelephone()."'";
                
            $result = $this->DB->executeSQL($clientexistSQL);

            $client = new client;

            if($result->num_rows > 0){

              $test = -1;

            }else{

                $inserclientSQL = "INSERT INTO users(nom, prenom, email, telephone, password) 
                VALUES('".$c->getNom()."','".$c->getPrenom()."','".$c->getEmail()."','".$c->getTelephone()."','".$c->getPassword()."')" ;
                
                $test = $this->DB->executeSQL($inserclientSQL);

                $test = 1;
            }

        return $test;
    }
}