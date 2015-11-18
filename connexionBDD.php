<?php
//Fichier de connexion
//IUT

$connect=@mysql_connect('localhost','root','') or die("Erreur de connexion au serveur.");
@mysql_select_db('podcast',$connect) or die ("Erreur de connexion a la base.");





?>