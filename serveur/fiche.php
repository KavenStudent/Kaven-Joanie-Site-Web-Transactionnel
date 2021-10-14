<?php
require_once("../BD/connexion.inc.php");

$id = $_POST['id'];
print_r($_POST);
// $requete="SELECT * FROM films WHERE idf=?";
// $stmt = $connexion->prepare($requete);
// $stmt->bind_param("i", $id);
// $stmt->execute();
// $result = $stmt->get_result();
// $ligne = $result->fetch_object();
   
// mysqli_close($connexion);
echo 1;
//print_r($_POST);
echo json_encode($ligne);

?>