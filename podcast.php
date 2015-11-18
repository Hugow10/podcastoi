<?php

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
	//Methode permettant d'afficher les informations d'un podcast
	function afficher(){
		echo("
			Affichage Podcast:
			<br />
			titre: $this->titre
			<br />
			date: $this->date
			<br />
			description: $this->description 
			<br />
			url: $this->url
			<br />
			<a href=\"dl.php?url=$this->url&name=$this->titre\">download</a>
			");
	}

	public function recuperePodcast($url){
		if(!empty($url)){
			//On recupère le flux RSS
			$flux = new DomDocument();
			$flux->load($url);
			$flux->preservedWhiteSpace=false;
			$pc = $flux->getElementsByTagName('item')->item(0);
			$titre = $pc->getElementsByTagName('title')->item(0)->nodeValue;
			$date = $pc->getElementsByTagName('pubDate')->item(0)->nodeValue;
			$desc= $pc->getElementsByTagName('description')->item(0)->nodeValue;
			$auteur=$pc->getElementsByTagName('author')->item(0)->nodeValue;
			$categ=$pc->getElementsByTagName('category')->item(0)->nodeValue;
			$url=$pc->getElementsByTagName('enclosure')->item(0)->getAttribute('url');

			//Ajout base
			$sql= "INSERT INTO podcast(titre,auteur,date,description,url,id_genre,comments) VALUES('$titre','$auteur', '$date', '$desc', '$url', '0',' rien ')";
			@mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
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