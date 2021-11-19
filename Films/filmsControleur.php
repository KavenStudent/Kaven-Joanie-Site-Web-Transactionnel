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
	$dossier = "imageFilm";

	$dao = new FilmDaoImp();
	$nouveauFilm = new Film(0, $titre, $annee, $duree, $realisateur, $acteur, $description, $image, $bandeAnnonce, $prix, $tabGenres);
	$id = $dao->enregistrerFilm($nouveauFilm, $dossier);

	$tabRes['msg'] = "Le film $id a été enregistré";
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

	if(strcasecmp($par, "tout") === 0){
		$par = "id";
	}

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
	$tabGenres = $_POST['genres'];
	$image = "default.png";

	$dao = new FilmDaoImp();
	$nouveauFilm = new Film($idFilm, $titre, $annee, $duree, $realisateur, $acteur, $description, $image, $bandeAnnonce, $prix, $tabGenres);
	$id = $dao->enregistrerFilm($nouveauFilm, $dossier);

	$tabRes['action'] = "modifierFilm";
	$tabRes['msg'] = "Le film $id a été modifié";
	$tabRes['listeFilms'] = $dao->getAllFilms("id", 1);
	
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
	$dao = new FilmDaoImp();
	$total = $dao->enregistrerPanier($panier);

	$tabRes['msg'] = "Transaction de $total $ complété";
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
