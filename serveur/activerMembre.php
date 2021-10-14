<?php
require_once("../BD/connexion.inc.php");

$idMembre = $_POST['idMembre'];
$statut = 1;

$requete = "UPDATE connexion SET statut=? WHERE idMembre=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("ii", $statut,$idMembre);
$stmt->execute();

mysqli_close($connexion);
header("Location:../pages/admin.php?id=$num&msg=Le+membre+à+été+réactivé");
?>