<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$idFilm = $data['idFilm'];

try {
    $requete = "SELECT * FROM films WHERE idFilm=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $idFilm);
    $stmt->execute();
    $result = $stmt->get_result();
    $unFilm = $result->fetch_object(); // les infos du film

    $requete = "SELECT nomgenre as genre FROM `genre` INNER JOIN filmgenre on genre.idGenre = filmgenre.idGenre where filmgenre.idFilm = ?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("i", $idFilm);
    $stmt->execute();
    $result = $stmt->get_result();
    $genre = $result->fetch_object();

    while ($genre != null) {
        $lesGenres[] = $genre; // les genres du film
        $genre = $result->fetch_object();
    }

    $tab = [$unFilm, $lesGenres]; // fusion des informations dans un tableau

    echo json_encode($tab);
} catch (Exception $e) {
    echo "Problème avec la base de donnée";
} finally {
    mysqli_close($connexion);
}

?>