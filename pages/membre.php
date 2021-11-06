<?php
session_start();
require_once("../BD/connexion.inc.php");
if (!isset($_SESSION['membre'])) {
	header("Location:../pages/erreurConnexion.php");
}

if (isset($_GET['id'])) {
	// si la session id est different du id en get
	if ($_SESSION['membre'] != $_GET['id']) {
		header("Location:../pages/erreurConnexion.php");
	}

	$id = $_GET['id'];
	$msg = $_GET['msg'];

	$requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.motDePasse, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre WHERE m.idMembre = ?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();

	if ($ligne = $result->fetch_object()) {
		$idM = $ligne->idMembre;
		$prenom = $ligne->prenom;
		$nom = $ligne->nom;
		$courriel = $ligne->courriel;
		$sexe = $ligne->sexe;
		$motDePasse = $ligne->motDePasse;
		$dateDeNaissance = $ligne->dateDeNaissance;
	}
} else {
	$id = "-1";
	$msg = " ";
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

	<!-- Jquery -->
	<script src="../public/util/js/jquery-3.6.0.min.js"></script>
	<!-- bootstrap -->
	<script src="../public/util/bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../public/util/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="../public/util/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

	<!-- Loading main css file -->
	<link rel="stylesheet" href="../public/util/css/style.css">

	<link rel="stylesheet" href="../public/css/monStyle.css">
	<script src="../public/js/monScript.js"></script>


	<title>TP Joanie-Kaven</title>
</head>


<body onLoad="initialiser(<?php echo "'" . $msg . "'" ?>);">
	<input type="hidden" id="myMemberid" value="<?php echo $id; ?>">

	<div id=" site-content">
		<!-- nav bar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<div class="container-fluid">

				<div class="company">
					<img id="monLogo" class="navbar-brand" src="../public/images/icon-logo-film.png" alt="" class="logo">
					<h3> Kajo movie </h3>
				</div>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="javascript:retourAccueilM()">Accueil</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modal-Membre">Profil</a>
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
						</li>
						
					</ul>
					
					<div class="d-flex  nav-droite">
						<select class="form-select" onChange="lister('categ',this.options[this.selectedIndex].value)">
							<option value="dr">Choisir ...</option>
							<option value="Comedy">Comédie</option>
							<option value="Fantasy">Fantaisie</option>
							<option value="Drama">Drama</option>
							<option value="Music">Music</option>
							<option value="Adventure">Adventure</option>
							<option value="History">Historique</option>
							<option value="Thriller">Suspense</option>
							<option value="Animation">Animation</option>
							<option value="Familly">Famille</option>
							<option value="Biography">Biographie</option>
							<option value="Action">Action</option>
							<option value="Film-Noir">Film-Noir</option>
							<option value="Romance">Romance</option>
							<option value="Sci-Fi">Sci-Fi</option>
							<option value="War">Guerre</option>
							<option value="Western">Western</option>
							<option value="Horror">Horreur</option>
							<option value="Musical">Musical</option>
							<option value="Sport">Sport</option>
						</select>
					</div>

					<div class="d-flex nav-droite">
						<input class="inputSearch" type="search" id="rctitre" placeholder="Titre" aria-label="Recherche">
						<button class="btn btn-outline-success" onClick="lister('titre',document.getElementById('rctitre').value)">Recherche</button>
					</div>


					<div class="d-flex nav-droite">
						<input class="inputSearch" type="search" id="rcres" placeholder="Réalisateur" aria-label="Recherche">
						<button class="btn btn-outline-success" onClick="lister('res',document.getElementById('rcres').value)">Recherche</button>
					</div>

				</div>
			</div>
		</nav>
		<!-- fin nav bar -->

		<!-- TOAST -->
		<div class="toast-container position-absolute top-15 start-50 translate-middle-x" >
			<div id="toast" class="toast  align-items-center text-white bg-secondary border-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="10000">
				<div class="toast-header">
					<img src="../public/images/message.png" width=24 height=24 class="rounded me-2" alt="message">
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



				<!-- modal devenir membre-->
				<div class="modal fade" id="modal-Membre" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Modifier Profil</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">


								<!-- Form devenir membre-->

								<form class="formMembre" id="ProfilMembre" action="../serveur/modifierProfil.php" method="POST" onSubmit="return valider('ProfilMembre')">
									<input id="idMembre" name="idMembre" type="hidden" value="<?php echo $idM ?>">
									<div class="myInput">
										<label for="prenom" class="form-label">Prénom</label>
										<input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $prenom ?>" required>
										<div class="valid-feedback">

										</div>
									</div>
									<div class="myInput">
										<label for="nom" class="form-label">Nom</label>
										<input type="text" class="form-control" id="nom" name="nom" value="<?php echo $nom ?>" required>
										<div class="valid-feedback">

										</div>
									</div>

									<div class="myInput">
										<label for="pages" class="form-label">Courriel</label>
										<input type="email" class="form-control" id="email-Enreg" name="email" value="<?php echo $courriel ?>" required>
										<div class="valid-feedback">

										</div>
									</div>

									<div class="myInput">
										<label for="password" class="form-label">Mot de passe</label>
										<input type="password" class="form-control" id="password" name="password" value="<?php echo $motDePasse ?>" required>
										<input class="montrerConfirmer" type="checkbox" onclick="montrerConfirmerPass()">Modifier le mot de passe
										<span id="msg-password-erreur">Le mot de passe doit être entre 8 et 10 charactères et doit contenir des lettres majuscules, minuscules, des chiffres et les charactères "-_" </span>
										<div class="valid-feedback">

										</div>
									</div>

									<div class="myInput" id="confirmerPasse">
										<label for="confirmPassword" class="form-label">Confirmer mot de passe</label>
										<input type="password" class="form-control" id="confirmPassword" name="confirmPassword" value="<?php echo $motDePasse ?>" required>
										<input class="montrerPassword" type="checkbox" onclick="montrerPassword2()">Montrer le mot de passe
										<span id="msg-confirm-password-erreur">Confirmation invalide</span>
										<div class="valid-feedback">

										</div>
									</div>

									<hr class="line">

									<div class="myInput">
										<p>Pour des raisons statistiques</p>

										<div class="form-check">
											<input class="form-check-input" type="radio" name="sexe" value="M" id="M" <?php if ($sexe === 'M') echo 'checked' ?>>
											<label class="form-check-label" for="M">
												Homme
											</label>
										</div>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="sexe" value="F" id="F" <?php if ($sexe === 'F') echo 'checked' ?>>
											<label class="form-check-label" for="F">
												Femme
											</label>
										</div>

									</div>
									<div class="myInput">
										<label for="dateNaissance" class="form-label">Date de naissance</label>
										<input type="date" class="form-control" id="dateNaissance" name="dateNaissance" value="<?php echo $dateDeNaissance ?>" required>
									</div>

									<div class="modal-footer">
										<button type="submit" id="submit-Enreg" class="btn btn-primary">Modifier</button>
									</div>
								</form>

								<!-- Fin form devenir membre-->
							</div>

						</div>
					</div>
				</div>
				<!-- Fin modal devenir membre-->

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

				<?php
				require_once("../BD/connexion.inc.php");

				if (isset($_POST['par'])) {
					$par = $_POST['par'];
					$valeurPar = strtolower(trim($_POST['valeurPar']));
					switch ($par) {
						case "tout":
							$requette = "SELECT * FROM films WHERE 1=? ORDER BY annee DESC";
							$valeurPar = 1;
							break;
						case "res":
							$requette = "SELECT * FROM films WHERE LOWER(realisateurs) LIKE CONCAT('%', ?, '%') ORDER BY annee DESC";
							break;
						case "categ":
							$requette = "SELECT * FROM films f INNER JOIN filmgenre fg ON f.idFilm = fg.idFilm INNER JOIN genre g ON g.idGenre = fg.idGenre WHERE g.nomGenre = ? ORDER BY annee DESC";
							break;
						case "titre":
							$requette = "SELECT * FROM films WHERE LOWER(titre) LIKE CONCAT('%', ?, '%') ORDER BY annee DESC";
							break;
					}

					$stmt = $connexion->prepare($requette);
					$stmt->bind_param("s", $valeurPar);
					$stmt->execute();
					$listeFilms = $stmt->get_result();
				} else {
					$requette = "SELECT * FROM films ORDER BY `films`.`annee` DESC";
					$listeFilms = mysqli_query($connexion, $requette);
				}

				try {

					$rep = "<div class='page' id='liste-film'>";
					$i = 0;

					$rep .= ' <div class="row">';

					while ($ligne = mysqli_fetch_object($listeFilms)) {
						if ($i % 4 == 0) {
							$rep .= '</div>';
							$rep .= ' <div class="row">';
						}

						$rep .= '<div class="card">';



						if (substr($ligne->image, 0, 4) === "http") {
							$rep .= '<img class="image-film" src="' . ($ligne->image) . '" alt="image-film">';
						} else {
							$rep .= '<img class="image-film" src="../imageFilm/' . ($ligne->image) . '" alt="image film">';
						}


						$rep .= '<div class="card-body">';
						$rep .= '<h5 class="card-title">' . ($ligne->titre) . '(' . ($ligne->annee) . ')' . "</h5>";
						$rep .= '<p class="card-text">' . ($ligne->realisateurs) . '</p>';
						$rep .= '<p class="card-text">' . ($ligne->prix) . '$</p>';
						$rep .= '<a href="#" class="btn btn-primary" onclick="afficherTrailer(' . $ligne->idFilm . ',\'../serveur/fiche.php\')">Plus d\'info</a>';
						$rep .= '<a href="#" id="btnAJout" class="btn btn-primary" onclick="ajout(' . $ligne->idFilm . ')">Ajouter</a>';
						$rep .= '</div>';
						$rep .= '</div>';

						$i++;
					}
					$rep .= "</div>"; //fermer le dernier row				
					$rep .= "</div>"; //fermer le container
					mysqli_free_result($listeFilms);
				} catch (Exception $e) {
					echo "Probleme pour lister";
				} finally {
					echo $rep;
					unset($rep);
				}
				mysqli_close($connexion);
				?>

				<ul id="pagin">

				</ul>
			</div> <!-- .container -->
		</main>

		<!-- accueil membre -->
		<form id="formAccueilM" action="membre.php" methode="post">
			<input id="id" name="id" type="hidden" value="<?php echo $idM ?>">
			<input id="msg" name="msg" type="hidden" value="Bienvenue">
		</form>

		<!-- historique d'achat -->
		<form id="formHistorique" action="membreHistorique.php" methode="post">
			<input id="id" name="id" type="hidden" value="<?php echo $idM ?>">
			<input id="msg" name="msg" type="hidden" value="Bienvenue dans votre historique de location">
		</form>

		<!-- Location en cours -->
		<form id="formLocation" action="membreLocation.php" methode="post">
			<input id="id" name="id" type="hidden" value="<?php echo $idM ?>">
			<input id="msg" name="msg" type="hidden" value="Bienvenue dans vos location en cours">
		</form>

		<!--deconnexion -->
		<form id="deconnexion" action="../serveur/deconnexion.php" method="post"></form>

		<!-- canvas panier -->
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

		<script src="../public/util/js/jquery-1.11.1.min.js"></script>
		<script src="../public/util/js/plugins.js"></script>
		<script src="../public/util/js/app.js"></script>
		<script src="https://www.paypal.com/sdk/js?client-id=AUtFTyAh5PZIv_bsuyJSvoZeMeTRYktsp7CHcRsYlOPBFlu7sMBqfiCY01bD0JBK0jtqMn-zXx-XeBfA&currency=CAD">
		</script>


</body>

<form id="formLister" action="membre.php?id=<?php echo $idM?>&msg=" method="POST">
	<input type="hidden" id="par" name="par" value="tout">
	<input type="hidden" id="valeurPar" name="valeurPar" value="">
</form>

</html>