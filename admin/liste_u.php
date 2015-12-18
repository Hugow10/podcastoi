<?php
include('connexion.php');
?>

<html>
    <head>
        <meta charset="utf-8" />
        <title>Liste</title>
	</head>
	<body>
		<div>
		<h2> <center>Admin</center></h2>
		<table class="table table-bordered" border="1">
		<thead>
		<tr><th>ID</th> <th>pseudo</th><th>Nom</th><th>Prenom</th><th>Admin</th><th>Suprimer</th></tr>  
		<tbody>
			<?php 
				$sql = $bdd->prepare("SELECT id, pseudo, u_nom, u_prenom FROM Utilisateur");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_OBJ);
				
				$sqlA = $bdd->prepare("SELECT id, admin FROM Administration");
				$sqlA->execute();
				$sqlA->setFetchMode(PDO::FETCH_OBJ);

				while($res = $sql->fetch() )
				{
					echo '<tr> <td>'.$res->id.'</td>
								<td>'.$res->pseudo.'</td>
								<td>'.$res->u_nom.'</td>
								<td>'.$res->u_prenom.'</td>
								<td><a href="admin.php?id=';
								?>
								<?php
								while($resA = $sqlA->fetch())
								{
									if($res->id==$resA->id && admin==1){echo '<td><a href="admin.php?id='.$res->id.'">"oui"</a></td>';}
									else{echo '<td><a href="admin.php?id='.$res->id.'">"non"</a></td>';}
								}
					echo			'<td><a href="delete.php?id='.$res->id.'">Suprimer</a></td>
						 </tr>';	
				}	
			?>
		</tbody>
		</table>
		</div>
		<div>
		<h2> <center>Gestion podcast</center></h2>
		<table class="table table-bordered" border="1">
		<thead>
		<tr><th>ID podcast</th><th>url</th><th>Black Liste</th></tr>  
		<tbody>
			<?php 
				$sql = $bdd->prepare("SELECT id_pod, url FROM Podcast");
				$sql->execute();
				$sql->setFetchMode(PDO::FETCH_OBJ);
				
				$sqlA = $bdd->prepare("SELECT id_pod FROM BlackListe");
				$sqlA->execute();
				$sqlA->setFetchMode(PDO::FETCH_OBJ);
				while($res = $sql->fetch() )
				{
					echo '<tr> <td>'.$res->id_pod.'</td>
								<td>'.$res->url.'</td>';?>
			<?php
					while($resA = $sqlA->fetch())
						{
							if($res->id_pod==$resA->id_pod){echo '<td><a href="blackliste.php?id='.$res->id_pod.'">"oui"</a></td>';}
									else{echo '<td><a href="blackliste.php?id='.$res->id_pod.'">"non"</a></td>';}
								}
						  </tr>';
			?>
		
		</tbody>
		</table>
		</div>
	</body>
</html>