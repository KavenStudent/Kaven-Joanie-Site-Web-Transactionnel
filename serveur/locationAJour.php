<?php
require_once("../BD/connexion.inc.php");

//Calcule le nombre de jour entre 2 dates
function NbJours($debut, $fin)
{

    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

    return (($diff / 86400));
}

$requette = "SELECT f.idFilm, f.titre ,l.dateAchat, l.dureeLocation, f.image FROM location l INNER JOIN films f ON l.idFilm = f.idFilm WHERE l.idMembre = $idM ORDER by l.dateAchat DESC ";
try {
    $listLocation = mysqli_query($connexion, $requette);

    while ($ligne = mysqli_fetch_object($listLocation)) {

        $dateAujourd = date("Y-m-d");
        $dateDatetime =  $ligne->dateAchat;
        $dateDeFin = date("Y-m-d", strtotime($dateDatetime . "+ $ligne->dureeLocation days"));

        if (NbJours($dateAujourd, $dateDeFin) < 0) {

            $idFilm = $ligne->idFilm;
            $requete1 = "DELETE FROM location WHERE idFilm=?";
            $stmt = $connexion->prepare($requete1);
            $stmt->bind_param("i", $idFilm);
            $stmt->execute();

            $requete1 = "INSERT INTO historiquelocation VALUES(?,?,?)";
            $stmt = $connexion->prepare($requete1);
            $stmt->bind_param("iis", $idFilm, $idM, $dateDatetime);
            $stmt->execute();
        }
    }
    mysqli_free_result($listLocation);
} catch (Exception $e) {
    echo "Probleme pour lister";
}

?>