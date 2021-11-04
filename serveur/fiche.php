<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$idFilm = $data['idFilm'];

$requete="SELECT * FROM films WHERE idFilm=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $idFilm);
$stmt->execute();
$result = $stmt->get_result();
$unFilm = $result->fetch_object();

$requete= "SELECT nomgenre as genre FROM `genre` INNER JOIN filmgenre on genre.idGenre = filmgenre.idGenre where filmgenre.idFilm = ?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $idFilm);
$stmt->execute();
$result = $stmt->get_result();
$genre = $result->fetch_object();

while ($genre != null){
    $lesGenres[] =  $genre;
    $genre = $result->fetch_object();
}

mysqli_close($connexion);

$tab = [$unFilm, $lesGenres];

echo json_encode($tab);

?>