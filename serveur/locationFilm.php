<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$requete="INSERT INTO location values(?,?,?,?)";
$stmt = $connexion->prepare($requete);

foreach($data as $film){

    $idFilm = $film['idFilm'];
    $idMembre = $film['idMembre'];
    $date =  date("Y-m-d");
    $dureeLocation = $film['dureeLocation'];

    $stmt->bind_param("iisi",  $idFilm, $idMembre, $date, $dureeLocation);
    $stmt->execute();
}