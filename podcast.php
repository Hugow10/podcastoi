<?php 
include("header.php");
include("aside.php"); 
include("footer.php");
include 'connexionBDD.php';
include 'podcastModel.php';

$titrePod="";
$auteurPod="";
$datePod="";
$descPod="";
$urlPod="";
if(isset($_POST['url'])){

    $url=htmlentities($_POST['url']);
    $podcast= new Podcast("","","","","","");

    $podcast->recuperePodcast($url);
}

if(isset($_GET['podcast'])){
	$idPodSel=$_GET['podcast'];
	$sql2="SELECT * FROM podcast WHERE id_pod='$idPodSel'";
	$res2 = @mysql_query($sql2) or die('Erreur requete SQL'."  ".mysql_error());
	if($res2){
		while($data=mysql_fetch_assoc($res2)){
			$titrePod=$data['titre'];
			$auteurPod=$data['auteur'];
			$datePod=$data['date'];
			$descPod=$data['description'];
			$urlPod=$data['url'];
		}
	}
}


?>

<!DOCTYPE html>
<html>
	<head>
		<title> PodcastToi ! </title>
		<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/> 
		<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="js/scriptPodcast.js"></script>
	</head>

	<body> 
			<div class="divchaine">
				<p> Nom de la chaine <p>
				<input type="button" name="subscribe" value="S'abonner" class="btn btn-warning" >
			</div>

			<section >
				<br />
				<div name='info-podcast'>
					<label class="col-md-4">Titre: <?php echo $titrePod; ?></label><br /><br />
					<label class="col-md-4">Date: <?php echo $datePod; ?></label><br /><br />
					<label class="col-md-4">Auteur: <?php echo $auteurPod; ?></label><br /><br />
					<label class="col-md-4">Description: <?php echo $descPod; ?></label><br /><br />
				</div>
				<div name="lecteur">
					<audio controls>
					    <source src=<?php echo $urlPod; ?>>
					</audio>
				</div>

				<div id="option-podcast">
					<button type="button" id="addFormAjoutFlux"class="btn btn-default" onclick="affiFormAddFlux();"><span id="addFormAjoutFluxImage" class="glyphicon glyphicon-plus"></span></button>
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
					<a href="telecharger.php?url=<?php echo $urlPod; ?>&titre=<?php echo $titrePod; ?>"><button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-cloud-download"></span></button></a>
				</div>

				<table class="table table-hover">
					<tr>
					    <th>Titre</th> 
					    <th>Date</th>
					    <th>Séléction</th>
					</tr>
					<?php
					$sql="SELECT podcast.id_pod, titre, date FROM podcast, abonnement WHERE id_util=1 AND podcast.id_pod = abonnement.id_pod  ";
					$resultat = @mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
					
					if($resultat){
						while($donnees=mysql_fetch_assoc($resultat)){
							echo("<tr>");
							echo("<td>".$donnees['titre']."</td>");
							echo("<td>".$donnees['date']."</td>");
							echo("<td><a href='podcast.php?podcast=".$donnees['id_pod']."'><button class='btn btn-primary'>Séléctionner</button></a></td>");
							echo("</tr>");
						}
					}
				

					?>
				</table>
			</section>
	</body>
</html>