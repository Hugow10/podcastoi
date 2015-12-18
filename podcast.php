<?php 
include ("vues/header.php");
include ("vues/aside.php"); 
include ("vues/footer.php");
include ("connexionBDD.php");
include ("modeles/podcastModel.php");
//include ("recupPodcastModel.php");

//$id = RecupUtilisateur("id");
$titrePod="";
$auteurPod="";
$datePod="";
$descPod="";
$urlPod="";
/*
if(isset($_POST['url'])){

    $url=htmlentities($_POST['url']);
    $podcast= new Podcast("","","","","","");

    $podcast->recuperePodcast($url);
}
*/

if(isset($_GET['podcast'])){
        $idPodSel=$_GET['podcast'];
        $sql2="SELECT * FROM podcast WHERE id_pod='$idPodSel'";
        $res2 = @mysql_query($sql2) or die('Erreur requete SQL'."  ".mysql_error());
        if($res2){
                while($data=mysql_fetch_assoc($res2)){
                        $titrePod=$data['titre'];
                        $auteurPod=$data['auteur'];
                        $datePod=$data['date'];
                        $descPod=$data['description'];
                        $urlPod=$data['url'];
                }
        }
}


?>

<!DOCTYPE html>
<html>
    <head>
            <title> PodcastToi ! </title>
            <meta http-equiv="Content-type" content="text/html; charset=UTF-8"/> 
            <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css"/>
            <link rel="stylesheet" type="text/css" href="styles/bootstrap/css/bootstrap.min.css"/>
            <link rel="stylesheet" type="text/css" href="styles/style.css">
            <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
            <script type="text/javascript" src="js/scriptPodcast.js"></script>    
            <script type="text/javascript" src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript">
              $(document).ready(function() {
                 $('#tableau').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bInfo": false,
                    "bAutoWidth": true,

                     "oLanguage": {
                         "sSearch": "Rechercher",
                          "sLengthMenu": "Afficher _MENU_ lignes",

                          "oPaginate": {
                           "sFirst": "Première page",
                           "sNext": "Suivant",
                           "sPrevious" : "Précédent"
                         }
                       }

                     });
                });
            </script>
    </head>

    <body> 
        <section>
        <!-- util ? -->
        <!-- <div class="divchaine">
                <p> Nom de la chaine <p>
                <input type="button" name="subscribe" value="S'abonner" class="btn btn-warning" >
        </div> -->

        
            <br />
            <div name='info-podcast'>
                    <label class="col-md-1">Titre:</label><p><?php echo $titrePod; ?></p>
                    <label class="col-md-1">Date:</label><p><?php echo $datePod; ?></p>
                    <label class="col-md-1">Auteur:</label><p><?php echo $auteurPod; ?></p>
                    <label class="col-md-1">Description:</label><p><?php echo $descPod; ?></p>
            </div><br />
            <div name="lecteur">
                    <audio controls>
                        <source src=<?php echo $urlPod; ?>>
                    </audio>
            </div><br />

            <div id="option-podcast">
                    <button type="button" id="addFormAjoutFlux"class="btn btn-default" onclick="affiFormAddFlux();"><span id="addFormAjoutFluxImage" class="glyphicon glyphicon-plus"></span></button>
                    <button type="button" class="btn btn-default"><span class="glyphicon glyphicon-refresh"></span></button>
                    <a href="telecharger.php?url=<?php echo $urlPod; ?>&titre=<?php echo $titrePod; ?>"><button type="button" class="btn btn-default" ><span class="glyphicon glyphicon-cloud-download"></span></button></a>
            </div><br />

            <div class="container" id="container">

                <?php
                // La requête sql pour récupérer les messages de la page actuelle
                $sql="SELECT podcast.id_pod, titre, date FROM podcast, abonnement WHERE id_util=1 AND podcast.id_pod = abonnement.id_pod ";
                $resultat = @mysql_query($sql) or die('Erreur requete SQL'."  ".mysql_error());
                ?>
                <div id='content-table'>
                    <table id="tableau" class="table table-hover" width="100%">
                        <thead>
                            <tr>
                                <th>Titre </th>
                                <th>Date</th>
                                <th width="10px">Selection </th>
                            </tr>
                        </thead>
                        <tbody>        
                            <?php
                            
                            if($resultat){
                                while($donnees=mysql_fetch_assoc($resultat)){
                                    echo("<tr>");
                                    echo("<td>".$donnees['titre']."</td>");
                                    echo("<td>".$donnees['date']."</td>");
                                    echo("<td><a href='podcast.php?podcast=".$donnees['id_pod']."'><button class='btn btn-primary' id='selection'>Séléctionner</button></a></td>");
                                    echo("</tr>");
                                }
                            }

                            ?>
                        </tbody>        
                    </table>
                </div>
            </div>
        </section>
    </body>
</html>


