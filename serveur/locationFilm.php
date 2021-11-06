<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$requete="INSERT INTO location values(?,?,?,?)";
$stmt = $connexion->prepare($requete);

$date =  date("Y-m-d");

// parcours les item achetes et les insere dans location
foreach ($data as $film) {

    $idFilm = $film['idFilm'];
    $dureeLocation = $film['dureeLocation'];
    $idMembre = $film['idMembre'];

    $stmt->bind_param("iisi",  $idFilm, $idMembre, $date, $dureeLocation);
    $stmt->execute();

}

$requete="INSERT INTO paiement values(0,?,?,?,?)";
$stmt = $connexion->prepare($requete);

// parcours les item achetes et les insere dans paiement
foreach($data as $film){

    $idMembre = $film['idMembre'];
    $idFilm = $film['idFilm'];
    $prixFilm = $film['prix'];

    $stmt->bind_param("iiss",  $idMembre , $idFilm,  $date, $prixFilm);
    $stmt->execute();
}

mysqli_close($connexion);