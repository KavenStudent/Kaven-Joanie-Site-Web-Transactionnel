//vue films
function listerCardsFilms(json) {
	$i = 0;
	let contenu = ` <div class="row">`;

	for (var i = 0; i < json.listeFilms.length; i++) {
		if ($i % 4 == 0) {
			contenu += `</div> <div class="row">`;
		}
		contenu += `<div class="card">`;



		if (json.listeFilms[i].image.substring(0, 4) === "http") {
			contenu += `<img class="image-film" src=" ${json.listeFilms[i].image}" alt="image-film">`;
		} else {
			contenu += `<img class="image-film" src="imageFilm/${json.listeFilms[i].image}" alt="image-film">`;
		}

		contenu += `<div class="card-body">
		<h5 class="card-title"> ${json.listeFilms[i].titre}(${json.listeFilms[i].annee})</h5>
		<p class="card-text">${json.listeFilms[i].realisateurs}</p>
		<p class="card-text">${json.listeFilms[i].prix}</p>
		<a href="#" class="btn btn-primary" onclick="afficherTrailer(${json.listeFilms[i].idFilm},'serveur/fiche.php')">Plus d'info</a>
		`;


		if (json.membre != null) {
			contenu += `<a href="#" id="btnAJout" class="btn btn-primary" onclick="ajout( ${json.listeFilms[i].idFilm})">Ajouter</a>`;
		}
		contenu += `</div> </div>`
		$i++;
	}
	contenu += `</div>`; //fermer le dernier row
//button a revoir
	$('#liste-film').html(contenu);
	pagination();
}

function afficherTableFilms(json){
	let contenu = `<div class="container-xl">	<div class="table-responsive"> <div class="table-wrapper">	<table class="table table-striped table-hover">
	<thead> <tr> <th>ID</th> <th>Titre</th> <th>Année</th> <th>Durée</th> <th>Réalisateur</th>
	<th>Acteurs</th> <th>Prix</th> <th>Image</th> <th>Actions</th> <th></th> </tr> </thead> <tbody>`;

	for (let i = 0; i < json.listeFilms.length; i++) {
		contenu += ` <tr class="uneLigne"><td> ${json.listeFilms[i].idFilm} </td>
		<td>${json.listeFilms[i].titre}</td>
		<td>${json.listeFilms[i].annee}</td>
		<td>${json.listeFilms[i].duree}</td>
		<td>${json.listeFilms[i].realisateurs}</td>
		<td>${json.listeFilms[i].acteurs}</td>
		<td>${json.listeFilms[i].prix}</td>`;

		if (json.listeFilms[i].image.substring(0, 4) === "http") {
			contenu += `<td><img class="icon-film" src=" ${json.listeFilms[i].image}" alt="image-film"></td>`;
		} else {
			contenu += `<td><img class="icon-film" src="imageFilm/${json.listeFilms[i].image}" alt="image-film"></td>`;
		}
	// button a revoir maybe
		contenu += `<td> <a class="btn btn-primary myButton" onclick="populerModal(${json.listeFilms[i].idFilm},'serveur/fiche.php')"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a> </td>
		<td> <a class="btn btn-primary myButton" data-bs-toggle="modal" data-bs-target="#modal-Supprimer-Film" onclick="envoyerIdFilm(${json.listeFilms[i].idFilm})"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a> </td>	</tr>`;
		
	
	}

	contenu += `</tbody> </table> </div> </div> </div>`;

	$('#liste-film').html(contenu);
	paginationTable();
}

function afficherFiche(reponse) {
	var uneFiche;
	if (reponse.OK) {
		uneFiche = reponse.fiche;
		$('#formFicheF h3:first-child').html("Fiche du film numero " + uneFiche.idf);
		$('#idf').val(uneFiche.idf);
		$('#titreF').val(uneFiche.titre);
		$('#dureeF').val(uneFiche.duree);
		$('#resF').val(uneFiche.res);
		$('#divFormFiche').show();
		document.getElementById('divFormFiche').style.display = 'block';
	} else {
		$('#messages').html("Film " + $('#numF').val() + " introuvable");
		setTimeout(function() {
			$('#messages').html("");
		}, 5000);
	}

}

var filmsVue = function (reponse) {
	var action = reponse.action;
	switch (action) {
		case "enregistrer":
		case "deleteFilm":
			afficherTableFilms(reponse);
			break;
		case "modifier":
			$('#messages').html(reponse.msg);
			setTimeout(function () {
				$('#messages').html("");
			}, 5000);
			break;
		case "listerFilms":
			listerCardsFilms(reponse);
			break;
		case "fiche":
			afficherFiche(reponse);
			break;
		case "tableFilms":
			afficherTableFilms(reponse);
			break;
	}
}