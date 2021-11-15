var membresVue = function (reponse) {
	var action = reponse.action;

	switch (action) {
		case "enregistrerMembre":

		case "connexion":

		case "enlever":
		case "modifier":
			$('#messages').html(reponse.msg);
			setTimeout(function () {
				$('#messages').html("");
			}, 5000);
			break;
		case "lister":
			listerF(reponse.listeFilms);
			break;
		case "fiche":
			afficherFiche(reponse);
			break;
		case "tableMembres":
			afficherTableMembres(reponse);
			break;
		case "activerMembre":
			if(reponse.listeMembres != null){
				afficherTableMembres(reponse);
			}	
			break;
		case "desactiverMembre":
			if(reponse.listeMembres != null){
				afficherTableMembres(reponse);
			}
			break;
		case "tableHistoriqueLocation":
			afficherTableHistoriqueLocation(reponse);
			break;
		case "profil":
			afficherProfil(reponse);
			break;
	}
}

function connecter(reponse) {

	if (reponse.idMembre != null) {
		afficherPageMembre(reponse);
	}
}


function afficherTableMembres(json) {
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
	// button a revoir maybe
	contenu += `</tbody> </table> </div> </div> </div>`;

	$('#liste-film').html(contenu);
	paginationTable();
}


function afficherPageMembre(json) {
	let contenu = `<li class="nav-item">
	<a class="nav-link active" aria-current="page" href="javascript:retourAccueilM()">Accueil</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modal-profil-Membr  2e">Profil</a>
	</li>

	<li class="nav-item">
		<a class="nav-link" aria-current="page" href="javascript:listerHistorique();">Historique d'achat</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" aria-current="page" href="javascript:listerLocation();">Location en cours</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" aria-current="page" href="javascript:deconnexion()">Déconnexion</a>
	</li>
	<li class="nav-item">
	<a class="btn btn-primary myButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"> <i class="material-icons">&#xe8cc;</i></a>
	</li>`;

	$('#navbar-choix').html(contenu);

	contenu = `<div class="row">`;
	$j = 0;

	//boucle
	for (let i = 0; i < json.listeFilms.length; i++) {
		if ($j % 4 == 0) {
			contenu += `</div> <div class="row">`;
		}

		contenu += `<div class="card">`;

		if (json.listeFilms[i].image.substr(0, 4) === "http") {
			contenu += `<img class="image-film" src="${json.listeFilms[i].image}" alt="image-film">`;
		} else {
			contenu += `<img class="image-film" src="imageFilm/${json.listeFilms[i].image}" alt="image film">`;
		}

		contenu += `<div class="card-body">
				<h5 class="card-title">${json.listeFilms[i].titre}(${json.listeFilms[i].annee})</h5>
				<p class="card-text">${json.listeFilms[i].realisateurs}</p>
				<p class="card-text">${json.listeFilms[i].prix}</p>
				<a href="#" class="btn btn-primary" onclick="afficherTrailer(${json.listeFilms[i].idFilm}, '../serveur/fiche.php')">Plus d'info</a>
				<a href="#" id="btnAJout" class="btn btn-primary" onclick="ajout(${json.listeFilms[i].idFilm})">Ajouter</a>
				</div> </div>
				`;

		// fonction a changer
		// $rep .= '<a href="#" class="btn btn-primary" onclick="afficherTrailer(' . $ligne->idFilm . ',\'../serveur/fiche.php\')">Plus d\'info</a>';
		// $rep .= '<a href="#" id="btnAJout" class="btn btn-primary" onclick="ajout(' . $ligne->idFilm . ')">Ajouter</a>';

		$j++;
	} //fin boucle

	contenu += "</div>"; //fermer le dernier row

	$('#liste-film').html(contenu);
}

function afficherPageAdmin() {

}

function afficherTableHistoriqueLocation(json){
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
		contenu +=`<tr class="uneLigne">
		<td>${json.listeLocations[i].titre}</td>
		<td>${json.listeLocations[i].dateAchat}</td>
		<td>`
		if (json.listeLocations[i].image.substr(0, 4) === "http") {
			contenu +=`<img class="icon-film" src="${json.listeLocations[i].image}" alt="image-film">`;
		} else {
			contenu += `<img class="icon-film" src="imageFilm/${json.listeLocations[i].image}" alt="image film">`;
		}
		contenu +=`</td></tr>`
	}
	// button a revoir maybe
	contenu += `</tbody> </table>`;

	$('#liste-film').html(contenu);
	paginationTable();
}

function afficherProfil(json) {
	// if(json.OK){
	var monProfil = json.afficherProfil;

	$("#idMembre").val(monProfil.idMembre);
	$("#profil-prenom").val(monProfil.prenom);

	$("#profil-nom").val(monProfil.nom);
	$("#profil-email-Enreg").val(monProfil.courriel);
	$("#profil-password").val(monProfil.motDePasse);
	$("#profil-confirmPassword").val(monProfil.motDePasse);
	if(monProfil.sexe == 'M'){
		$('#profil-M').prop('checked', true);
	}
	else{
		$('#profil-F').prop('checked', true);
	}
	$("#profil-dateNaissance").val(monProfil.dateDeNaissance);
	$("#modal-profil-Membre").modal('show');

	// }

}