var membresVue = function (reponse) {
	var action = reponse.action;

	switch (action) {
		case "enregistrerMembre":
			connecter(reponse);
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

	}
}

function connecter(reponse) {

	if (reponse.idMembre != null) {
		afficherPageMembre(reponse);
	}
}

function afficherPageMembre(json) {
	let contenu = `<li class="nav-item">
	<a class="nav-link active" aria-current="page" href="javascript:retourAccueilM()">Accueil</a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modal-profil-Membre">Profil</a>
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


	
	if (json.listeFilms[i].image.substr(0,4) === "http") {
		contenu += `<img class="image-film" src="${json.listeFilms[i].image}" alt="image-film">`;
	} else {
		contenu += `<img class="image-film" src="../imageFilm/${json.listeFilms[i].image}" alt="image film">`;
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