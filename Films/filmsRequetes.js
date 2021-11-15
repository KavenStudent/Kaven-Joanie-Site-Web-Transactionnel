function listerFilms() { // fait
	var form = new FormData();
	form.append('action', 'listerFilms');

	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (reponse) {
			filmsVue(reponse);
		},
		fail: function (err) {}
	});
}

function tableFilms(){
	var form = new FormData();
	form.append('action', 'tableFilms');

	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form,
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (reponse) {
			filmsVue(reponse);
		},
		fail: function (err) {}
	});
}

// faut refresh les changments
function enregistrerFilm() {
	var form = new FormData(document.getElementById('form-creer-film'));

	if (!document.getElementById('form-creer-film').checkValidity()){
		document.getElementById('validation-creer-film').click();

	}else {
	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form,
		dataType: 'json',
		//async : false,
		//cache : false,
		contentType: false,
		processData: false,
		success: function (reponse) {
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = film bien enregistre
				$("#modal-creer-film").modal('hide');
				document.getElementById("form-creer-film").reset();
			}
			filmsVue(reponse);
		},
		fail: function (err) {

		}
	});

	}
}

function modifierFilm(){
	var form = new FormData(document.getElementById('form-modifier-film'));

	if (!document.getElementById('form-modifier-film').checkValidity()){
		document.getElementById('validation-modifier-film').click();

	}else {
	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form,
		dataType: 'json',
		//async : false,
		//cache : false,
		contentType: false,
		processData: false,
		success: function (reponse) {
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = film bien modifier
				$("#modal-modifier-film").modal('hide');
				document.getElementById("form-modifier-film").reset();
			}
			filmsVue(reponse);
		},
		fail: function (err) {

		}
	});

	}
}

// faut refresh les changments
function deleteFilm() {
	var form = new FormData(document.getElementById('form-delete-film'));
	
	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form, 
		contentType: false,
		processData: false,
		dataType: 'json',
		success: function (reponse) { 
			if(reponse.msg != null){
				initialiser(reponse.msg); // msg = film a ete supprime
				$("#modal-Supprimer-Film").modal('hide');
			}
			filmsVue(reponse);
		},
		fail: function (err) {}
	});
}

function afficherFormModifierFilm(id){
	var form = new FormData();
	form.append('action', 'formModifierFilm');
	form.append('idFilm', id);

	$.ajax({
		type: 'POST',
		url: 'Films/filmsControleur.php',
		data: form, 
		contentType: false, 
		processData: false,
		dataType: 'json',
		success: function (reponse) { 
			filmsVue(reponse);
		},
		fail: function (err) {}
	});
}