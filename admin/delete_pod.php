<?php
if(!empty($_GET['id']))
    {
       include('connexion.php');
	   
	   $id = intval($_GET['id']);
				 $sql = $bdd->prepare("DELETE FROM Podcast WHERE id_pod=? ");
				 $sql->execute(array($id));	
                header('location:liste_u.php');
			
               
	}
    
?>