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

                        
            if(isset($_POST['creercompte'])){


                $nom = $_POST['nom'];
                $client->setNom($nom);
                $prenom = $_POST['prenom'];
                $client->setPrenom($prenom);
                $email = $_POST['email'];
                $client->setEmail($email);
                $telephone = $_POST['telephone'];
                $client->setTelephone($telephone);
                $password = $_POST['password'];
                $client->setPassword($password);

                $error = $registerDAO->clientregister($client);


                $idclientSQL = "SELECT idclient FROM users WHERE email = '".$nom."' and password = '".$prenom."' and email ='".$email."'";
                    
                $result = $DB->executeSQL($idclientSQL);

                $idclient = null;

                if($result->num_rows > 0){

                    if($row = $result->fetch_assoc()){
                        
                        $idclient = $row["idclient"];
                    }

                }
                $inserclientSQL = "INSERT INTO reservation(idcard, idclient) 
                    VALUES('".$newImaeName."','".$idclient."')" ;

                if($error == 1){
                session_start();
                $_SESSION['client'] = $client;
                header("Location:index.php");
                
                }else{

                echo "Register Failed";
                }

            }else{
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];

                $inserclientSQL = "INSERT INTO reservation(idcard, nom, prenom, email) 
                    VALUES('".$newImaeName."','".$nom."','".$prenom."','".$email."')" ;
                    
                    $test = $DB->executeSQL($inserclientSQL);

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

<?php include("themeparts/navbar.php"); ?>

<div class="login">
  
    <div class="form">
        <h1>RESERVER RAPIDEMENT</h1>
        <form action="" method="post" enctype="multipart/form-data">
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
				 <input type="text" name="phone" placeholder="Telephone..." required>
			</div>
			<div class="passwordInput">
				<i class="fa fa-key"></i>
				 <input type="password" placeholder="Mot de passe..." name="password" id="password" required>
				 <span class="eye" onclick="showPassword('password')">
				 <i id="eyeShowpassword" style="display:none;" class="fa fa-eye"></i>
				 <i id="eyeHidepassword"  style="display:block;" class="fa fa-eye-slash"></i>
				 </span>
			</div>
            <div class="defaultdiv flex">
                <input type="checkbox" class="check" name="creercompte" Value="CREERCOMPTE" id="creercompte">
                <label for="creercompte"> Creer Compte </label>
            </div>
            <div class="submit">
                <button  type="submit" name="reserverapidement" value="RESERVERRAPIDEMENT">RESERVER RAPIDEMENT</button>
                <button onclick="window.location.href='index.php#Services'"  name="voiroffres" value="VOIREOFFRES">VOIRE OFFRES<i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </form>
    </div>

</div>

<script src="js/script.js"></script>
    
</body>
</html>