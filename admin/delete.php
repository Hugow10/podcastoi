<?php
if(!empty($_GET['id']))
    {
       include('connexion.php');
	   
	   $id = intval($_GET['id']);
				 $sql = $bdd->prepare("DELETE FROM Utilisateur WHERE id=? ");
				 $sql->execute(array($id));	
                header('location:liste_u.php');             
	}
    
?>