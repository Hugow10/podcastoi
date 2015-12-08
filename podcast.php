<?php 
include ("vues/header.php");
include ("vues/aside.php"); 
include ("vues/footer.php");
include ("connexionBDD.php");
include ("modeles/podcastModel.php");

$titrePod="";
$auteurPod="";
$datePod="";
$descPod="";
$urlPod="";
if( (isset($_POST['url'])) && (isset($_POST['nomAbonnement'])) ){

    $url=htmlentities($_POST['url']);
    $nomAbonnement=htmlentities($_POST['nomAbonnement']);
    $podcast= new Podcast("","","","","","");

    $podcast->recuperePodcast($url,$nomAbonnement);
    
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
		<link rel="stylesheet" type="text/css" href="styles/bootstrap/css/bootstrap.min.css"/>
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<script type="text/javascript" src="js/scriptPodcast.js"></script>
	</head>

	<body> 
			<section>
			<!-- util ? -->
			<div class="divchaine">
				<p> Nom de la chaine <p>
					<!-- util ? -->
				<!-- <input type="button" name="subscribe" value="S'abonner" class="btn btn-warning" > -->
			</div>

			
				<br />
				<div name='info-podcast'>
					<label class="col-md-1">Titre:</label><p><?php echo $titrePod; ?></p>
					<label class="col-md-1">Date:</label><p><?php echo $datePod; ?></p>
					<label class="col-md-1">Auteur:</label><p><?php echo $auteurPod; ?></p>
					<label class="col-md-1">Description:</label><p><?php echo $descPod; ?></p>
				</div><br />
				<div name="lecteur">
					<audio controls>
					    <source src=<?php echo $urlPod; ?>>
					</audio>
				</div><br />

				<div id="option-podcast">
					<button type="button" id="addFormAjoutFlux"class="btn btn-default" onclick="affiFormAddFlux();"><span id="addFormAjoutFluxImage" class="glyphicon glyphicon-plus"></span></button>
					<button type="button" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
					<a href="telecharger.php?url=<?php echo $urlPod; ?>&titre=<?php echo $titrePod; ?>"><button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-cloud-download"></span></button></a>
				</div><br />

				<div class="container">

					<?php

					//nombre de podcast que l'on affiche sur une page
					$podcastParPage=20;
					//nombre total de podcasts à afficher
					$nbPodcastTotal = mysql_query("SELECT COUNT(*) AS total FROM podcast, abonnement WHERE id_util=1 AND podcast.id_pod = abonnement.id_pod"); 
					$podcastTotal=mysql_fetch_assoc($nbPodcastTotal);
					//on recupère le total des éléments à afficher
					$total=$podcastTotal['total'];
					//On definie le nombre de pages pour la pagination
					$nombreDePages=ceil($total/$podcastParPage);
					//si la page (pagination) est définie
					if(isset($_GET['page'])){
					        //on définie la page actuelle
					        $pageActuelle=intval($_GET['page']);
					        //si la page actuelle est supérieure au nombre de page
					        if($pageActuelle>$nombreDePages){
					                //page actuelle = dernière page
					                $pageActuelle=$nombreDePages;
					        }
					}
					else{
					        //page actuelle = première page
					        $pageActuelle=1;
					}
					//On calcul la première entrée à lire
					$premiereEntree=($pageActuelle-1)*$podcastParPage;
					// La requête sql pour récupérer les messages de la page actuelle
					$sql="SELECT podcast.id_pod, titre, date FROM podcast, abonnement WHERE id_util=1 AND podcast.id_pod = abonnement.id_pod LIMIT ".$premiereEntree.', '.$podcastParPage.'';
					$resultat = @mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
					?>

					<table class="table table-hover">
						<tr>
						    <th>Titre</th> 
						    <th>Date</th>
						    <th>Séléction</th>
						    <th>Suppression</th>
						</tr>
						<?php
						
						if($resultat){
							while($donnees=mysql_fetch_assoc($resultat)){
								echo("<tr>");
								echo("<td>".$donnees['titre']."</td>");
								echo("<td>".$donnees['date']."</td>");
								echo("<td><a href='podcast.php?page=".$pageActuelle."&podcast=".$donnees['id_pod']."'><button class='btn btn-primary'>Séléctionner</button></a></td>");
								echo("<td><a href='supprimer.php?&pod_supr=".$donnees['id_pod'] ."'><button class='btn btn-default' > <span class='glyphicon glyphicon-remove' aria-hidden='true'></span></button></a></td>");
								echo("</tr>");
							}
						}
					

						?>
					</table>
					<!-- pagination -->
					<ul class="pagination">
						<li><a href="podcast.php?page=<?php $p=$pageActuelle-1; echo $p; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
						<?php 
				            for($i=1; $i<=$nombreDePages; $i++){
				        ?>
				        <li><a href="podcast.php?page=<?php echo $i ;?>"><?php echo $i ;?></a></li>
				        <?php
				            }

				          ?>
						<li><a href="podcast.php?page=<?php $p=$pageActuelle+1; echo $p; ?>" aria-label="Previous"><span aria-hidden="true">&raquo;</span></a></li>
					</ul>
				</div>
			</section>
	</body>
</html>