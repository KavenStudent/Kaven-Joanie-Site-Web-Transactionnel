<?php
session_start();
require_once("../BD/connexion.inc.php");
$email = $_POST['email'];
$password = $_POST['password'];
$isValid = false;

try {

  $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
  $stmt = $connexion->prepare($requete);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($ligne = $result->fetch_object()) { // regarde si le compte existe
    $id = ($ligne->idMembre);

    if ($ligne->statut) { // regarde si le compte est valide


        if ($ligne->role === 'M') { // regarde le role
          $_SESSION['membre'] = $id;
          header("Location:../pages/membre.php?id=$id&msg=Bienvenue");
          
        } else {
          $_SESSION['admin'] = $id;
          header("Location:../pages/admin.php?msg=Admin+connecté");
     
        }

    } else { // si le compte est inactif
      header("Location:../index.php?msg=Compte+inactif.+Contacter+un+employé");
   
    }

  } else { // si erreur de connexion
    header("Location:../index.php?msg=Erreur+de+connexion.+Vérifiez+vos+paramètes+de+connexion");
 
  }

} catch (Exception $e) {
  echo "Problème avec la base de donnée";
} finally {
  mysqli_close($connexion);
}

?>