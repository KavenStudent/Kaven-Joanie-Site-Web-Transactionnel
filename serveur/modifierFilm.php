<?php
    require_once("../BD/connexion.inc.php");
    $idFilm = $_POST['id'];
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
	$duree = $_POST['duree'];
	$realisateur = $_POST['realisateur'];
    $acteur = $_POST['acteur'];
    $description = $_POST['description'];
    $genres = $_POST['genres'];
    $prix = $_POST['prix'];
    $dossier = "../imageFilm/";
    $nomImage =sha1($titre.time());

    $requette="SELECT image FROM films WHERE idFilm=?";
	$stmt = $connexion->prepare($requette);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();
	$result = $stmt->get_result();
	$ligne = $result->fetch_object();

	$image=$ligne->image;
    //image
    if($_FILES['image']['tmp_name']!==""){
		//enlever ancienne pochette
		if($image!="default.png"){
			$rmPoc='../imageFilm/'.$image;
			$tabFichiers = glob('../imageFilm/*');

			// parcourir les fichier
			foreach($tabFichiers as $fichier){
			  if(is_file($fichier) && $fichier==trim($rmPoc)) {
				// enlever le fichier
				unlink($fichier);
				break;
				//
			  }
			}
		}
		$nomImage=sha1($titre.time());
		//Upload de la photo
		$tmp = $_FILES['image']['tmp_name'];
		$fichier= $_FILES['image']['name'];
		$extension=strrchr($fichier,'.');
		$image=$nomImage.$extension;
		@move_uploaded_file($tmp,$dossier.$nomImage.$extension);
		// Enlever le fichier temporaire chargé
		@unlink($tmp); //effacer le fichier temporaire
	}

    // update du film
    $requette="UPDATE films SET titre=?,annee=?,duree=?,realisateurs=?,acteurs=?,description=?,image=?,prix=? WHERE idFilm=?";
	$stmt = $connexion->prepare($requette);
    $stmt->bind_param("siisssssi",  $titre,$annee,$duree,$realisateur,$acteur,$description,$image,$prix,$idFilm);
	$stmt->execute();

    // delete les genres du film
    $requete="DELETE FROM filmgenre WHERE idFilm=?";
	$stmt = $connexion->prepare($requete);
	$stmt->bind_param("i", $idFilm);
	$stmt->execute();

    // ajout des genres du film
    $tabGenres = $_POST['genres'];

    foreach($tabGenres as $genre){
        $requete="SELECT idGenre FROM genre WHERE nomGenre LIKE ?";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("s", $genre);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_array();
        $idGenre = $result['idGenre'];

        $requete="INSERT INTO filmgenre values(?,?)";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("ii", $idFilm, $idGenre);
        $stmt->execute();
    }

	mysqli_close($connexion);
	header("Location:../pages/admin.php?id=$idFilm&msg=Le+film+à+été+modifié");
?>