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
		<a href="#" class="btn btn-primary" onclick="afficherBandeAnnonce(${json.listeFilms[i].idFilm})">Plus d'info</a>
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

function afficherTableFilms(json) {
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
		contenu += `<td> <a class="btn btn-primary myButton" onclick="afficherFormModifierFilm(${json.listeFilms[i].idFilm})"><i class="material-icons" data-toggle="tooltip" title="Modifier">&#xE254;</i></a> </td>
		<td> <a class="btn btn-primary myButton" data-bs-toggle="modal" data-bs-target="#modal-Supprimer-Film" onclick="envoyerIdFilm(${json.listeFilms[i].idFilm})"><i class="material-icons" data-toggle="tooltip" title="Supprimer">&#xE872;</i></a> </td>	</tr>`;


	}
	//,'serveur/fiche.php'
	contenu += `</tbody> </table> </div> </div> </div>`;

	$('#liste-film').html(contenu);
	paginationTable();
}


function remplirFormModifierFilm(reponse) {
	let genres = reponse.lesGenres;

	document.getElementById('id-modifier').value = reponse.unFilm.idFilm;
	document.getElementById('titre-modifier').value = reponse.unFilm.titre;
	document.getElementById('annee-modifier').value = reponse.unFilm.annee;
	document.getElementById('duree-modifier').value = reponse.unFilm.duree;
	document.getElementById('realisateur-modifier').value = reponse.unFilm.realisateurs;
	document.getElementById('acteur-modifier').value = reponse.unFilm.acteurs;
	document.getElementById('description-modifier').value = reponse.unFilm.description;
	document.getElementById('prix-modifier').value = reponse.unFilm.prix;
	document.getElementById('bandeAnnonce-modifier').value = reponse.unFilm.bandeAnnonce;

	// parcours les checkbox des genres
	$('input[type=checkbox]').each(function () {

		genres.forEach(ligne => {
			// si le value du checkbox est dans genres on le coche
			if (ligne.genre === $(this).val()) {
				$(this).prop('checked', true);
			}

		});

	});

	$("#modal-modifier-film").modal('show');
}

function remplirModalTrailer(reponse) {
	let contenu = `<h4> ${reponse.unFilm.titre} </h4>
	<p><strong>Genres: </strong>`;

	for (i = 0; i < reponse.lesGenres.length; i++) {
		contenu += reponse.lesGenres[i].genre + " ";
	};

	contenu += `</p><p><strong>Durée: </strong> ${reponse.unFilm.duree} minutes</p>
	<p><strong>Réalisateur: </strong>${reponse.unFilm.realisateurs} </p>
	<p><strong>Acteurs: </strong>${reponse.unFilm.acteurs} </p>
	<p><strong>Description: </strong>${reponse.unFilm.description} </p>`;

	document.getElementById('trailer').src = reponse.unFilm.bandeAnnonce;
	document.getElementById('info-film').innerHTML = contenu;

	$("#modal-trailer").modal('show');
}

function ajouterAuPanier(reponse) {
	let existe = false;
	let duree = reponse.duree;

	let prixTotal = reponse.unFilm.prix * duree;
	let idMembre = document.getElementById('myMemberid').value;
	let film = {
		"idFilm": reponse.unFilm.idFilm,
		"titre": reponse.unFilm.titre,
		"dureeLocation": duree,
		"image": reponse.unFilm.image,
		"prix": prixTotal.toFixed(2),
		"idMembre": idMembre
	};

	panier = JSON.parse(localStorage.getItem("panier"));

	// regarde si le film est deja dans le panier de
	for (let i = 0; i < panier.length; i++) {

		if (panier[i].idFilm == reponse.unFilm.idFilm) { // si existe augmente la duree de la location
			existe = true;

			duree = panier[i].dureeLocation + jours;
			prixTotal = reponse.unFilm.prix * duree;

			film = {
				"idFilm": reponse.unFilm.idFilm,
				"titre": reponse.unFilm.titre,
				"dureeLocation": duree,
				"image": reponse.unFilm.image,
				"prix": prixTotal.toFixed(2),
				"idMembre": idMembre
			};

			panier[i] = film;
		}
	}

	// si le film n'existe pas on ajoute le film au panier
	if (!existe) {
		panier.push(film);
	}

	localStorage.setItem("panier", JSON.stringify(panier));

	$("#modal-location").modal('hide');
	afficherPanier();
	document.getElementById('jour').value = 1; // remet le input du nombre de jour à 1
	let bsOffcanvas = new bootstrap.Offcanvas(document.getElementById("offcanvasRight"));
	bsOffcanvas.show(); // affiche le canvas du panier

}

var filmsVue = function (reponse) {
	var action = reponse.action;
	switch (action) {
		case "enregistrer":
			listerCardsFilms(reponse);
		case "deleteFilm":
			afficherTableFilms(reponse);
			break;
		case "modifierFilm":
			afficherTableFilms(reponse);
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
		case "formModifierFilm":
			remplirFormModifierFilm(reponse);
			break;
		case "trailer":
			remplirModalTrailer(reponse);
			break;
		case "panier":
			ajouterAuPanier(reponse);
			break;
	}
}