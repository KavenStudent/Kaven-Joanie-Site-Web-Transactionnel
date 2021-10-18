<?php
if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
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

	<title>Movie Review</title>

	<!-- Jquery -->
	<script src="../public/util/js/jquery-3.6.0.min.js"></script>
	<!-- bootstrap -->
	<script src="../public/util/bootstrap-5.0.0-beta3-dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../public/util/bootstrap-5.0.0-beta3-dist/css/bootstrap.min.css">

	<!-- Loading third party fonts -->
	<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
	<link href="../public/util/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Loading main css file -->
	<link rel="stylesheet" href="../public/util/css/style.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<link rel="stylesheet" href="../public/css/monStyle.css">
	<script src="../public/js/monScript.js"></script>

	<title>TP Joanie-Kaven</title>
</head>


<body onLoad="initialiser(<?php echo "'" . $msg . "'" ?>);">

	<div id=" site-content">
		<!-- nav bar -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<div class="container-fluid">

				<!-- logo a mettre -->
				<div class="company">
					<img id="monLogo" class="navbar-brand" src="../public/images/icon-logo-film.png" alt="" class="logo">
					<h3> Kajo movie </h3>
				</div>
				<!-- <a class="navbar-brand" href="#">Navbar</a> -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item">
							<a class="nav-link" href="javascript:AccueilAdmin();">Accueil</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="" data-bs-toggle="modal" data-bs-target="#modal-creer-film">Enregistrer Film</a>
						</li>

						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="javascript:listerFilms();">Lister Films</a>
						</li>

						<li class="nav-item">
							<a class="nav-link" href="javascript:listerMembres();" onclick="">Lister Membres</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="../index.php">Déconnexion</a>
						</li>
					</ul>
					<form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</nav>
		<!-- fin nav bar -->

		<main class="main-content">

			<div class="container">

				<!-- TOAST -->
				<div class="toast-container posToast">
					<div id="toast" class="toast  align-items-center text-white bg-danger border-0" data-bs-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
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

				<?php
				require_once("../BD/connexion.inc.php");

				$requette = "SELECT * FROM films ORDER BY `films`.`idFilm` ASC";

				try {
					$listeFilms = mysqli_query($connexion, $requette);
					$rep = "<div class='page' id='liste-film'>";

					$rep .= '<div class="container-xl">	<div class="table-responsive"> <div class="table-wrapper">	<table class="table table-striped table-hover">';
					$rep .= '<thead> <tr> <th>ID</th> <th>Titre</th> <th>Année</th> <th>Durée</th> <th>Réalisateur</th>';
					$rep .= '<th>Acteurs</th> <th>Prix</th> <th>Image</th> <th>Actions</th> </tr> </thead> <tbody>';

					while ($ligne = mysqli_fetch_object($listeFilms)) {
						// table
						$rep .= '<tr><td>' . ($ligne->idFilm) . '</td>';
						$rep .= '<td>' . ($ligne->titre) . '</td>';
						$rep .= '<td>' . ($ligne->annee) . '</td>';
						$rep .= '<td>' . ($ligne->duree) . '</td>';
						$rep .= '<td>' . ($ligne->realisateurs) . '</td>';
						$rep .= '<td>' . ($ligne->acteurs) . '</td>';
						$rep .= '<td>' . ($ligne->prix) . '$</td>';

						if (substr($ligne->image, 0, 4) === "http") {
							$rep .= '<td><img id="icon-film" class="image-film" src="' . ($ligne->image) . '" alt="image-film"></td>';
						} else {
							$rep .= '<td><img id="icon-film" class="image-film" src="../imageFilm/' . ($ligne->image) . '" alt="image film"></td>';
						}

						$rep .= '<td> <a class="btn btn-primary myButton" onclick="populerModal(' . $ligne->idFilm . ')"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a> </td>';
						$rep .= '<td> <a class="btn btn-primary myButton" data-bs-toggle="modal" data-bs-target="#modal-Supprimer-Film" onclick="envoyerIdFilm(' . $ligne->idFilm . ')"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a> </td>	</tr>';
					}

					$rep .= '</tbody> </table> </div> </div> </div>'; //fin 
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

			</div> <!-- .container -->

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

							<form class="formMembre" id="formMembre" enctype="multipart/form-data" action="../serveur/enregistrerFilm.php" method="POST">
								<div class="myInput">
									<label for="titre" class="form-label">Titre</label>
									<input type="text" class="form-control" id="titre" name="titre" required>
									<div class="valid-feedback">

									</div>
								</div>
								<div class="myInput">
									<label for="annee" class="form-label">Année</label>
									<input type="number" class="form-control" id="annee" name="annee" min="0" required>
									<div class="valid-feedback">

									</div>
								</div>

								<div class="myInput">
									<label for="duree" class="form-label">Durée</label>
									<input type="number" class="form-control" id="duree" name="duree" min="0" required>
									<div class="valid-feedback">

									</div>
								</div>

								<div class="myInput">
									<label for="realisateur" class="form-label">Réalisateur</label>
									<input type="text" class="form-control" id="realisateur" name="realisateur" required>


								</div>

								<div class="myInput">
									<label for="acteur" class="form-label">Acteur</label>
									<textarea rows="2" class="form-control" id="acteur" name="acteur" required></textarea>

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


								<div class="modal-footer">
									<button type="submit" id="submit-Film" class="btn btn-primary">Enregistrer Film</button>
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
							<form id="formFiche" action="../serveur/enleverFilm.php" method="POST">
								<input type="hidden" id="id-film-delete" name="idFilm" value="">

								<button type="submit" id="submit-Connexion" class="btn btn-primary">Confirmer Suppression</button>
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

							<form class="formMembre" id="formMembre" enctype="multipart/form-data" action="../serveur/modifierFilm.php" method="POST">

								<input type="hidden" class="form-control" id="id-modifier" name="id">

								<div class="myInput">
									<label for="titre" class="form-label">Titre</label>
									<input type="text" class="form-control" id="titre-modifier" name="titre" required>
									<div class="valid-feedback">

									</div>
								</div>
								<div class="myInput">
									<label for="annee" class="form-label">Année</label>
									<input type="number" class="form-control" id="annee-modifier" name="annee" min="0" required>
									<div class="valid-feedback">

									</div>
								</div>

								<div class="myInput">
									<label for="duree" class="form-label">Durée</label>
									<input type="number" class="form-control" id="duree-modifier" name="duree" min="0" required>
									<div class="valid-feedback">

									</div>
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
									<input type="file" class="form-control" id="image" name="image">

								</div>


								<div class="modal-footer">
									<button type="submit" id="submit-Film" class="btn btn-primary">Modifier Film</button>
								</div>
							</form>

							<!-- Fin form modifier film-->
						</div>

					</div>
				</div>
			</div>
			<!-- Fin modal modifier film-->

			<!--lister films  -->
			<form id="formListerFilms" action="listerFilms.php" method="post"></form>

			<!--lister membres  -->
			<form id="formListerMembres" action="listerMembres.php" method="post"></form>

			<!--Accueil admin  -->
			<form id="formAccueilAdmin" action="admin.php" method="post"></form>
		</main>

		<footer class="site-footer">
			<div class="container">


				<div class="colophon">Copyright 2014 Company name, Designed by Themezy. All rights reserved</div>
			</div> <!-- .container -->

		</footer>

		<script src="../public/util/js/jquery-1.11.1.min.js"></script>
		<script src="../public/util/js/plugins.js"></script>
		<script src="../public/util/js/app.js"></script>

</body>

</html>