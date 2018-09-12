var ancienneValeurs = { //map pour stocker les ancienne valeur du profil et les reafficher corectement
		nom: "",
		prenom: "",
		email: "",
		promo: ""
};

var baseWebPath = "/";

$("#btn-inscription").click(function(e) {
	$("#inscription-modal").modal("show");
	$("#connexion-modal").modal("hide");
});

$(".avatar").click(function(e) {
	$("#avatar").get(0).click();
});

function onClicModifProfil(e) {
	$("#control-modifprofil").html("<h6 class=\"text-left\">Commande Utilisateur:</h6>"
								 + "<div class=\"btn-group\" role=\"group\">"
								 + "	<button type=\"submit\" class=\"btn btn-primary\" id=\"button-save\">Sauvegarder</button>"
								 + "	<button class=\"btn btn-secondary\" id=\"button-cancel\">Annuler</button>"
								 + "</div>");

	ancienneValeurs.nom = $("#profil-Nom").html();
	ancienneValeurs.prenom = $("#profil-Prenom").html();
	ancienneValeurs.email = $("#profil-Email").html();
	
	$("#profil-Nom").html("<input type=\"text\" name=\"Nom\" class=\"form-control\" value=\"" + ancienneValeurs.nom + "\" />");
	$("#profil-Prenom").html("<input type=\"text\" name=\"Prenom\" class=\"form-control\" value=\"" + ancienneValeurs.prenom + "\" />");
	$("#profil-Email").html("<input type=\"email\" name=\"Email\" class=\"form-control\" value=\"" + ancienneValeurs.email + "\" />");
	
	$("#button-cancel").click(onClicModifCancel);
}

function onClicModifCancel(e) {
	//je remplace les formulaire par les ancienne valeur
	$("#control-modifprofil").html("<h6 class=\"text-left\">Commande Utilisateur:</h6>"
								 + "<div class=\"btn-group\" role=\"group\">"
								 + "	<button class=\"btn btn-info\" id=\"button-modifprofil\" type=\"button\">Modifier Infos</button>"
								 + "	<button class=\"btn btn-info\" id=\"button-modifpasswd\" type=\"button\" data-toggle=\"modal\" data-target=\"#modifpasswd\">Modifier Mot de passe</button>"
								 + "</div>");
	
	$("#profil-Nom").html(ancienneValeurs.nom);
	$("#profil-Prenom").html(ancienneValeurs.prenom);
	$("#profil-Email").html(ancienneValeurs.email);
	
	$("#button-modifprofil").click(onClicModifProfil); //je definie l'action executer quand on clique sur l'element avec l'id button-modifprofil que j'ai rajouter avec js
}

$("#deconnexion").click(function(e) {
	e.preventDefault();
	
	$.post( {
		url: baseWebPath,
		data: {
			protocole: "deconnexion"
		},
		dataType: "json"
	} ).done(function(res) {
		if(res.result != undefined) {
			if(res.result) {
				document.location = baseWebPath;
			}
		}
	});
});

$("#connexion-form").submit(function(e) {
	e.preventDefault();
	
	$.post( {
		url: baseWebPath,
		data: {
			protocole: "connexion",
			email: $("#email-connexion").val(),
			mot_de_passe: $("#mot-de-passe-connexion").val()
		},
		dataType: "json"
	} ).done(function(res) {
		if(res.result != undefined) {
			if(res.result) {
				document.location = baseWebPath;
			} else {
				$("#connexion-modal").modal("show");
				$("#error-connexion").remove();
				$("#connexion-body").prepend(
					"<div class=\"alert alert-danger\" role=\"alert\" id=\"error-connexion\">"+
					"<strong>Nope !</strong> &nbsp;&nbsp;"+ res.error +
					"</div>"
				)
			}
		}
	});
});

$("#inscription-form").submit(function(e) {
	e.preventDefault();

	
	$.post( {
		url: baseWebPath,
		data: {
			protocole: "inscription",
			email: $("#email").val(),
			mot_de_passe: $("#mot-de-passe").val(),
			verif_mot_de_passe: $("#valide-mot-de-passe").val(),
			prenom: $("#prenom").val(),
			nom: $("#nom").val(),
			annee: $("#annee").val()
		},
		dataType: "json"
	} ).done(function(res) {
		if(res.result != undefined) {
			if(res.result) {
				document.location = baseWebPath;
			} else {
				$("#inscription-modal").modal("show");
				$("#error-inscription").remove();
				$("#inscription-body").prepend(
					"<div class=\"alert alert-danger\" role=\"alert\" id=\"error-inscription\">"+
					"<strong>Nope !</strong> &nbsp;&nbsp;"+ res.error +
					"</div>"
				)
			}
		}
	});
});

$("#avatar").on('change', function(e) {
	var formData = new FormData($("#form-avatar").get(0));
	console.log(formData);
	
	$.post({
		url: baseWebPath,
		data: formData,
		dataType: 'json',
		processData: false,
		contentType: false,
	}).done(function(res){
		if(res.result != undefined) {
			if(res.result) {
				document.location.reload();
			} else {
				$("#error-message").html(res.error);
				$("#modal-error").modal("show");
			}
		}
	});
});