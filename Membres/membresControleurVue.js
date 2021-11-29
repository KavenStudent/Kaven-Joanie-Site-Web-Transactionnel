var membresVue = function (reponse) {
	var action = reponse.action;

	switch (action) {
		case "tableMembres":
			afficherTableMembres(reponse);
			break;
		case "activerMembre":
			if (reponse.listeMembres != null) {
				afficherTableMembres(reponse);
			}
			break;
		case "desactiverMembre":
			if (reponse.listeMembres != null) {
				afficherTableMembres(reponse);
			}
			break;
		case "tableHistoriqueLocation":
			afficherTableHistoriqueLocation(reponse);
			break;
		case "profil":
			afficherProfil(reponse);
			break;
		case "tableLocation":
			afficherTableLocation(reponse);
			break;
	}
}


function afficherTableMembres(json) {
	$('#rechercherFilm').attr("style", "display: none !important");
	$('#rechercheMembre').attr("style", "display: flex !important");

	let contenu = `<div class="container-xl">	<div class="table-responsive"> <div class="table-wrapper">	<table class="table table-striped table-hover">
	<thead> <tr> <th>ID</th> <th>Prénom</th> <th>Nom</th> <th>Courriel</th> <th>Sexe</th>
	<th>Date de naissance</th> <th>Statut</th> <th>Rôle</th> <th>Actions</th> <th></th> </tr> </thead> <tbody>`;

	for (let i = 0; i < json.listeMembres.length; i++) {
		contenu += ` <tr class="uneLigne"><td> ${json.listeMembres[i].idMembre} </td>
		<td>${json.listeMembres[i].prenom}</td>
		<td>${json.listeMembres[i].nom}</td>
		<td>${json.listeMembres[i].courriel}</td>
		<td>${json.listeMembres[i].sexe}</td>
		<td>${json.listeMembres[i].dateDeNaissance}</td>
		<td>${json.listeMembres[i].statut}</td>
		<td>${json.listeMembres[i].role}</td>
		<td> <a class="btn btn-primary myButton" data-bs-toggle="modal" data-bs-target="#modal-Activer-Membre" onclick="envoyerIdMembreActive(${json.listeMembres[i].idMembre})"><i class="material-icons" data-toggle="tooltip" title="Activer">&#xe876;</i></a> </td>
		<td> <a class="btn btn-primary myButton" data-bs-toggle="modal" data-bs-target="#modal-Supprimer-Membre" onclick="envoyerIdMembreDesactive(${json.listeMembres[i].idMembre})"><i class="material-icons" data-toggle="tooltip" title="Désactiver">&#xE872;</i></a> </td>	</tr>`
	}

	contenu += `</tbody> </table> </div> </div> </div>`;

	$('#liste-film').html(contenu);
	paginationTable();
	resetSearchBar();
}


function afficherTableHistoriqueLocation(json) {
	$('#rechercherFilm').attr("style", "display: none !important");
	let contenu = `<h1>Historique Location</h1>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Titre</th>
				<th scope="col">Date d'achat</th>
				<th scope="col">Image</th>
			</tr>
		</thead>

		<tbody>`;

	for (let i = 0; i < json.listeLocations.length; i++) {
		contenu += `<tr class="uneLigne">
		<td>${json.listeLocations[i].titre}</td>
		<td>${json.listeLocations[i].dateAchat}</td>
		<td>`
		if (json.listeLocations[i].image.substr(0, 4) === "http") {
			contenu += `<img class="icon-film" src="${json.listeLocations[i].image}" alt="image-film">`;
		} else {
			contenu += `<img class="icon-film" src="imageFilm/${json.listeLocations[i].image}" alt="image film">`;
		}
		contenu += `</td></tr>`
	}
	// button a revoir maybe
	contenu += `</tbody> </table>`;

	$('#liste-film').html(contenu);
	paginationTable();
}


function afficherTableLocation(json) {
	$('#rechercherFilm').attr("style", "display: none !important");
	let contenu = `<h1>Location en cours</h1>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">Titre</th>
				<th scope="col">Date d'achat</th>
				<th scope="col">Date de fin</th>
				<th scope="col">Nombre jours restant locations</th>
				<th scope="col">Image</th>
			</tr>
		</thead>

		<tbody>`;
	for (let i = 0; i < json.listeLocations.length; i++) {
		contenu += `<tr class="uneLigne">
		<td>${json.listeLocations[i].titre}</td>
		<td>${json.listeLocations[i].dateAchat}</td>
		<td>${json.listeLocations[i].dateFin}</td>
		<td>${json.listeLocations[i].nbJourRestant}</td>
		<td>`

		if (json.listeLocations[i].image.substr(0, 4) === "http") {
			contenu += `<img class="icon-film" src="${json.listeLocations[i].image}" alt="image-film">`;
		} else {
			contenu += `<img class="icon-film" src="imageFilm/${json.listeLocations[i].image}" alt="image film">`;
		}
	}
	contenu += `</td></tr>`
	$('#liste-film').html(contenu);
	paginationTable();
}

function afficherProfil(json) {
	var monProfil = json.afficherProfil;

	$("#idMembre").val(monProfil.idMembre);
	$("#profil-prenom").val(monProfil.prenom);

	$("#profil-nom").val(monProfil.nom);
	$("#profil-email-Enreg").val(monProfil.courriel);
	$("#profil-password").val(monProfil.motDePasse);
	$("#profil-confirmPassword").val(monProfil.motDePasse);
	if (monProfil.sexe == 'M') {
		$('#profil-M').prop('checked', true);
	}
	else {
		$('#profil-F').prop('checked', true);
	}
	$("#profil-dateNaissance").val(monProfil.dateDeNaissance);
	$("#modal-profil-Membre").modal('show');

	

}
