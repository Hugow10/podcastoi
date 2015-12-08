<?php
//Fichier de connexion

//LocalHost
/*
$connect=@mysql_connect('localhost','root','') or die("Erreur de connexion au serveur.");
@mysql_select_db('podcast',$connect) or die ("Erreur de connexion a la base.");
*/

// http://podcastoi.cyril-minette.net:

$connect=@mysql_connect('db.cyril-minette.net','podcastoi','GaeJxHm4') or die("Erreur de connexion au serveur.");
@mysql_select_db('podcastoi',$connect) or die ("Erreur de connexion a la base.");









?>