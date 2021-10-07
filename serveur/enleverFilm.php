<?php
 require_once("../BD/connexion.inc.php");
 $idFilm = $_POST['idFilm'];

 $requete="SELECT * FROM films WHERE idFilm=?";
 $stmt = $connexion->prepare($requete);
 $stmt->bind_param("i", $idFilm);
 $stmt->execute();
 $result = $stmt->get_result();

if(!$ligne = $result->fetch_object()){
    //echo "Film ".$idFilm." introuvable";
    mysqli_close($connexion);
    exit;
    header("Location:../films.php?id=$num&msg=Le+film+$idFilm+n'existe+pas");
}
$image=$ligne->image;
	if($image!="default.jpg"){
		$rmPoc='../imageFilm/'.$image;
		$tabFichiers = glob('../imageFilm/*');
		//print_r($tabFichiers);
		// parcourir les fichier
		foreach($tabFichiers as $fichier){
		  if(is_file($fichier) && $fichier==trim($rmPoc)) {
			// enlever le fichier
			unlink($fichier);
			break;
		  }
		}
	}
	$requete="DELETE FROM films WHERE idFilm=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();

	$requete="DELETE FROM filmgenre WHERE idFilm=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();
	
	mysqli_close($connexion);
	header("Location:../pages/admin.php?id=$num&msg=Le+film+à+été+enlevé");
?>