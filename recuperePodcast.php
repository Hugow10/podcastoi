<?php
include 'connexionBDD.php';
include 'podcast.php';
if(isset($_POST['url'])){

    $url=htmlentities($_POST['url']);
    $podcast= new Podcast("","","","","","");

    $podcast->recuperePodcast($url);
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
        <h1>Recuperer un Podcast</h1>
        
        <form method="POST" action="recuperePodcast.php">
            URL du podcast: <input type="textfield" name="url" placeholder="flux-rss.xml">
            <input type="submit" name="valider">
        </form>
    </body>
</html>