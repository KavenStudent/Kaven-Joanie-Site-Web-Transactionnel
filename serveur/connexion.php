<?php
  require_once("../BD/connexion.inc.php");
  define("MSG_ERREUR_CONNEXION", "<p style='color:red; font-size: 14px;'><b>Erreur de connexion. Vérifiez vos paramètes de connexion.</b></p>");
  define("MSG_ERREUR_INACTIF", "<p style='color:red; font-size: 14px;'><b>Compte inactif. Contacter un employé</b></p>");
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
        header("Location:../pages/membre.php?id=$id&msg=Bienvenue");
      } else{

        header("Location:../pages/admin.php?id=$id&msg=Admin+connecté");

      }

    } else{
      header("Location:../index.php?id=$id&msg=Compte+inactif+.+Contacter+un+employé");
      mysqli_close($connexion);
      exit;
    }
      

    } else {
        header("Location:../index.php?id=$id&msg=Erreur+de+connexion+.+Vérifiez+vos+paramètes+de+connexion");
        mysqli_close($connexion);
        exit;
    }
?>
<!-- 
</br>
</br>
<a href="../index.html">Retour a la page d'accueil</a> -->