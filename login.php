
<?php

require_once("tools/DBconnection.php");
require("entities/client.php");
require("dao/loginDAO.php");


$error = null;
$client = new client;
$loginDAO = new loginDAO;
$DB = new DBconnection;



$error = null;

if(isset($_POST['connexion'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $client = $loginDAO->clientLogin($email, $password);

    if($client != null){

      session_start();

      $_SESSION['client'] = $client;

      header("Location:PROFILE/index.php");
      
    }else{

      echo "Login Failed";
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

    <title>Login</title>
</head>
<body>

<?php require_once("navbar.php"); ?>

<div class="login">
  
    <div class="form">
        <h1>CONNEXION</h1>
        <form method="post">
            <div class="mailInput">
				<i class="fa fa-envelope"></i>
				 <input type="email" name="email" placeholder="E-mail..." required>
			</div>
			<div class="passwordInput">
				<i class="fa fa-key"></i>
				 <input type="password" placeholder="Mot de passe..." name="password" id="password" required>
				 <span class="eye" onclick="showPassword('password')">
				 <i id="eyeShowpassword" style="display:none;" class="fa fa-eye"></i>
				 <i id="eyeHidepassword"  style="display:block;" class="fa fa-eye-slash"></i>
				 </span>
			</div>
            <div class="submit">
                <button onclick="window.location.href='register.php'"  name="inscription" value="INSCRIPTION">INSCRIPTION</button>
                <button type="submit" name="connexion" value="CONNEXION">CONNEXION<i class="fa-solid fa-arrow-right"></i></button>
            </div>
            
        </form>
    </div>

</div>

<script src="js/script.js"></script>
    
</body>
</html>