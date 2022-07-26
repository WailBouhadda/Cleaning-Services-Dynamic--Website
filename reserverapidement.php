<?php

require_once("tools/DBconnection.php");
require("entities/client.php");
require("dao/registerDAO.php");


$error = null;
$client = new client;
$registerDAO = new registerDAO;
$DB = new DBconnection;



$error = null;

if(isset($_POST['reserverapidement'])){



    /* idcard handling */
    if($_FILES['file']['error'] === 4){

        echo "<script> alert('Image ne pas trouvez');</script>";
    }else{

        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];

        $validationImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validationImageExtension)){

            echo "<script> alert('Merci d'inserer une image de type jpg, jpeg, png');</script>";
        }else if($fileSize > 1000000){
            echo "<script> alert('Image et tres grand');</script>";
        }else{
            $newImaeName = uniqid();
            $newImaeName .= "." . $imageExtension;

            move_uploaded_file($tmpName, 'idcards/' . $newImaeName);


            $client->setIdcard($newImaeName);
                        


                /* get reservation data */

                /* client infos */
                $nom = $_POST['nom'];
                $client->setNom($nom);
                $prenom = $_POST['prenom'];
                $client->setPrenom($prenom);
                $email = $_POST['email'];
                $client->setEmail($email);
                $telephone = $_POST['telephone'];
                $client->setTelephone($telephone);
                $adresse = $_POST['adresse'];
                $client->setAdresse($adresse);
                $password = $_POST['telephone'];
                $client->setPassword($password);

                /* /.client infos */


                /* seance details */


                $typemenage = $_POST['typemenage'];
                $duree = $_POST['duree'];
                $ville = $_POST['ville'];
                $nbrpersonne = $_POST['nbrpersonne'];
                $datemenage = date('y-m-d',strtotime($_POST['datemenage']));
                $frequence = $_POST['frequence'];
                $autre = $_POST['autre'];
                $tools = false;
                if(isset($_POST['tools'])){
                    $tools = true;
                }


                

                /* /.seance details */



                /* /.get reservation data */


                $registerDAO->clientregister($client);


                $idclientSQL = "SELECT iduser FROM users WHERE nom = '".$nom."' and prenom = '".$prenom."' and email ='".$email."'";
                    
                $result = $DB->executeSQL($idclientSQL);

                $idclient = null;

                if($result->num_rows > 0){

                    if($row = $result->fetch_assoc()){
                        
                        $idclient = $row["iduser"];
                    }

                }



                $inserclientSQL = "INSERT INTO reservation(typemenage, duree, ville, adresse, nbrpersonne, dateseance, frequence, idclient, autre, outils) 
                VALUES('".$typemenage."','".$duree."','".$ville."','".$adresse."','".$nbrpersonne."',
                '".$datemenage."','".$frequence."','".$idclient."','".$autre."','".$tools."')" ;
                
                $test = $DB->executeSQL($inserclientSQL);





                if($test){

                session_start();
                $_SESSION['client'] = $client;
                header("Location:PROFILE/index.php");
                
                }else{

                echo "Register Failed";
                }


         
            

        }
         /* /.idcard handling */





    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;600;800&family=Fredoka:wght@300;400;500;600&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
    <!-- /.google fonts -->
    <!-- fonts awesome -->
    <script src="https://kit.fontawesome.com/e2991dfebd.js" crossorigin="anonymous"></script>   
    <!-- /.fonts awesome -->

    <title>reserve Rapidement</title>
</head>
<body>

<?php require_once("navbar.php"); ?>

<div class="login">
  
    <div class="form">
        <h1>RESERVER RAPIDEMENT</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="defaultdiv">
                <div class="select flex">
                    <i class="fa fa-solid fa-broom"></i>
                    <select name="typemenage" id="typemenage">
                        <option value="" hidden disabled selected>Type De Menage...</option>
                        <option value="Menage Normale">Menage Normale</option>
                        <option value="Nettoyage Des Bureaux">Nettoyage Des Bureaux</option>
                        <option value="Nettoyage Vitres">Nettoyage Vitres</option>
                        <option value="Grand Ménage">Grand Ménage</option>
                        <option value="Nettoyage Avant Déménagement">Nettoyage Avant Déménagement</option>
                    </select>
                </div>
                <div class="select flex">
                    <i class="fa fa-solid fa-clock"></i>
                    <select name="duree" id="duree">
                        <option value="" hidden disabled selected>Duree De Menage...</option>
                        <option value="2">2 H</option>
                        <option value="3">3 H</option>
                        <option value="4">4 H</option>
                        <option value="5">5 H</option>
                        <option value="6">6 H</option>
                        <option value="7">7 H</option>
                        <option value="8">8 H</option>
                    </select>
                </div>
            </div>
            <div class="defaultdiv">
                <div class="select flex">
                    <i class="fa fa-solid fa-city"></i>
                    <select name="ville" id="ville">
                        <option value="" hidden disabled selected>Ville...</option>
                        <option value="Casablanca">Casablanca</option>
                        <option value="Mohemmadia">Mohemmadia</option>
                        <option value="Bouskoura">Bouskoura</option>
                        <option value="Berrchid">Berrchid</option>
                        <option value="Tite Mellil">Tite Mellil</option>
                        <option value="Sidi Rehal">Sidi Rehal</option>
                        <option value="Deroua">Deroua</option>
                    </select>
                </div>
                <div class="select flex">
                    <i class="fa fa-solid fa-people-group"></i>
                    <select name="nbrpersonne" id="duree">
                        <option value="" hidden disabled selected>Nombre de personnes...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
            </div>
            <div class="defaultdiv">
                <div class="select flex">
                    <i class="fa fa-solid fa-calendar-days"></i>
                    <input type="date" name="datemenage" id="datemenage">
                </div>
                <div class="select flex">
                    <i class="fa fa-solid fa-repeat"></i>
                    <select name="frequence" id="frequence">
                        <option value="" hidden disabled selected>Fréquence Ses Séances...</option>
                        <option value="fois">Une Fois</option>
                        <option value="quotidien">Quotidien</option>
                        <option value="hebdomadaire">Hebdomadaire</option>
                        <option value="Mensuel">mensuel</option>
                    </select>
                </div>
            </div>
            <div class="defaultdiv">
                
                <div class="defaultdiv">
                    <input type="file" name="file" id="file" accept=".jpg, .jpeg, .png" class="inputfile" />
                    <label for="file"><p>Carte d'identité</p><i class="fa-solid fa-address-card"></i></label>
                </div>
            </div>
            <div class="defaultdiv">
                <div class="nominput flex">
                    <i class="fa fa-solid fa-user"></i>
                    <input type="text" name="nom" placeholder="Nom..." required>
                </div>
                <div class="prenominput flex">
                    <i class="fa fa-solid fa-user"></i>
                    <input type="text" name="prenom" placeholder="Prenom..." required>
                </div>
            </div>
            <div class="mailInput">
				<i class="fa fa-envelope"></i>
				 <input type="email" name="email" placeholder="E-mail..." required>
			</div>
            <div class="phoneinput">
                 <i class="fa fa-solid fa-phone"></i>
				 <input type="text" name="telephone" placeholder="Telephone..." required>
			</div>
            <div class="adresse input">
                 <i class="fa fa-solid fa-location-dot"></i>
				 <input type="text" name="adresse" placeholder="Adresse..." required>
			</div>
            <div class=" input">
                 <i class="fa fa-solid fa-circle-info"></i>
				 <input type="text" name="autre" placeholder="Autre...">
			</div>
            <div class="defaultdiv flex">
                <i class="fa fa-solid fa-toolbox"></i>
                <input type="checkbox" class="check" name="tools" Value="" id="produitsetoutils">
                <label for="produitsetoutils"> Produits et Outils <span style="font-size: 12px; color: var(--color-primary);">(+ 100 DH)</span></label>
            </div>
            
            <div class="submit">
                <button onclick="window.location.href='index.php#Services'"  name="voiroffres" value="VOIREOFFRES">VOIRE OFFRES<i class="fa-solid fa-arrow-right"></i></button>
                <button  type="submit" name="reserverapidement" value="RESERVERRAPIDEMENT">RESERVER MAINTENANT</button>
            </div>
        </form>
    </div>

</div>

<script src="js/script.js"></script>
    
</body>
</html>