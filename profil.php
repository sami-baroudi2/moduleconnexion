<?php
//On ouvre la session
session_start();
	
require_once('configuration.php'); //On récupère le code de connexion à la base de données

	$sesslogin = $_SESSION["login"]; //On définit une variable pour le login de la session 

    $req= mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE login = '$sesslogin'"); //On formule la query pour récupérer les données de l'utilisateur connecté dans la BDD 

    //On "fetch" les informations de l'utilisateur, on va ainsi pouvoir les utiliser pour préremplir les champs du formulaire
// -------------------------------------------------------------------------------------------------------------------------------------------
	$res= mysqli_fetch_all($req,MYSQLI_ASSOC);

	$login = $res[0]['login'];
	
    $prenom = $res[0]['prenom'];
	
    $nom = $res[0]['nom'];
	
    $password = $res[0]['password']; 

//--------------------------------------------------------------------------------------------------------------------------------------------

//On créer une requète pour récupérer seulement le mdp de l'utilisateur, on va ainsi pouvoir le vérifier plus tard
    $fetch = mysqli_query ($bdd, "SELECT password FROM utilisateurs WHERE login = '$sesslogin'");
    $Fet = mysqli_fetch_all($fetch);


    $actuel = $Fet[0][0];//On créer une variable pour le stocker.
    $PosPass = isset($_POST['password']);
    $post = hash('sha256' , $PosPass);//On fait pareil pour le mdp en $_POST , on prend le soin de les hacher aussi pour qu'ils soit identiques.


?>

<html lang="fr">

	<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="profil" content="Page du profil">
    <link rel="stylesheet" href="moduleconnexion.css">
		<title>Profil</title>
	</head>
	
<body>
    <header>
    <div class="accueil">
        <a href="index.php">Accueil</a>
    </div>
        <nav>
            <ul>
              <li class="deroulant"><a href="#">Navigation &ensp;</a>
                <ul class="sous">
                  <li><a href="inscription.php">Inscription</a></li>
                  <li><a href="connexion.php">Connexion</a></li>
                </ul>
            </ul>
          </nav>
    </header>
				<div>
					<h1 id="discovered">Profil de <?php echo $_SESSION["login"]; ?></h1>
                </div>
		<div class="formulaire">
			<form method="post" action="#">
		
					<label for="login">Login</label>
					<input type="text" name="login" value="<?php echo $login?>" placeholder="admin"  required/>
			
					<label for="prenom">Nom</label>
					<input type="text" name="prenom"  value='<?php echo $nom ?> 'required/>
				

					<label for="nom">Prénom</label>
					<input type="text" name="nom"  value='<?php echo $prenom ?> 'required/>
			
					<label for="password">Password</label>
					<input type="password" name="password" required/>

					<label for="passwordChange">New Password</label>
					<input type="password" name="passwordChange"/>
		
				<a class="aaa" href='index.php'> Accueil</a>
				<input type="submit" value="Edit" name="submitBtn" />
			
			</form>
		</div>
        
</body>
	
</html>
<?php


if (isset($_POST['password'])) {
        
    //Si la confirmation de l'ancien mdp est le même que celui qui se trouve dans la base de données 
        if ($post === $actuel)  {

            //Alors on va vérifier la condition qui permet de changer les informations du profil 

            //Si le submit est "lancer"
            if (isset($_POST['submitBtn'])) {

                //On créer de nouvelle variable pour les "$_POST"
//--------------------------------------------------------------------------------------------------------------------------------------------
                
                $nom10 = htmlspecialchars($_POST['nom']);
                $prenom10 = htmlspecialchars ($_POST['prenom']);
                $password10 = htmlspecialchars($_POST['passwordChange']);
                $login10 = htmlspecialchars ($_POST['login']);
                $lastpass = htmlspecialchars ($_POST['password']); //On créer une variable $lastpass pour l'utiliser dans la requète. Ainsi si il est identique au mot de passe se trouvant dans la BDD la requète est true, autrement elle est false. 

//--------------------------------------------------------------------------------------------------------------------------------------------
                $requete = "UPDATE utilisateurs SET login='$login10', prenom='$prenom10', nom ='$nom10', password= '".hash('sha256', $password10)."' WHERE  login = '$sesslogin' and password = '".hash('sha256' , $lastpass)."'"; //On applique une double condition sur le login et le mdp au sein de la requète. 
        
    
                $req2= mysqli_query($bdd, $requete);
    
        
            }
        } 
        else {
        echo "ERREUR = Le mot de passe est inconnue." ; 
        }
    }
?>    