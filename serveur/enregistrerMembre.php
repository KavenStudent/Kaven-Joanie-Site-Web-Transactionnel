<?php
    require_once("../BD/connexion.inc.php");

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

try {
    // regarde si le courriel n'est pas utilisé
    $requete = "SELECT * FROM membres WHERE courriel=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($ligne = $result->fetch_object()){ //si courriel existe deja afficher une erreur
        mysqli_close($connexion);
        header("Location:../index.php?msg=Le+courriel+$email+est+déjà+utilisé.+Choisissez+un+autre+courriel.");
    }

      // enregistrer info du membre
      $requete = "INSERT INTO membres VALUES(0,?,?,?,?,?)";
      $stmt = $connexion->prepare($requete);
      $stmt->bind_param("sssss", $prenom, $nom, $email, $sexe, $dateNaissance);
      $stmt->execute();
  
      // enregistrer info de connexion du membre
      $requete = "INSERT INTO connexion VALUES(0,?,?,'1','M')";
      $stmt = $connexion->prepare($requete);
      $stmt->bind_param("ss", $email, $password);
      $stmt->execute();
      
      // si reussi connexion du nouveau membre
      $id = $connexion->insert_id;
      session_start();
      $_SESSION['membre'] = $id;
      header("Location:../pages/membre.php?id=$id&msg=Bienvenue");
      
} catch (Exception $e) {
    echo "Problème avec la base de donnée";
} finally {
    mysqli_close($connexion);
}
    
?>
