<?php
if(!empty($_GET['id']))
    {
       include('connexion.php');
	   
	   $id = intval($_GET['id']);
				 $sql1 = $bdd->prepare("SELECT admin FROM Administration WHERE id=? ");
				 $sql1->execute(array($id));
				 $sql1->setFetchMode(PDO::FETCH_OBJ);
				 while($res = $sql1->fetch() ){
					if($res->admin==1)
					{
						$sql2 = $bdd->prepare("UPDATE Administration SET admin='0' WHERE id=? ");
						$sql2->execute(array($id));
					}else
					{
						$sql3 = $bdd->prepare("UPDATE Administration SET admin='1' WHERE id=? ");
						$sql3->execute(array($id));
					}
                header('location:liste_u.php');
			
               
             }
    }
?>