function enregistrerMembre(){
	var form = new FormData(document.getElementById('form-enregistrer-membre'));

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = Email deja utilise
				$("#modal-Membre").modal('hide');

			}else if (reponse.idMembre != null){
				window.location.reload();
			}
		},
		fail : function (err){
		 
		}
	});
}

function modifierProfil(){
	var form = new FormData(document.getElementById('ProfilMembre'));
	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json', 
		contentType : false,
		processData : false,
		success : function (reponse){
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = Profil à jour
				$("#modal-profil-Membre").modal('hide');

			}else{
				membresVue(reponse);
			}
		},
		fail : function (err){
		 
		}
	});
}

function connexion(){
	var form = new FormData(document.getElementById('form-connexion'));

	if (!document.getElementById('form-connexion').checkValidity()){
		document.getElementById('validation-connexion').click();

	}else {
	
		$.ajax({
			type : 'POST',
			url : 'Membres/membresControleur.php',
			data : form,
			dataType : 'json',
			contentType : false,
			processData : false,
			success : function (reponse){
				if(reponse.msg != ""){
					initialiser(reponse.msg); // msg = erreur information connexion
					$("#modal-Connexion").modal('hide');
					document.getElementById('form-connexion').reset();
				}else {
					window.location.reload();
				}
				
			},
			fail : function (err){
			 
			}
		});

	}

	
}

function deconnexion(){
	var form = new FormData();
	form.append('action', 'deconnexion');

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
			window.location.reload();
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});

}

function tableMembres(){
	var form = new FormData(document.getElementById('formLister'));
	form.append('action', 'tableMembres');

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});
}

function activerMembre(){
	var form = new FormData(document.getElementById('form-activer-membre'));
	
	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
		
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = erreur information connexion
				$("#modal-Activer-Membre").modal('hide');
			}
				membresVue(reponse);
		},
		fail : function (err){
		 alert('fail')
		}
	});
}

function desactiverMembre(){
	var form = new FormData(document.getElementById('form-desactiver-membre'));
	
	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
		
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = erreur information connexion
				$("#modal-Supprimer-Membre").modal('hide');
			}
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});
}
function tableHistoriques(){
	var form = new FormData();
	form.append('action', 'tableHistoriqueLocation');
	form.append('idMembre', document.getElementById('myMemberid').value);
	
	
	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);	
		},
		fail : function (err){
		 
		}
	});
}

function tableLocation(){
	var form = new FormData();
	form.append('action', 'tableLocation');
	form.append('idMembre', document.getElementById('myMemberid').value);

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);
		},
		fail : function (err){
		 
		}
	});
}

function profil(){
	var form = new FormData();
	form.append('action', 'profil');
	form.append('idMembre', document.getElementById('myMemberid').value);

	$.ajax({
		type : 'POST',
		url : 'Membres/membresControleur.php',
		data : form,
		dataType : 'json',
		contentType : false,
		processData : false,
		success : function (reponse){
				membresVue(reponse);
			
		},
		fail : function (err){
		 
		}
	});
}
