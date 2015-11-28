
function affiFormAddFlux(){
	var form = document.createElement("form"); 
	form.setAttribute("id", "formAjoutFlux");
	form.setAttribute("class", "form-inline formAjoutFlux");
	form.setAttribute("method", "POST");
	form.setAttribute("action","podcast.php");
			
	var div = document.createElement("div");
	div.setAttribute("class","form-group");
	var label = document.createElement("label");
			
	label.setAttribute("class","col-sm-2 control-label");

	label.innerHTML="Url: ";
			
	var input= document.createElement("input");
	input.setAttribute("class","form-control");
	input.setAttribute("name","url");
	input.setAttribute("placeholder","Url du fichier XML");
	var btn = document.createElement("input");
	btn.setAttribute("type","submit");
	btn.setAttribute("name","ajoutFlux");
	btn.setAttribute("class","btn btn-primary");
	

	var cible = document.getElementById("option-podcast");
	cible.appendChild(form); 
	form.appendChild(div);
	div.appendChild(label);
	div.appendChild(input);
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