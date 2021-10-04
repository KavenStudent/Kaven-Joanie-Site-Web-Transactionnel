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
							<a class="nav-link active" aria-current="page" href="#">Accueil</a>
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
				$requette = "SELECT * FROM films ORDER BY `films`.`annee` DESC";
				try {
					$listeFilms = mysqli_query($connexion, $requette);
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
						$rep .= '<a href="#" class="btn btn-primary">Plus d info </a>';
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

			</div> <!-- .container -->
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