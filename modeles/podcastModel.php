<?php

mb_internal_encoding("UTF-8");
//Classe Podcast
class Podcast {
	private $titre;
	private $date;
	private $description;
	private $auteur;
	private $categorie;
	private $url;

	//Constructeur
	public function __construct($titre,$date,$desc,$aut,$categ,$url){
		$this->titre=$titre;
		$this->date=$date;
		$this->description=$desc;
		$this->auteur=$aut;
		$this->categorie=$categ;
		$this->url=$url;
	}


	public function recuperePodcast($url_flux,$nom_abonnement){
		if(!empty($url_flux)){
			//On recupere le nom de l'abonnement
			$nom_abo = $nom_abonnement;
			//On recupère le flux RSS
			$flux = new DomDocument();
			$flux->load($url_flux);
			$flux->preservedWhiteSpace=false;
			$i=0;
			$pc = $flux->getElementsByTagName('item')->item($i);
			
			while(!is_null($pc)){

				$titre = mysql_real_escape_string($pc->getElementsByTagName('title')->item(0)->nodeValue);
				$date = mysql_real_escape_string($pc->getElementsByTagName('pubDate')->item(0)->nodeValue);
				$desc= mysql_real_escape_string($pc->getElementsByTagName('description')->item(0)->nodeValue);
				$auteur=mysql_real_escape_string($pc->getElementsByTagName('author')->item(0)->nodeValue);
				$categ=mysql_real_escape_string($pc->getElementsByTagName('category')->item(0)->nodeValue);
				$url=mysql_real_escape_string($pc->getElementsByTagName('enclosure')->item(0)->getAttribute('url'));
				
				
				//Ajout base
				$sql= "INSERT INTO podcast(titre,auteur,date,description,url,id_genre,comments) VALUES('$titre','$auteur', '$date', '$desc', '$url', '$categ',' rien ')";
				@mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
				$id_podcast=mysql_insert_id();

				$sql2= "INSERT INTO abonnement(id_util,id_pod,url,nom_abo) VALUES('1','$id_podcast', '$url_flux', '$nom_abo')";
				@mysql_query($sql2) or die('Erreur requete SQL'."  ".mysql_error());
				
				
				$i=$i+1;
				$pc = $flux->getElementsByTagName('item')->item($i);
			}

		}

	}

	public function getById($id){
		if(!empty($id)){

			$sql= "SELECT * FROM podcast WHERE id_pod='$id'";
			$result=@mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
			$pc;
			while($ligne= mysql_fetch_row($result)){
				$pc=new Podcast($ligne[1],$ligne[3],$ligne[4],$ligne[2],$ligne[6],$ligne[5]);
			}
		}
		return $pc;
	}

	public function supprimePodcast($id){
		if(!empty($id)){
			$sql="DELETE FROM podcast WHERE id_pod='$id'";
			$sql2="DELETE FROM abonnement WHERE id_pod='$id'";
			$result=@mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
			$result2=@mysql_query($sql2) or die('Erreur requete SQL'."  ".mysql_error());
		}
	}

	public function getTitre(){
		return $this->titre;
	}
	public function getDate(){
		return $this->date;
	}
	public function getDescription(){
		return $this->description;
	}
	public function getAuteur(){
		return $this->auteur;
	}
	public function getCategorie(){
		return $this->categorie;
	}
	public function getUrl(){
		return $this->url;
	}

}
?>