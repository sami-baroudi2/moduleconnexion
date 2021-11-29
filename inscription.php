<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="inscription" content="Formulaire d'inscription">
    <title>Mon formulaire d'inscription</title>
</head>
<body>
<?php
//Je récupère la page "configuration.php pour me connecter à la base de données
require('configuration.php'); 



//Je vérifie que les requètes existent 
if (isset($_REQUEST['login'] , $_REQUEST['nom'] , $_REQUEST['prenom'] , $_REQUEST['password'])) {

    $login = stripslashes($_REQUEST['login']); //Retire les antislashes des formulaires

    $login = mysqli_real_escape_string($bdd , htmlspecialchars($login)); //Permet de rendre compréhensibles les caractères spécieux pour la BDD

    $nom = stripslashes($_REQUEST['nom']);//Retire les antislashes des formulaires

    $nom = mysqli_real_escape_string($bdd , htmlspecialchars ($nom)); //Permet de rendre compréhensibles les caractères spécieux pour la BDD

    $prenom = stripslashes($_REQUEST['prenom']);//Retire les antislashes des formulaires

    $prenom = mysqli_real_escape_string($bdd , htmlspecialchars ($prenom)); //Permet de rendre compréhensibles les caractères spécieux pour la BDD

    $password = stripslashes($_REQUEST['password']);//Retire les antislashes des formulaires

    $password = mysqli_real_escape_string($bdd , htmlspecialchars ($password));//Permet de rendre compréhensibles les caractères spécieux pour la BDD
   


    
    if (isset($_POST['login'])) {

        $query = "SELECT login FROM `utilisateurs` WHERE login='$login'";//Ecriture de la requête 

        $result = mysqli_query($bdd,$query) or die(mysql_error());//Requête à la base de données 

        $rows = mysqli_num_rows($result);
        if($rows==1){   
            echo "Ce nom d'utilisateur est déjà attribué, veuillez en choisir un autre";
        }
        else{
        
        //Je vérifie que les "POST" existent pour faire comprendre à PHP que la valeur est "null" et non pas inexistante (--> erreur)
        if (isset($_POST['password'] , $_POST['password2'])){

            $password = htmlspecialchars($_POST['password']); //On rajoute htmlspecialchars pour empêcher les injections SQL

            $confirmation = htmlspecialchars($_POST['password2']); //On rajoute htmlspecialchars pour empêcher les injections SQL
        
        
            //On vérifie si les mot de passe sont les mêmes 
            if ($password == $confirmation ) {

                //Requète SQL qui va permettre d'insérer des valeurs dans la base de données
                $query = "INSERT into `utilisateurs` (login, nom, prenom , password)

                VALUES ('$login', '$nom', '$prenom' ,  '".hash('sha256', $password)."')";
                //Utilisation de ".hash" pour 'hacher' le mot de passe dans la base de données


                 
                //Requète pour récupérer les données de la BDD
                $res = mysqli_query($bdd , $query);

                    echo "<div class='sucess'>
                     <h3>Vous êtes inscrit avec succès.</h3>
                      <p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
                    </div>";

                    
            }

            //Si les mot de passe ne sont pas les mêmes on affiche un message d'erreur et la requête ne s'effectue pas car la condition est "false"
            else{
                echo "ERREUR = Le mot de passe que vous avez attribué n'est pas le même dans les deux champs.";
            }
        }
        
    
    }

}
}    



    

?>


    <form method="POST" action="">
        <label for="login">Login</label>
        <input type="text" name="login" required>

        <label for="nom">Nom</label>
        <input type="text" name="nom" required>

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>

        <label for="password2">Confirmation</label>
        <input type="password" name="password2" required>

       

        <input type="submit" name="submit" value="Je m'inscris !">
    </form> 
</body>    
</html>
