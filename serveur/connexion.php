<?php
  session_start();
  require_once("../BD/connexion.inc.php");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $isValid = false;

  $requete="SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
  $stmt = $connexion->prepare($requete);
  $stmt->bind_param("ss", $email, $password);
  $stmt->execute();
  $result = $stmt->get_result();

  if($ligne = $result->fetch_object()){ // regarde si le compte existe
    $id = ($ligne->idMembre);
    if($ligne->statut){ // regarde si le compte est valide

     

      if ($ligne->role === 'M'){// regarde le role
        $_SESSION['membre'] = $id;
        header("Location:../pages/membre.php?id=$id&msg=Bienvenue");
        mysqli_close($connexion);
        exit;

      } else{
        $_SESSION['admin'] = $id;
        header("Location:../pages/admin.php?msg=Admin+connecté");
        mysqli_close($connexion);
        exit;
      }

    } else{ // si le compte est inactif
      header("Location:../index.php?msg=Compte+inactif.+Contacter+un+employé");
      mysqli_close($connexion);
      exit;
    }
      

    } else { // si erreur de connexion
        header("Location:../index.php?msg=Erreur+de+connexion.+Vérifiez+vos+paramètes+de+connexion");
        mysqli_close($connexion);
        exit;
    }
?>