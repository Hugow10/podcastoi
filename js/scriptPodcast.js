/*
Fonction permetant d'afficher un formulaire
afin d'ajouter des podcasts à partir d'un 
flux rss.
*/
function affiFormAddFlux(){
	//Création formulaire + attributs
	var form = document.createElement("form"); 
	form.setAttribute("id", "formAjoutFlux");
	form.setAttribute("class", "form-inline formAjoutFlux");
	form.setAttribute("method", "POST");
	form.setAttribute("action","podcast.php");
	//Création div + attributs		
	var div = document.createElement("div");
	div.setAttribute("class","form-group");
	
	/*
	On affiche plus les labels de ce formulaire car
	l'information est redondante avec les 
	placeholder des inputs.

	var label = document.createElement("label");
	label.setAttribute("class","col-sm-2 control-label");
	label.innerHTML="Url: ";
	
	var label2 = document.createElement("label");
	label2.setAttribute("class","col-sm-2 control-label");
	label2.innerHTML="Nom: ";
	*/	

	//Création input url + attributs	
	var input= document.createElement("input");
	input.setAttribute("type","text");
	input.setAttribute("class","form-control");
	input.setAttribute("name","url");
	input.setAttribute("id","url");
	input.setAttribute("placeholder","Url du fichier XML");
	//Création input nom + attributs
	var input2= document.createElement("input");
	input2.setAttribute("type","text");
	input2.setAttribute("class","form-control");
	input2.setAttribute("name","nomAbonnement");
	input2.setAttribute("id","nomAbonnement");
	input2.setAttribute("placeholder","Nom de l'abonnement");
	//Création submit + attributs
	var btn = document.createElement("input");
	btn.setAttribute("type","submit");
	btn.setAttribute("name","ajoutFlux");
	btn.setAttribute("id","ajoutFlux");
	btn.setAttribute("value","Importer");
	btn.setAttribute("class","btn btn-primary");

	var cible = document.getElementById("option-podcast");
	cible.appendChild(form); 	//ajout du formulaire
	form.appendChild(div);		//ajout div dans le formulaire
	//div.appendChild(label);
	div.appendChild(input);		//ajout input1 dans le formulaire
	//div.appendChild(label2);
	div.appendChild(input2);	//ajout input2 dans le formulaire
	div.appendChild(btn);		//ajout submit dans le formulaire

	cible = document.getElementById("addFormAjoutFlux");
	//on change la fct du bouton d'affichage du formulaire -> suppression du formulaire
	cible.setAttribute("onclick","supprFormAddFlux();");
	cible = document.getElementById("addFormAjoutFluxImage");
	//on change l'icon du bouton d'affichage du formulaire -> le "+" devient "x"(suppression)
	cible.setAttribute("class","glyphicon glyphicon-remove");

	/*
	Debut de code en Jquery
	Concerne le Web Service
	*/
	(function($){
	$('#formAjoutFlux').on('submit',function(event){

		var url=$("#url").val();
		var nom=$("#nomAbonnement").val();
		/*
		if( (url.trim() == "") && (nom.trim() == "") ){
			event.preventDefault();
		}
		else{*/
			//on annule l'action du formulaire
			event.preventDefault();
			//on change la valeur du bouton submit
			$('#ajoutFlux').attr('value','Chargement');
			//@ du service web
			var wsUrl='webService.php';
			//POST au web service avec en paramètre les données des inputs, les données retournées sont au formet json
			$.post(wsUrl,$('#formAjoutFlux').serializeArray(),'json')
				//Succés:
				.done(function(data, text,jqxhr){
					//On recupère la réponse retournée par le WS
					var obj = jQuery.parseJSON(jqxhr.responseText);
					//Affichage de la réponse dans une alerte
					alert(obj.status+" "+obj.status_message);
				})
				//Echec:
				.fail(function(jqxhr){
					//On recupère la réponse retournée par le WS
					var obj = jQuery.parseJSON(jqxhr.responseText);
					//Affichage de la réponse dans une alerte
					alert(obj.status+" "+obj.status_message);
				})
				//Dans tous les cas:
				.always(function(){
					//on remet le texte d'origine dans le btn submit
					$('#ajoutFlux').attr('value','Importer');
				});
				//Rafraichissement d'une partie de la page (NE FONCTIONNE PAS ENCORE...)
				$('#content-table').load('../podcast.php #content-table');

			
		//}
	});
	})(jQuery);

}

/*
Fonction permetant de supprimer un formulaire
permetant d'ajouter des podcasts à partir d'un 
flux rss.
*/
function supprFormAddFlux(){
	var cible = document.getElementById("addFormAjoutFluxImage");
	//on change l'icon du bouton de suppression du formulaire -> le "x" devient "+"(affichage/ajout)
	cible.setAttribute("class","glyphicon glyphicon-plus");
	var cible = document.getElementById("option-podcast");
	//on supprime le formulaire de la page
	cible.removeChild(document.getElementById('formAjoutFlux'));
	cible = document.getElementById("addFormAjoutFlux");
	//on change la fct du bouton de supression du formulaire -> affichage du formulaire
	cible.setAttribute("onclick","affiFormAddFlux();");


}


/*
Fonction permettant de séléctionner un podcast
*/
/*
function selectionPodcast(){


}
*/


