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
	$genres = $_POST['genres'];
	$prix = $_POST['prix'];
	$bandeAnnonce = $_POST['bandeAnnonce'];
	$dossier = "imageFilm";
	// $nomImage =sha1($titre.time());
	$image = "default.png";

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

function fiche()
{
	global $tabRes;
	$idf = $_POST['numF'];
	$tabRes['action'] = "fiche";
	$requete = "SELECT * FROM films WHERE idf=?";
	try {
		$unModele = new Modele($requete, array($idf));
		$stmt = $unModele->executer();
		$tabRes['fiche'] = array();
		if ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
			$tabRes['fiche'] = $ligne;
			$tabRes['OK'] = true;
		} else {
			$tabRes['OK'] = false;
		}
	} catch (Exception $e) {
	} finally {
		unset($unModele);
	}
}

function modifierFilm()
{
	global $tabRes;
	$titre = $_POST['titreF'];
	$duree = $_POST['dureeF'];
	$res = $_POST['resF'];
	$idf = $_POST['idf'];
	try {
		//Recuperer ancienne pochette
		$requette = "SELECT pochette FROM films WHERE idf=?";
		$unModele = new Modele($requette, array($idf));
		$stmt = $unModele->executer();
		$ligne = $stmt->fetch(PDO::FETCH_OBJ);
		$anciennePochette = $ligne->pochette;
		$pochette = $unModele->verserFichier("pochettes", "pochette", $anciennePochette, $titre);

		$requete = "UPDATE films SET titre=?,duree=?, res=?, pochette=? WHERE idf=?";
		$unModele = new Modele($requete, array($titre, $duree, $res, $pochette, $idf));
		$stmt = $unModele->executer();
		$tabRes['action'] = "modifierFilm";
		$tabRes['msg'] = "Film $idf bien modifie";
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
	case "fiche":
		fiche();
		break;
	case "modifierFilm":
		modifierFilm();
		break;
	case "tableFilms":
		tableFilms();
		break;
}
echo json_encode($tabRes);
