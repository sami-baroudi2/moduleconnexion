<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Accueil" content="Page d'accueil">
    <link rel="stylesheet" href="moduleconnexion.css">
    <title>Accueil</title>
</head>
<body>
    


<?php
	if(!isset($_SESSION["login"])){
		echo '<div class=reg> <a id="connexionLink"  href="connexion.php">Login</a> 
        <a id="inscriptionLink" href="inscription.php">Registration</a> </div>';				
	}
	else{   
		echo '<a href="profil.php">Your Profil</a>
        <form method="post" action="#">
		<input id="decoBtn" type="submit" value="Disconnect" name="decoBtn"/>
        </form>';
						  
		if($_SESSION["login"] == "admin")
		{
		echo"<a href='admin.php' style='width:100%;'>Page Admin</a>";
		}	
		}
				
	if(isset($_POST["decoBtn"])){
		session_destroy();
		header("location:#");
	}
?>
</body>
</html>