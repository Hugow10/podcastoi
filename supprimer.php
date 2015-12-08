<?php
include ("connexionBDD.php");
include ("modeles/podcastModel.php");
	if(isset($_GET['pod_supr'])){
    	$id=$_GET['pod_supr'];
    	$podcast= new Podcast("","","","","","");

    	$podcast->supprimePodcast($id);
    	header("location:podcast.php");
	}
?>