<?php
session_start();
if (isset($_SESSION['admin'])) {
	$msg = "Admin connecté";
} else if (isset($_SESSION['membre'])) { // faire requete pour get le membre pour profil
	$msg = "Bienvenue";
} else {
	$msg = "";
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

	<!-- Jquery -->
	<script src="public/util/js/jquery-3.6.0.min.js"></script>

	<!-- bootstrap -->
	<script src="public/util/bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="public/util/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="../public/util/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Loading main css file -->
	<link rel="stylesheet" href="public/util/css/style.css">

	<link rel="stylesheet" href="public/css/monStyle.css">
	<script src="public/js/monScript.js"></script>

	<script language="javascript" src="Films/filmsRequetes.js"></script>
	<script language="javascript" src="Films/filmsControleurVue.js"></script>
	<script language="javascript" src="Membres/membresRequetes.js"></script>
	<script language="javascript" src="Membres/membresControleurVue.js"></script>

	<title>TP Joanie-Kaven</title>
</head>

<body onLoad="initialiser(<?php echo "'" . $msg . "'" ?>);">


	<div id=" site-content">

		<!-- navbar -->
		<?php
		if (isset($_SESSION['admin'])) {
			include_once('includes/menu_admin.inc.php');
		} else if (isset($_SESSION['membre'])) {
			include_once('includes/menu_membre.inc.php');
		} else {
			include_once('includes/menu_index.inc.php');
		}
		?>
		<!-- fin navbar -->

		<!-- TOAST -->
		<div class="toast-container position-absolute top-15 start-50 translate-middle-x">
			<div id="toast" class="toast  align-items-center text-white bg-secondary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
				<div class="toast-header">
					<img src="public/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
					<strong class="me-auto">Messages</strong>
					<small class="text-muted"></small>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div id="textToast" class="toast-body">
				</div>
			</div>
		</div>

		<main class="main-content">

			<div class="container">
				<!-- div des films -->
				<div class='page' id='liste-film'>

				</div>
				<!-- fin div des films -->

				<!-- pagination -->
				<ul id="pagin"> </ul>

			</div> <!-- .container -->

		</main>

		<!-- modal bande annonce -->
		<div class="modal fade" id="modal-trailer" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Informations</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="ratio ratio-16x9">
							<iframe id="trailer" src="" title="YouTube video" allowfullscreen></iframe>
						</div>
						<div id="info-film">

						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal bande annonce -->


		<!-- retour accueil index -->
		<form id="formAccueil" action="index.php" methode="post">
		</form>


		<form id="formLister" action="index.php" method="POST">
			<input type="hidden" id="par" name="par" value="tout">
			<input type="hidden" id="valeurPar" name="valeurPar" value="">
		</form>

		<!-- partie index -->
		<!-- modal devenir membre-->
		<div class="modal fade" id="modal-Membre" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Enregistrer</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Form devenir membre-->

						<form class="form-enregistrer-membre" id="form-enregistrer-membre">
							<input type="hidden" name="action" value="enregistrerMembre">

							<input type="submit" id="validation-form-membre" class="validation" />

							<div class="myInput">
								<label for="prenom" class="form-label">Prénom</label>
								<input type="text" class="form-control" id="prenom" name="prenom" required>
							</div>
							<div class="myInput">
								<label for="nom" class="form-label">Nom</label>
								<input type="text" class="form-control" id="nom" name="nom" required>
							</div>

							<div class="myInput">
								<label for="pages" class="form-label">Courriel</label>
								<input type="email" class="form-control" id="email-Enreg" name="email" required>
							</div>

							<div class="myInput">
								<label for="password" class="form-label">Mot de passe</label>
								<input type="password" class="form-control" id="password" name="password" required>
								<input class="montrerPassword" type="checkbox" onclick="montrerPassword('password')">Montrer le mot de passe
								<span id="msg-password-erreur">Le mot de passe doit être entre 8 et 10 charactères et doit contenir des lettres majuscules, minuscules, des chiffres et les charactères "-_" </span>
							</div>

							<div class="myInput">
								<label for="confirmPassword" class="form-label">Confirmer mot de passe</label>
								<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
								<input class="montrerPassword" type="checkbox" onclick="montrerPassword('confirmPassword')">Montrer le mot de passe
								<span id="msg-confirm-password-erreur">Confirmation invalide</span>
							</div>

							<hr class="line">

							<div class="myInput">
								<p>Pour des raisons statistiques</p>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" value="M" id="M" checked>
									<label class="form-check-label" for="M">
										Homme
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" value="F" id="F">
									<label class="form-check-label" for="F">
										Femme
									</label>
								</div>

							</div>
							<div class="myInput">
								<label for="dateNaissance" class="form-label">Date de naissance</label>
								<input type="date" class="form-control" id="dateNaissance" name="dateNaissance" required>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="valider('form-enregistrer-membre');">Enregistrer</button>
							</div>
						</form>

						<!-- Fin form devenir membre-->
					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal devenir membre-->

		<!-- modal connexion -->
		<div class="modal fade" id="modal-Connexion" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Connexion</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Form connexion -->

						<form class="form-connexion" id="form-connexion">
							<input type="hidden" name="action" value="connexion">

							<input type="submit" id="validation-connexion" class="validation" />

							<div class="myInput">
								<label for="pages" class="form-label">Courriel</label>
								<input type="email" class="form-control" id="email-Connexion" name="email" required>

							</div>

							<div class="myInput">
								<label for="password" class="form-label">Mot de passe</label>
								<input type="password" class="form-control" id="passwordConnexion" name="password" required>
								<input class="montrerPassword" type="checkbox" onclick="montrerPassword('passwordConnexion')">Montrer le mot de passe

							</div>


							<div class="modal-footer">
								<button type="button" class="btn btn-primary" onClick="connexion()">Connexion</button>
							</div>
						</form>

						<!-- Fin form connexion -->
					</div>

				</div>
			</div>
		</div> <!-- Fin modal connexion -->
		<!-- fin partie index -->

		<!-- partie membre -->
		<!-- canvas panier paypal-->
		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
			<div class="offcanvas-header">
				<h3 id="offcanvasRightLabel">Contenu de votre panier</h3>
				<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>

			<div class="offcanvas-body">

				<div id="panier">

				</div>

				<div id="total">

				</div>

				<div id="paypal-button-container">

				</div>
			</div>
		</div>
		<!-- fin canvas panier paypal-->

		<!-- modal location -->
		<div class="modal fade" id="modal-location" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Choisissez le nombre de jour</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<input type="number" id="jour" value="1" min="1">
						<input type="hidden" id="idLocation">
						<button type="button" class="btn btn-primary" onclick="envoyerAuPanier()">Ajouter au panier</button>

					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal location-->

		<!-- modal changer profil membre-->
		<div class="modal fade" id="modal-profil-Membre" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modifier Profil</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">


						<!-- Form changer profil membre-->

						<!-- <form class="formMembre" id="ProfilMembre" action="../serveur/modifierProfil.php" method="POST" onSubmit="return valider('ProfilMembre')"> -->
						<form class="formMembre" id="ProfilMembre">
							<input id="idMembre" name="idMembre" type="hidden">
							<div class="myInput">
								<label for="prenom" class="form-label">Prénom</label>
								<input type="text" class="form-control" id="profil-prenom" name="prenom" required>

							</div>
							<div class="myInput">
								<label for="nom" class="form-label">Nom</label>
								<input type="text" class="form-control" id="profil-nom" name="nom" required>

							</div>

							<div class="myInput">
								<label for="pages" class="form-label">Courriel</label>
								<input type="email" class="form-control" id="profil-email-Enreg" name="email" required>

							</div>

							<div class="myInput">
								<label for="password" class="form-label">Mot de passe</label>
								<input type="password" class="form-control" id="profil-password" name="password" required>
								<input class="montrerConfirmer" type="checkbox" onclick="montrerConfirmerPass()">Modifier le mot de passe
								<span id="msg-password-erreur">Le mot de passe doit être entre 8 et 10 charactères et doit contenir des lettres majuscules, minuscules, des chiffres et les charactères "-_" </span>

							</div>

							<div class="myInput" id="confirmerPasse">
								<label for="confirmPassword" class="form-label">Confirmer mot de passe</label>
								<input type="password" class="form-control" id="profil-confirmPassword" name="confirmPassword" required>
								<input class="montrerPassword" type="checkbox" onclick="montrerPassword2()">Montrer le mot de passe
								<span id="msg-confirm-password-erreur">Confirmation invalide</span>

							</div>

							<hr class="line">

							<div class="myInput">
								<p>Pour des raisons statistiques</p>

								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" value="M" id="profil-M">
									<label class="form-check-label" for="M">
										Homme
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="radio" name="sexe" value="F" id="profil-F">
									<label class="form-check-label" for="F">
										Femme
									</label>
								</div>

							</div>
							<div class="myInput">
								<label for="dateNaissance" class="form-label">Date de naissance</label>
								<input type="date" class="form-control" id="profil-dateNaissance" name="dateNaissance" required>
							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Modifier</button>
							</div>
						</form>

						<!-- Fin changer profil membre--->
					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal changer profil membre-->
		<!-- fin partie membre -->

		<!-- partie admin -->
		<!-- modal creer film-->
		<div class="modal fade" id="modal-creer-film" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Créer film</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Form creer film-->

						<form class="formFilm" id="form-creer-film">

							<input type="hidden" name="action" value="enregistrerFilm">

							<input type="submit" id="validation-creer-film" class="validation" />

							<div class="myInput">
								<label for="titre" class="form-label">Titre</label>
								<input type="text" class="form-control" id="titre" name="titre" required>

							</div>
							<div class="myInput">
								<label for="annee" class="form-label">Année</label>
								<input type="number" class="form-control" id="annee" name="annee" min="0" required>
							</div>

							<div class="myInput">
								<label for="duree" class="form-label">Durée</label>
								<input type="number" class="form-control" id="duree" name="duree" min="0" required>
							</div>

							<div class="myInput">
								<label for="realisateur" class="form-label">Réalisateur</label>
								<input type="text" class="form-control" id="realisateur" name="realisateur" required>


							</div>

							<div class="myInput">
								<label for="acteur" class="form-label">Acteur</label>
								<input type="text" class="form-control" id="acteur" name="acteur" required>

							</div>

							<div class="myInput">
								<label for="description" class="form-label">Description</label>
								<textarea rows="3" class="form-control" id="description" name="description" required></textarea>

							</div>

							<!-- genres -->
							<div class="myInput">
								<div class="genres-container">

									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="Comedy" name="genres[]">
										<label class="form-check-label" for="genres">
											Comedy
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Fantasy" name="genres[]">
										<label class="form-check-label" for="genres">
											Fantasy
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Crime" name="genres[]">
										<label class="form-check-label" for="genres">
											Crime
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Drama" name="genres[]">
										<label class="form-check-label" for="genres">
											Drama
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Music" name="genres[]">
										<label class="form-check-label" for="genres">
											Music
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Adventure" name="genres[]">
										<label class="form-check-label" for="genres">
											Adventure
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="History" name="genres[]">
										<label class="form-check-label" for="genres">
											History
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Thriller" name="genres[]">
										<label class="form-check-label" for="genres">
											Thriller
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Animation" name="genres[]">
										<label class="form-check-label" for="genres">
											Animation
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Family" name="genres[]">
										<label class="form-check-label" for="genres">
											Family
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Mystery" name="genres[]">
										<label class="form-check-label" for="genres">
											Mystery
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Biography" name="genres[]">
										<label class="form-check-label" for="genres">
											Biography
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Action" name="genres[]">
										<label class="form-check-label" for="genres">
											Action
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Film-Noir" name="genres[]">
										<label class="form-check-label" for="genres">
											Film-Noir
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Romance" name="genres[]">
										<label class="form-check-label" for="genres">
											Romance
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Sci-Fi" name="genres[]">
										<label class="form-check-label" for="genres">
											Sci-Fi
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="War" name="genres[]">
										<label class="form-check-label" for="genres">
											War
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Western" name="genres[]">
										<label class="form-check-label" for="genres">
											Western
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Horror" name="genres[]">
										<label class="form-check-label" for="genres">
											Horror
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Musical" name="genres[]">
										<label class="form-check-label" for="genres">
											Musical
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Sport" name="genres[]">
										<label class="form-check-label" for="genres">
											Sport
										</label>
									</div>

								</div>
							</div>
							<!-- fin genres -->
							<div class="myInput">
								<label for="prix" class="form-label">Prix</label>
								<input type="text" class="form-control" id="prix" name="prix" required>

							</div>
							<div class="myInput">
								<label for="image" class="form-label">Image</label>
								<input type="file" class="form-control" id="image" name="image">

							</div>

							<div class="myInput">
								<label for="bandeAnnonce" class="form-label">Bande Annonce</label>
								<input type="text" class="form-control" id="bandeAnnonce" name="bandeAnnonce">

							</div>

							<div class="modal-footer">

								<button type="button" class="btn btn-primary" onClick="enregistrerFilm()">Enregistrer Film</button>

							</div>
						</form>

						<!-- Fin form creer film-->
					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal creer film-->

		<!-- modal supprimer film-->
		<div class="modal fade" id="modal-Supprimer-Film" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Confirmer la suppression du film</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-footer">
						<form id="form-delete-film">
							<input type="hidden" id="id-film-delete" name="idFilm" value="">

							<input type="hidden" name="action" value="deleteFilm">

							<button type="button" class="btn btn-primary" onClick="deleteFilm()">Confirmer Suppression</button>						
						</form>

					</div>
					</form>


				</div>
			</div>
		</div>
		<!-- Fin modal supprimer film-->

		<!-- modal modifier film-->
		<div class="modal fade" id="modal-modifier-film" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Modifier film</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<!-- Form modifier film-->

						<form class="formMembre" id="formMembre">

							<input type="hidden" class="form-control" id="id-modifier" name="id">

							<div class="myInput">
								<label for="titre" class="form-label">Titre</label>
								<input type="text" class="form-control" id="titre-modifier" name="titre" required>

							</div>
							<div class="myInput">
								<label for="annee" class="form-label">Année</label>
								<input type="number" class="form-control" id="annee-modifier" name="annee" min="0" required>

							</div>

							<div class="myInput">
								<label for="duree" class="form-label">Durée</label>
								<input type="number" class="form-control" id="duree-modifier" name="duree" min="0" required>

							</div>

							<div class="myInput">
								<label for="realisateur" class="form-label">Réalisateur</label>
								<input type="text" class="form-control" id="realisateur-modifier" name="realisateur" required>


							</div>

							<div class="myInput">
								<label for="acteur" class="form-label">Acteur</label>
								<textarea rows="2" class="form-control" id="acteur-modifier" name="acteur" required></textarea>
								<!-- <input type="text" class="form-control" id="acteur-modifier" name="acteur" required> -->

							</div>
							<div class="myInput">
								<label for="description" class="form-label">Description</label>
								<textarea rows="3" class="form-control" id="description-modifier" name="description" required></textarea>

							</div>
							<!-- genres -->
							<div class="myInput">
								<div class="genres-container">

									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="Comedy" name="genres[]">
										<label class="form-check-label" for="genres">
											Comedy
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Fantasy" name="genres[]">
										<label class="form-check-label" for="genres">
											Fantasy
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Crime" name="genres[]">
										<label class="form-check-label" for="genres">
											Crime
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Drama" name="genres[]">
										<label class="form-check-label" for="genres">
											Drama
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Music" name="genres[]">
										<label class="form-check-label" for="genres">
											Music
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Adventure" name="genres[]">
										<label class="form-check-label" for="genres">
											Adventure
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="History" name="genres[]">
										<label class="form-check-label" for="genres">
											History
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Thriller" name="genres[]">
										<label class="form-check-label" for="genres">
											Thriller
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Animation" name="genres[]">
										<label class="form-check-label" for="genres">
											Animation
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Family" name="genres[]">
										<label class="form-check-label" for="genres">
											Family
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Mystery" name="genres[]">
										<label class="form-check-label" for="genres">
											Mystery
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Biography" name="genres[]">
										<label class="form-check-label" for="genres">
											Biography
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Action" name="genres[]">
										<label class="form-check-label" for="genres">
											Action
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Film-Noir" name="genres[]">
										<label class="form-check-label" for="genres">
											Film-Noir
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Romance" name="genres[]">
										<label class="form-check-label" for="genres">
											Romance
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Sci-Fi" name="genres[]">
										<label class="form-check-label" for="genres">
											Sci-Fi
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="War" name="genres[]">
										<label class="form-check-label" for="genres">
											War
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Western" name="genres[]">
										<label class="form-check-label" for="genres">
											Western
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Horror" name="genres[]">
										<label class="form-check-label" for="genres">
											Horror
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Musical" name="genres[]">
										<label class="form-check-label" for="genres">
											Musical
										</label>
									</div>
									<div class="form-check ">
										<input class="form-check-input" type="checkbox" value="Sport" name="genres[]">
										<label class="form-check-label" for="genres">
											Sport
										</label>
									</div>

								</div>
							</div>
							<!-- fin genres -->
							<div class="myInput">
								<label for="prix" class="form-label">Prix</label>
								<input type="text" class="form-control" id="prix-modifier" name="prix" required>

							</div>
							<div class="myInput">
								<label for="image" class="form-label">Image</label>
								<input type="file" class="form-control" id="image-modifier" name="image">

							</div>
							<div class="myInput">
								<label for="bandeAnnonce" class="form-label">Bande Annonce</label>
								<input type="text" class="form-control" id="bandeAnnonce-modifier" name="bandeAnnonce">

							</div>

							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Modifier Film</button>
							</div>
						</form>

						<!-- Fin form modifier film-->
					</div>

				</div>
			</div>
		</div>
		<!-- Fin modal modifier film-->

		<!-- modal activer membres-->
		<div class="modal fade" id="modal-Activer-Membre" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Confirmer la réactivation du membre</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-footer">
						<form id="form-activer-membre">
							<input type="hidden" id="id-membre-activer" name="idMembre">

							<input type="hidden" name="action" value="activerMembre">

							<button type="button" class="btn btn-primary" onClick="activerMembre()">Confirmer réactivation</button>
						</form>

					</div>
					</form>


				</div>
			</div>
		</div>
		<!-- Fin modal activer membres-->

		<!-- modal desactiver membres-->
		<div class="modal fade" id="modal-Supprimer-Membre" tabindex="-1">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Confirmer la suppression du membre</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>

					<div class="modal-footer">
						<form id="form-desactiver-membre">
							<input type="hidden" id="id-membre-delete" name="idMembre" value="">

							<input type="hidden" name="action" value="desactiverMembre">

							<button type="button" class="btn btn-primary" onClick="desactiverMembre()">Confirmer Suppression</button>
						</form>

					</div>
					</form>


				</div>
			</div>
		</div>
		<!-- Fin modal desactiver membres-->

		<!-- fin partie admin -->

		<script src="public/util/js/jquery-1.11.1.min.js"></script>
		<script src="public/util/js/plugins.js"></script>
		<script src="public/util/js/app.js"></script>
		<script src="https://www.paypal.com/sdk/js?client-id=AUtFTyAh5PZIv_bsuyJSvoZeMeTRYktsp7CHcRsYlOPBFlu7sMBqfiCY01bD0JBK0jtqMn-zXx-XeBfA&currency=CAD">
		</script>

</body>

</html>