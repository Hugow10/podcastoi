<html>

<head> 
	<title> Inscription </title>
</head>

	<body>
		<h1> Formulaire d'inscription </h1>
		<form method="post" action="inscription.php">
			<label>Nom: <br/><input type="text" name="nom"/></label><br/><br/>
			<label>Prenom: <br/><input type="text" name="prenom"/></label><br/><br/>
			<label>Adresse e-mail: <br/><input type="text" name="mail"/></label><br/><br/>
			<label>Mot de passe: <br/><input type="password" name="passe"/></label><br/><br/>
			<label>Confirmation du mot de passe: <br/><input type="password" name="passe2"/></label><br/><br/>
			<label>Tel. portable: <br/><input type="int" name="portable"/></label><br/><br/>
			<label>Pseudo: <br/><input type="text" name="pseudo"/></label><br/><br/>
			<label>Date de naissance: <br/><input type="date" name="date"/></label><br/><br/>
			<input type="submit" value="Valider" name ="valider"/><br/><br/>
 			<a href="accueil.php"><input type="button" name="Retour" value="Retour"/></a> 

		</form>
	</body>
</html>

<?php

if(!empty($_POST['mail']))
{

$base= mysqli_connect("localhost", "root");
mysqli_select_db($base, "podcast");

$passe = mysqli_real_escape_string($base,htmlspecialchars($_POST['passe']));
$passe2 = mysqli_real_escape_string($base, htmlspecialchars($_POST['passe2']));
if($passe == $passe2)
{
$nom = mysqli_real_escape_string($base, htmlspecialchars($_POST['nom']));
$prenom = mysqli_real_escape_string($base, htmlspecialchars($_POST['prenom']));
$pseudo = mysqli_real_escape_string($base, htmlspecialchars($_POST['pseudo']));
$mail = mysqli_real_escape_string($base, htmlspecialchars($_POST['mail']));
$portable = mysqli_real_escape_string($base, htmlspecialchars($_POST['portable']));
$date = mysqli_real_escape_string($base, htmlspecialchars($_POST['date']));
//crypter le mot de passe
$passe = sha1($passe);
//Ajouter un cell pour le mdp + Jquerry validate

mysqli_query($base , "INSERT INTO client (`nom`, `prenom`, `numport`, `pseudo`, `datenaissance`, `point`, `mail`, `mdp`, `valide`) VALUES ('$nom', '$prenom', '$portable', '$pseudo', '$date', '', '$mail', '$passe', FALSE)");

echo 'Votre inscription à bien été prise en compte, retournez à la page d\'accueil pour vous connecter.';
}

else
{
echo 'Les deux mots de passe que vous avez rentrés ne correspondent pas…';
}
}

?>