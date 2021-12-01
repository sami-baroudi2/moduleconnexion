<?php
//Connexion à la base de données


$bdd = mysqli_connect('localhost', 'root' , '' , 'moduleconnexion');

//Test de la base de données
if ($bdd === false) {
    die("Erreur : La connexion à la base de données à échouer." . mysqli_connect_error());
}
?>