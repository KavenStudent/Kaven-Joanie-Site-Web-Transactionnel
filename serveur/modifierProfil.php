<?php
require_once("../BD/connexion.inc.php");
$idMembre = $_POST['idMembre'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];
$sexe = $_POST['sexe'];
$dateNaissance = $_POST['dateNaissance'];

define("MSG_EXISTE_DEJA", "<h2>Le courriel : ".$email." est déjà utilisé. Choisissez un autre courriel.</h2>");

$requete = "SELECT * FROM membres WHERE courriel=? and idMembre NOT IN ($idMembre);";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

	if($ligne = $result->fetch_object()){ //si courriel existe deja afficher une erreur
        mysqli_close($connexion);
        header("Location:../pages/membre.php?id=$idMembre&msg=Le+courriel+$email+est+déjà+utilisé.+Choisissez+un+autre+courriel.");
    }


	$requette="UPDATE membres SET prenom=?,nom=?,courriel=?,sexe=?,dateDeNaissance=? WHERE idMembre=?";
	$stmt = $connexion->prepare($requette);
	$stmt->bind_param("sssssi",$prenom,$nom,$email,$sexe,$dateNaissance,$idMembre);
	$stmt->execute();

    $requette="UPDATE connexion SET courriel=?,motDePasse=? WHERE idMembre=?";
	$stmt = $connexion->prepare($requette);
	$stmt->bind_param("ssi",$email,$password,$idMembre);
	$stmt->execute();

	mysqli_close($connexion);
	header("Location:../pages/membre.php?id=$idMembre&msg=profil+à+jour!");
?>