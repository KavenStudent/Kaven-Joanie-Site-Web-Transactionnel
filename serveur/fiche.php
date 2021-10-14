<?php
require_once("../BD/connexion.inc.php");


$data = json_decode(file_get_contents('php://input'), true);
$id = $data['idFilm'];

$requete="SELECT * FROM films WHERE idf=?";
$stmt = $connexion->prepare($requete);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$ligne = $result->fetch_object();
   
// mysqli_close($connexion);

//print_r($_POST);
// echo json_encode($ligne);

?>