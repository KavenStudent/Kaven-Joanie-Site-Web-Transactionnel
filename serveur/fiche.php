<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$idFilm = $data['idFilm'];

$requete="SELECT * FROM films WHERE idFilm=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $idFilm);
$stmt->execute();
$result = $stmt->get_result();
$ligne = $result->fetch_object();
   
mysqli_close($connexion);

echo json_encode($ligne);

?>