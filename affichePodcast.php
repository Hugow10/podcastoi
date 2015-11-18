<?php
include 'connexionBDD.php';
include 'podcast.php';
if(isset($_POST['id'])){

    $id=htmlentities($_POST['id']);
    $pc_temp= new Podcast("","","","","","");
    $pc = $pc_temp->getById($id);

    $titre = $pc->getTitre();
    $date = $pc->getDate();
    $desc= $pc->getDescription();
    $auteur=$pc->getAuteur();
    $categ=$pc->getCategorie();
    $url=$pc->getUrl();

    var_dump($pc);
}
else{
    $titre = "";
    $date = "";
    $desc= "";
    $auteur="";
    $categ="";
    $url="";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Podcast</title>
    </head>
    <body>
        <header>
            <ul>
                <li><a href ='index.php'>Accueil</a></li>
                <li><a href ='recuperePodcast.php'>Recupperer un podcast</a></li>
                <li><a href ='affichePodcast.php'>Afficher un podcast</a></li>
            </ul>
        </header>

        <form method="POST" action="affichePodcast.php">
            Id du podcast: <input type="textfield" name="id" placeholder="id du podcast">
            <input type="submit" name="valider">
        </form>
        <h1>Informations du podcast</h1>

        <p>Titre: <?php echo($titre); ?></p>
        <p>Date: <?php echo($date); ?></p>
        <p>Auteur: <?php echo($auteur); ?></p>
        <p>Description: <?php echo($desc); ?></p>
        <p>Catégorie: <?php echo($categ); ?></p>
        <p>Url: <a href=<?php echo($url); ?>>url du podcast </a></p>
        <p>
        	<audio controls="controls">
        		<source src="<?php echo($url); ?>" type="audio/mp3"/>
        	<audio>
        </p>
        <p>Téléchargement: <a href="telechargerPodcast.php?url=<?php echo($url); ?>&titre=<?php echo($titre); ?>"> télécharger ce podcast </a></p>




    </body>
</html>