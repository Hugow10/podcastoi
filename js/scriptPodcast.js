
function affiFormAddFlux(){
	var form = document.createElement("form"); 
	form.setAttribute("id", "formAjoutFlux");
	form.setAttribute("class", "form-inline formAjoutFlux");
	form.setAttribute("method", "POST");
	form.setAttribute("action","podcast.php");
			
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
	var input= document.createElement("input");
	input.setAttribute("class","form-control");
	input.setAttribute("name","url");
	input.setAttribute("placeholder","Url du fichier XML");

	var input2= document.createElement("input");
	input2.setAttribute("class","form-control");
	input2.setAttribute("name","nomAbonnement");
	input2.setAttribute("placeholder","Nom de l'abonnement");

	var btn = document.createElement("input");
	btn.setAttribute("type","submit");
	btn.setAttribute("name","ajoutFlux");
	btn.setAttribute("class","btn btn-primary");
	

	var cible = document.getElementById("option-podcast");
	cible.appendChild(form); 
	form.appendChild(div);
	//div.appendChild(label);
	div.appendChild(input);
	//div.appendChild(label2);
	div.appendChild(input2);
	div.appendChild(btn);	

	cible = document.getElementById("addFormAjoutFlux");
	cible.setAttribute("onclick","supprFormAddFlux();");
	cible = document.getElementById("addFormAjoutFluxImage");
	cible.setAttribute("class","glyphicon glyphicon-remove");

}

function supprFormAddFlux(){
	var cible = document.getElementById("addFormAjoutFluxImage");
	cible.setAttribute("class","glyphicon glyphicon-plus");
	var cible = document.getElementById("option-podcast");
	cible.removeChild(document.getElementById('formAjoutFlux'));
	cible = document.getElementById("addFormAjoutFlux");
	cible.setAttribute("onclick","affiFormAddFlux();");


}

function confirmationSuppr(id){
	var choix=confirm("Etes-vous sur de vouloir supprimer ce podcast "+id);

}
