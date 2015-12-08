<link rel="stylesheet" type="text/css" href="style.css">
<body>
	<form method="post" action="connexion.php" >
		<label><br/><br/><input type="text" name="mail"/></label><br/><br/>
		<label><br/><br/><input type="password" name="passe"/></label><br/><br/>
		<a href="podcast.php" > <input type="submit" value="Valider" name ="valider"/> </a><br/><br/>
		<a href="accueil.php"><input type="button" name="Retour" value="Retour"/></a> 

	</form>
</body>

	<?php

		try
		{	//LocalHost:
			/*
			$bdd= new PDO('mysql:host=localhost;dbname=podcast;charset=utf8', 'root', '');
			*/
			// http://podcastoi.cyril-minette.net:
			$bdd= new PDO('mysql:host=db.cyril-minette.net;dbname=podcastoi;charset=utf8', 'podcastoi', 'GaeJxHm4');
			$connect = false;
		}
		catch (Exception $e)
		{
		    die('Erreur : ' . $e->getMessage());
		}
	?>
	<?php

		if (isset($_POST['username']))
		{
			$_SESSION['username']= $_POST['username'];
			$_SESSION['password']= $_POST['password'];
			$IDok = false;
			

			$reponse = $bdd->query('SELECT * from client');
			while($client = $reponse -> fetch())	
			{
				
				if( $username == $client['mail'])
				{	

					$IDok=true;
					if( sha1($password) == $client['mdp'])
					{
						$connect = true;
						
					}
					else
					{
						echo("Mot de Passe incorrect");
					}
				}
			}
			
		}
			
	?>
</form>