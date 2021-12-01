<?php
	
	session_start();
	if($_SESSION["login"] != "admin")
	{
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
		<div id="mainWrapper">
			<div id="mainTitle">
				<a href="index.php" id="title"><h1>Vente Privé</h1></a>
			</div>
<?php			

		
    $req = mysqli_query($bdd , "SELECT * FROM utilisateurs");
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
    foreach($res AS $key => $value){
        echo '<tr>';
        foreach($value AS $key2 => $value2){
        echo '<th>'.$value2.'</th>';
        }
        echo '</tr>';
    }
    ?>  
</tbody>    
</table>
	</div>
	</body>
</html>