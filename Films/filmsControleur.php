<?php
session_start();
require_once("../includes/modeles.inc.php");
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
	$dossier = "imageFilm";
	$image = "default.png";

	$nomImage = sha1($titre . time());
	try {
		$unModele = new Modele();
		$image = $unModele->verserFichier($dossier, "image", $image, $titre);

		// enregistrer film
		$requete = "INSERT INTO films values(0,?,?,?,?,?,?,?,?,?)";
		$unModele = new Modele($requete, array($titre, $annee, $duree, $realisateur, $acteur, $description, $image, $bandeAnnonce, $prix));
		$stmt = $unModele->executer();

		$id = $unModele->getLastId();
		$tabGenres = $_POST['genres'];

		foreach ($tabGenres as $genre) {
			$requete = "SELECT idGenre FROM genre WHERE nomGenre LIKE ?";
			$unModele = new Modele($requete, array($genre));
			$stmt = $unModele->executer();

			$result = $stmt->fetch();
			$idGenre = $result['idGenre'];

			$requete = "INSERT INTO filmgenre values(?,?)";
			$unModele = new Modele($requete, array($id, $idGenre));
			$stmt = $unModele->executer();
		}

		$requete = "SELECT * FROM films ORDER BY idFilm";
		$unModele = new Modele($requete, array());
		$stmt = $unModele->executer();
		$tabRes['listeFilms'] = array();

		while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['listeFilms'][] = $ligne;
		}

		$tabRes['action'] = "enregistrerFilm";
		$tabRes['msg'] = "Le film $id a été enregistré";
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}

function listerFilms()
{
	global $tabRes;
	if (isset($_SESSION['membre'])) {
		$tabRes['membre'] = $_SESSION['membre'];
	}

	$tabRes['action'] = "listerFilms";
	$requete = "SELECT * FROM films ORDER BY `films`.`annee` DESC";
	try {
		$unModele = new Modele($requete, array());
		$stmt = $unModele->executer();
		$tabRes['listeFilms'] = array();
		while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['listeFilms'][] = $ligne;
		}
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}

function tableFilms()
{
	global $tabRes;
	$tabRes['action'] = "tableFilms";

	$requete = "SELECT * FROM films ORDER BY idFilm";
	try {
		$unModele = new Modele($requete, array());
		$stmt = $unModele->executer();
		$tabRes['listeFilms'] = array();

		while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['listeFilms'][] = $ligne;
		}
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}

function deleteFilm()
{
	global $tabRes;

	$idFilm = $_POST['idFilm'];
	try {
		$requete = "SELECT * FROM films WHERE idFilm=?";
		$unModele = new Modele($requete, array($idFilm));
		$stmt = $unModele->executer();

		if ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$unModele->enleverFichier("imageFilm", $ligne->image); // enleve l'image

			// enleve le film de la bd
			$requete = "DELETE FROM films WHERE idFilm=?";
			$unModele = new Modele($requete, array($idFilm));
			$stmt = $unModele->executer();

			// enleve les genres du film de la bd
			$requete = "DELETE FROM filmgenre WHERE idFilm=?";
			$unModele = new Modele($requete, array($idFilm));
			$stmt = $unModele->executer();

			$requete = "SELECT * FROM films ORDER BY idFilm";
			$unModele = new Modele($requete, array());
			$stmt = $unModele->executer();
			$tabRes['listeFilms'] = array();

			while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
				$tabRes['listeFilms'][] = $ligne;
			}
			$tabRes['action'] = "deleteFilm";
			$tabRes['msg'] = "Le film $idFilm a été enlevé";
		} else {
			$tabRes['action'] = "deleteFilm";
			$tabRes['msg'] = "Le film $idFilm n'existe pas";
		}
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
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

	try {
		// les info du film
		$requete = "SELECT * FROM films WHERE idFilm=?";
		$unModele = new Modele($requete, array($idFilm));
		$stmt = $unModele->executer();		
		$tabRes['unFilm'] = $stmt->fetch(PDO::FETCH_OBJ); // les infos du film
	
		//les genres du film
		$requete = "SELECT nomgenre as genre FROM `genre` INNER JOIN filmgenre on genre.idGenre = filmgenre.idGenre where filmgenre.idFilm = ?";
		$unModele = new Modele($requete, array($idFilm));
		$stmt = $unModele->executer();

		while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['lesGenres'][] = $ligne;
		}

		$tabRes['action'] = $usage;
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}
//******************************************************
//Controller
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
	case "modifierFilm":
		modifierFilm();
		break;
	case "tableFilms":
		tableFilms();
		break;
}
echo json_encode($tabRes);
