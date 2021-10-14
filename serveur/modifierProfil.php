<?php
require_once("../BD/connexion.inc.php");
$idMembre = $_POST['idMembre'];
$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['email'];
$password = $_POST['password'];
$sexe = $_POST['sexe'];
$dateNaissance = $_POST['dateNaissance'];

    
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