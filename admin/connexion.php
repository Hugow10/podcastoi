<?php
try {
	
	$bdd= new PDO('mysql:host=infodb.iutmetz.univ-lorraine.fr;port=3306;dbname=eljilali1u_projetS3','eljilali1u_appli','19952800h');
	
	
	
}catch (Exception $e) {
	
	die($e->getMessage());
}

?>