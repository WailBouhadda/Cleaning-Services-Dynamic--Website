<?php

class client{

    private $id;
    private $idcard;
    private $nom;
    private $prenom;
    private $email;
    private $telephone;
    private $adresse;
    private $password;


    
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }
    


    public function setIdcard($idcard){
        $this->idcard = $idcard;
    }

    public function getIdcard(){
        return $this->idcard;
    }



    
    public function setNom($nom){
        $this->nom = $nom;
    }

    public function getNom(){
        return $this->nom;
    }


    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
    }

    public function getPrenom(){
        return $this->prenom;
    }


    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }




    public function setTelephone($telephone){
        $this->telephone = $telephone;
    }

    public function getTelephone(){
        return $this->telephone;
    }



    public function setAdresse($adresse){
        $this->adresse = $adresse;
    }

    public function getAdresse(){
        return $this->adresse;
    }



    public function setPassword($password){
        $this->password = $password;
    }

    public function getPassword(){
        return $this->password;
    }


}

?>