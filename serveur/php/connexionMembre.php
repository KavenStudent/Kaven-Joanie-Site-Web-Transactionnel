<?php
  require_once("../util/fichier-params.inc.php");
  define("MSG_ERREUR", "Problème pour ouvrir le fichier");
  define("MSG_ERREUR_CONNEXION", "<h1>Erreur de connexion</h1>");
  define("MSG_ERREUR_INACTIF", "<h1>Compte inactif. Contacter un employé</h1>");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $isValid = false;
  
  // lire fichier
  if(!$fic = fopen(FCONNEXION,"r")) {
    echo MSG_ERREUR;
    exit;
  }

  $ligne=fgets($fic);

  while (!feof($fic)){
    $unMembre = explode(";", $ligne);

    if($unMembre[0] === $email && $unMembre[1] === $password){
      $isActif = $unMembre[2];
      $statut = $unMembre[3];
      $isValid = true;
      break;
    }

    $ligne=fgets($fic);
  }

  fclose($fic);

  if($isValid == true){
    if($isActif == true){
      switch (trim($statut)) {
        case 'A':
          header("Location: ./admin.php");
          break;
        case 'E':
          header("Location: ./employe.php");
          break;
        default:
        header("Location: ./membre.php");
          break;
      }
    }else{
      echo MSG_ERREUR_INACTIF;
    }

  exit;

  }else{
      echo MSG_ERREUR_CONNEXION;
  }
?>

</br>
</br>
<a href="../../index.html">Retour a la page d'accueil</a>