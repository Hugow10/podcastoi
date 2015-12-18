<?php
if(!empty($_GET['id_pod']))
    {
       include('connexion.php');
	   
	   $id = intval($_GET['idpod']);
				 $sql1 = $bdd->prepare("SELECT id_pod FROM Administration WHERE id_pod=? ");
				 $sql1->execute(array($id));
				 $sql1->setFetchMode(PDO::FETCH_OBJ);
				 while($res = $sql1->fetch() ){
					if($res->admin==1)
					{
						$sql2 = $bdd->prepare("DELETE FROM BlackListe WHERE id_pod=? ");
						$sql2->execute(array($id));
					}else
					{
						$sql3 = $bdd->prepare("INSERT INTO BlackListe (id_bp, id_pod) VALUES ('',?); ");
						$sql3->execute(array($id));
					}
                header('location:liste_u.php');
			
               
             }
    }
?>