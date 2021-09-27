<?php
    require_once("../BD/connexion.inc.php");
    
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    define("MSG_BIENVENUE", "<h2>Bienvenue ".$prenom." ".$nom."</h2>");
    define("MSG_EXISTE_DEJA", "<h2>Le courriel : ".$email." est déjà utilisé. Choisissez un autre courriel.</h2>");

    // regarde si le courriel n'est pas utilisé
    $requete = "SELECT * FROM membres WHERE courriel=?";
    $stmt = $connexion->prepare($requete);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($ligne = $result->fetch_object()){ //si courriel existe deja afficher une erreur
        echo MSG_EXISTE_DEJA;
        mysqli_close($connexion);
        exit;
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
  
      echo MSG_BIENVENUE;
?>

</br>
</br>
<a href="../index.html">Retour à la page d'accueil</a>