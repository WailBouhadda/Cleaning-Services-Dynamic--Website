<?php
  
  require_once("tools/DBconnection.php");

class loginDAO{



   private $DB = null;


    public function clientLogin($email, $password){

            $this->DB = new DBconnection;

            $LoginSQL = "SELECT * FROM users WHERE email = '".$email."' and password = '".$password."'";
                
            $result = $this->DB->executeSQL($LoginSQL);

            $client = new client;

            if($result->num_rows > 0){

                if($row = $result->fetch_assoc()){

                  $client->setId($row["iduser"]); 
                  $client->setIdcard($row["idcard"]);
                  $client->setNom($row["nom"]);   
                  $client->setPrenom($row["prenom"]); 
                  $client->setEmail($row["email"]); 
                  $client->setAdresse($row['adresse']);
                  $client->setTelephone($row["telephone"]); 
                  $client->setPassword($row["password"]); 
                    
                    
                }else{
                    $client = null;
                }
            }else{
                $client = null;
        }

        return $client;
    }



}





?>