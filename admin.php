<?php

session_start();
if ($_SESSION["login"] != "admin") {
    header("location:index.php");
}
require_once('configuration.php');

?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Administrateur" content="Page de l'administrateur">
    <link rel="stylesheet" href="moduleconnexion.css">
    <title>Administrateur</title>
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
    <a href="index.php" id="title">
        <h1>Accueil</h1>
    </a>
    </div>
    <?php


    $req = mysqli_query($bdd, "SELECT * FROM utilisateurs");
    $res = mysqli_fetch_all($req);
    ?>

    <!-- CREATION DU TABLEAU -->

    <table>
        <!-- entete du tableau -->
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">login</th>
                <th scope="col">Prenom</th>
                <th scope="col">Nom</th>
                <th scope="col">password</th>
            </tr>
        </thead>
        <!-- corps du tableau -->
        <tbody>
            <?php
            foreach ($res as $key => $value) {
                echo '<tr>';
                foreach ($value as $key2 => $value2) {
                    echo '<th>' . $value2 . '</th>';
                }
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
    </div>
</body>

</html>