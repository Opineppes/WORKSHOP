$("#btn-inscription").click(function(e) {
	$("#inscription-modal").modal("show");
	$("#connexion-modal").modal("hide");
});

$(".avatar").click(function(e) {
	$("#avatar").get(0).click();
});

$("#deconnexion").click(function(e) {
	e.preventDefault();
	
	$.post( {
		url: "/",
		data: {
			protocole: "deconnexion"
		},
		dataType: "json"
	} ).done(function(res) {
		if(res.result != undefined) {
			if(res.result) {
				document.location = "/";
			}
		}
	});
});

$("#connexion-form").submit(function(e) {
	e.preventDefault();
	
	$.post( {
		url: "/",
		data: {
			protocole: "connexion",
			email: $("#email-connexion").val(),
			mot_de_passe: $("#mot-de-passe-connexion").val()
		},
		dataType: "json"
	} ).done(function(res) {
		if(res.result != undefined) {
			if(res.result) {
				document.location = "/";
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
		url: "/",
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
				document.location = "/";
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
		url: "/",
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