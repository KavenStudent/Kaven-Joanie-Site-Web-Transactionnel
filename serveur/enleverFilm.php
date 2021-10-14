<?php
 require_once("../BD/connexion.inc.php");
 $idFilm = $_POST['idFilm'];

 $requete="SELECT * FROM films WHERE idFilm=?";
 $stmt = $connexion->prepare($requete);
 $stmt->bind_param("i", $idFilm);
 $stmt->execute();
 $result = $stmt->get_result();

if(!$ligne = $result->fetch_object()){ // si le filme n'existe pas
 
    header("Location:../pages/listerFilms.php?msg=Le+film+$idFilm+n\'existe+pas");
	mysqli_close($connexion);
    exit;
}

$image=$ligne->image;
	if($image!="default.png"){
		$rmPoc='../imageFilm/'.$image;
		$tabFichiers = glob('../imageFilm/*');

		// parcourir les fichier
		foreach($tabFichiers as $fichier){
		  if(is_file($fichier) && $fichier==trim($rmPoc)) {
			// enlever le fichier
			unlink($fichier);
			break;
		  }
		}
	}
	// enleve le film de la bd
	$requete="DELETE FROM films WHERE idFilm=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();

	// enleve les genres du film de la bd
	$requete="DELETE FROM filmgenre WHERE idFilm=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();
	
	mysqli_close($connexion);
	header("Location:../pages/listerFilms.php?msg=Le+film+$idFilm+a+été+enlevé");
?>