<?php
    require_once("../BD/connexion.inc.php");
    $titre = $_POST['titre'];
    $annee = $_POST['annee'];
	$duree = $_POST['duree'];
	$realisateur = $_POST['realisateur'];
    $acteur = $_POST['acteur'];
    $description = $_POST['description'];
    $genres = $_POST['genres'];
    $prix = $_POST['prix'];
    $bandeAnnonce = $_POST['bandeAnnonce'];
    $dossier = "../imageFilm/";
    $nomImage =sha1($titre.time());
    $image = "default.png";

try {
    if($_FILES['image']['tmp_name']!==""){

		$tmp = $_FILES['image']['tmp_name'];
		$fichier= $_FILES['image']['name'];
		$extension=strrchr($fichier,'.');
		$test = @move_uploaded_file($tmp,$dossier.$nomImage.$extension);

		@unlink($tmp); 
		$image=$nomImage.$extension;
	}

    // enregistrer film dans la bd
    $requete="INSERT INTO films values(0,?,?,?,?,?,?,?,?,?)";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("siissssss",  $titre,$annee,$duree,$realisateur,$acteur,$description,$image,$bandeAnnonce,$prix);
    $stmt->execute();

    $id = $connexion->insert_id;
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
        $stmt->bind_param("ii", $id, $idGenre);
        $stmt->execute();
    }

    header("Location:../pages/admin.php?msg=Le+film+$id+a+été+enregistré");
} catch (Exception $e) {
    echo "Problème avec la base de donnée";
} finally {
    mysqli_close($connexion);
}

?>