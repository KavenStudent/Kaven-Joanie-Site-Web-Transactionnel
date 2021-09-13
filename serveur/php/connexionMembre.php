<?php
  define("FCONNEXION", "../donnees/connexion.txt");
  define("MSG_ERREUR", "Problème pour ouvrir le fichier");
  define("MSG_ERREUR_CONNEXION", "Erreur de connexion");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $isValid = false;
  $statut;
  // lire fichier
  if(!$fic = fopen(FCONNEXION,"r")) {
    echo MSG_ERREUR;
    exit;
  }

  $ligne=fgets($fic);

  while (!feof($fic)){
    $unMembre = explode(";", $ligne);

    if($unMembre[0] === $email && $unMembre[1] === $password){
      $statut = $unMembre[3];
      $isValid = true;
      break;
    }

    $ligne=fgets($fic);
  }

  fclose($fic);

  if($isValid == true){
    // if pas valide doit pas rediriger
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

  
  exit;

  }else{
      echo MSG_ERREUR_CONNEXION;
  }
?>

</br>
</br>
<a href="../../index.html">Retour a la page d'accueil</a>