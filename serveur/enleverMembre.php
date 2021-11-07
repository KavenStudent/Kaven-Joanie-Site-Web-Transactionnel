<?php
require_once("../BD/connexion.inc.php");

$idMembre = $_POST['idMembre'];
$statut = 0;

try {

    if ($idMembre == 1) { // si admin
        header("Location:../pages/listerMembres.php?msg=Impossible+de+modifier+l\'administrateur");
        mysqli_close($connexion);
        exit;
    }

    $requete = "UPDATE connexion SET statut=? WHERE idMembre=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("ii", $statut, $idMembre);
    $stmt->execute();

    header("Location:../pages/listerMembres.php?msg=Le+membre+$idMembre+a+été+désactivé");
} catch (Exception $e) {
    echo "Problème avec la base de donnée";
} finally {
    mysqli_close($connexion);
}

?>