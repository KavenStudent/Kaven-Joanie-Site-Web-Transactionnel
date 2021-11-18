<?php
session_start();
require_once("../includes/modeles.inc.php");
require_once("film_DAO.inc.php");

$tabRes = array();


function enregistrerFilm()
{
	global $tabRes;
	
	$titre = $_POST['titre'];
	$annee = $_POST['annee'];
	$duree = $_POST['duree'];
	$realisateur = $_POST['realisateur'];
	$acteur = $_POST['acteur'];
	$description = $_POST['description'];
	$prix = $_POST['prix'];
	$bandeAnnonce = $_POST['bandeAnnonce'];
	$image = "default.png";
	$tabGenres = $_POST['genres'];
	$tabRes['action'] = "enregistrerFilm";

	$dao = new FilmDaoImp();
	$nouveauFilm = new Film(0, $titre, $annee, $duree, $realisateur, $acteur, $description, $image, $bandeAnnonce, $prix, $tabGenres);

	$tabRes['msg'] = $dao->enregistrerFilm($nouveauFilm);
	$tabRes['listeFilms'] = $dao->getAllFilms("tout", 1);
	
}

function listerFilms()
{
	global $tabRes;
	$par = $_POST['par'];
	$valeurPar = strtolower(trim($_POST['valeurPar']));
	$tabRes['action'] = "listerFilms";

	if (isset($_SESSION['membre'])) { // pour ajouter le bouton panier dans les cards des membres
		$tabRes['membre'] = $_SESSION['membre'];
	}

	$dao = new FilmDaoImp();

	$tabRes['listeFilms'] = $dao->getAllFilms($par, $valeurPar);
}

function tableFilms()
{
	global $tabRes;
	$par = $_POST['par'];
	$valeurPar = strtolower(trim($_POST['valeurPar']));
	$tabRes['action'] = "tableFilms";

	$dao = new FilmDaoImp();

	$tabRes['listeFilms'] = $dao->getAllFilms($par, $valeurPar);
}

function deleteFilm()
{
	global $tabRes;
	$dao = new FilmDaoImp();
	$idFilm = $_POST['idFilm'];
	$tabRes['action'] = "deleteFilm";

	$dao->deleteFilm($idFilm);

	$tabRes['listeFilms'] = $dao->getAllFilms("tout", 1);

	$tabRes['msg'] = "Le film $idFilm a été enlevé";
}

function modifierFilm()
{
	global $tabRes;
	$idFilm = $_POST['id'];
	$titre = $_POST['titre'];
	$annee = $_POST['annee'];
	$duree = $_POST['duree'];
	$realisateur = $_POST['realisateur'];
	$acteur = $_POST['acteur'];
	$description = $_POST['description'];
	$prix = $_POST['prix'];
	$bandeAnnonce = $_POST['bandeAnnonce'];
	$dossier = "imageFilm";

	try {
		// cherche l'image du film
		$requete = "SELECT image FROM films WHERE idFilm=?";
		$unModele = new Modele($requete, array($idFilm));
		$stmt = $unModele->executer();
		$ligne = $stmt->fetch(PDO::FETCH_OBJ);
		$ancienneImage = $ligne->image;

		$image = $unModele->verserFichier($dossier, "image", $ancienneImage, $titre);

		// update du film
		$requete = "UPDATE films SET titre=?,annee=?,duree=?,realisateurs=?,acteurs=?,description=?,image=?,bandeAnnonce=?,prix=? WHERE idFilm=?";
		$unModele = new Modele($requete, array($titre, $annee, $duree, $realisateur, $acteur, $description, $image, $bandeAnnonce, $prix, $idFilm));
		$stmt = $unModele->executer();

		// delete les genres du film
		$requete = "DELETE FROM filmgenre WHERE idFilm=?";
		$unModele = new Modele($requete, array($idFilm));
		$stmt = $unModele->executer();

		// ajout des genres du film
		$tabGenres = $_POST['genres'];

		foreach ($tabGenres as $genre) {
			$requete = "SELECT idGenre FROM genre WHERE nomGenre LIKE ?";
			$unModele = new Modele($requete, array($genre));
			$stmt = $unModele->executer();

			$result = $stmt->fetch();
			$idGenre = $result['idGenre'];

			$requete = "INSERT INTO filmgenre values(?,?)";
			$unModele = new Modele($requete, array($idFilm, $idGenre));
			$stmt = $unModele->executer();
		}

		$requete = "SELECT * FROM films ORDER BY idFilm";
		$unModele = new Modele($requete, array());
		$stmt = $unModele->executer();
		$tabRes['listeFilms'] = array();

		while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['listeFilms'][] = $ligne;
		}

		$tabRes['action'] = "modifierFilm";
		$tabRes['msg'] = "Le film $idFilm a été modifié";
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}

function fiche($usage)
{
	global $tabRes;
	$idFilm = $_POST['idFilm'];
	if (strcasecmp($usage, "panier") === 0) {
		$tabRes['duree'] = (int)$_POST['jour'];
	}
	$tabRes['action'] = $usage;

	$dao = new FilmDaoImp();

	$unFilm = array();
	
	// convertissement du l'objet en array et en enleve le "Film" dans chaque attribut 
	foreach ((array) $dao->getFilm($idFilm) as $k => $v) {
		$k = preg_match('/^\x00(?:.*?)\x00(.+)/', $k, $matches) ? $matches[1] : $k;
		$unFilm[$k] = $v;
	}

	$tabRes['unFilm'] = $unFilm;

	foreach ($unFilm['genres'] as $genre) {
		$tabRes['lesGenres'][] =  $genre;
	}

}

function enregistrerPanier()
{
	global $tabRes;
	$panier = $_POST['panier'];
	$date = date("Y-m-d");
	$total = 0;
	try {


		// parcours les item achetes et les insere dans location
		foreach ($panier as $film) {
			$total += (float)$film['prix'];

			$idFilm = $film['idFilm'];
			$dureeLocation = $film['dureeLocation'];
			$idMembre = $film['idMembre'];

			$requete = "INSERT INTO location values(?,?,?,?)";
			$unModele = new Modele($requete, array($idFilm, $idMembre, $date, $dureeLocation));
			$stmt = $unModele->executer();
		}

		//parcours les item achetes et les insere dans paiement
		foreach ($panier as $film) {

			$idMembre = $film['idMembre'];
			$idFilm = $film['idFilm'];
			$prixFilm = $film['prix'];

			$requete = "INSERT INTO paiement values(0,?,?,?,?)";
			$unModele = new Modele($requete, array($idMembre, $idFilm,  $date, $prixFilm));
			$stmt = $unModele->executer();
		}

		$tabRes['msg'] = "Transaction de $total $ complété";
	} finally {
		unset($unModele);
	}
}

//Controleur
$action = $_POST['action'];
switch ($action) {
	case "enregistrerFilm":
		enregistrerFilm();
		break;
	case "listerFilms":
		listerFilms();
		break;
	case "deleteFilm":
		deleteFilm();
		break;
	case "formModifierFilm":
		fiche("formModifierFilm");
		break;
	case "trailer":
		fiche("trailer");
		break;
	case "panier":
		fiche("panier");
		break;
	case "modifierFilm":
		modifierFilm();
		break;
	case "tableFilms":
		tableFilms();
		break;
	case "payerPanier":
		enregistrerPanier();
		break;
}

echo json_encode($tabRes);
