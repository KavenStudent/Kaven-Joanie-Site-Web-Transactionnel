function enregistrerMembre(){
	var form = new FormData(document.getElementById('form-enregistrer-membre'));

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json', //text pour le voir en format de string
		// async : false,
		//cache : false,
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});
}

function connexion(){
	var form = new FormData(document.getElementById('form-connexion'));

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json', //text pour le voir en format de string
		// async : false,
		//cache : false,
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});
}