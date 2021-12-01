<?php
session_start();//On ouvre une session
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Connexion" content="Page de connexion">
    <link rel="stylesheet" href="moduleconnexion.css">
    <title>Page de connexion</title>
</head>



<body>      
<form method="POST" action="">
        <label for="login">Login</label>
        <input type="text" name="login" required>

        <label for="password">Mot de passe</label>
        <input type="password" name="password" required>


        <input type="submit" name="submit" value="Connexion">
    </form> 
</body>    
</html>
<?php
//On atteste de l'existence de ces variables
$login = isset($_POST['login']);
$password = isset($_POST['password']);

//Je récupère la page "configuration.php pour me connecter à la base de données
require_once('configuration.php');


if (isset($_POST['login'],$_POST['password'])){

$login = stripslashes($_POST['login']);//Retire les antislashes des formulaires
$login = mysqli_real_escape_string($bdd, htmlspecialchars ($login));//Permet de rendre compréhensibles les caractères spécieux pour la BDD, on rajoute 'htmlspecialchars' pour empêcher les injections SQL

$password = stripslashes($_POST['password']);//Retire les antislashes des formulaires
$password = mysqli_real_escape_string($bdd, htmlspecialchars($password));//Permet de rendre compréhensibles les caractères spécieux pour la BDD, on rajoute 'htmlspecialchars' pour empêcher les injections SQL

//On prépare la requête SQL et on "hash" le mot de passe pour le sécurisé
$query = "SELECT * FROM `utilisateurs` WHERE login='$login' and password='".hash('sha256', $password)."'";

//On fait la requête à la base de données.
$result = mysqli_query($bdd,$query) or die(mysql_error());

//On récupère les données requises à la base de données
$rows = mysqli_num_rows($result);

//On vérifie si la ligne qui contient les login et mot de pass existent, si c'est le cas l'utilisateur est enregistré
    if($rows==1){   

        $_SESSION['login'] = $login; //On créer une SESSION login

        $_SESSION ["id"] = $res [0][0];

        header("Location:index.php"); //On redirige l'utilisateur vers l'index une fois que la connexion est validée.


    }
    else{
    echo "Le login ou le mot de passe est incorrect.";
    }
}

?>