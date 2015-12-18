<?php
include ("modeles/podcastModel.php");
include ("connexionBDD.php");


//si la requete est valide pour un ajout de podcast:
if( (isset($_POST['url'])) && (isset($_POST['nomAbonnement'])) ){
	
	//si l'url est correcte
	if( (!empty($_POST['url'])) && (!empty($_POST['nomAbonnement']))){
		$url=htmlentities($_POST['url']);
		$nom=htmlentities($_POST['nomAbonnement']);
		$podcast= new Podcast("","","","","","");
		$podcast->recuperePodcast($url,$nom);
		wsReponse(200,'Requete valide',NULL);
	}
	//si l'url est incorrecte
	else{
		wsReponse(500,'Requete invalide',NULL);
	}
	
}
//si la requete est valide pour séléctionner un podcast:
else if(isset($_POST['podcast'])){
	$id=$_POST['podcast'];
}
//si la requete n'est pas valide:
else{
	wsReponse(500,'Internal Server Error',NULL);
}

		


function wsReponse($status, $status_message, $data){
	header('HTTP/1.1 $status $status_message',true,$status);

	$reponse['status']=$status;
	$reponse['status_message']=$status_message;
	$reponse['data']=$data;
	$reponse_json=json_encode($reponse);
	echo $reponse_json;

}

?>