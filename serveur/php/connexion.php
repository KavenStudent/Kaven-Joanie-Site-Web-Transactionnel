<?php
  define("FCONNEXION", "../donnees/connexion.txt");
  define("MSG_ERREUR", "Problème pour ouvrir le fichier");
  define("MSG_CONNEXION", "Vous êtes bien connecté");
  define("MSG_ERREUR_CONNEXION", "Erreur de connexion");
  $email = $_POST['email'];
  $password = $_POST['password'];
  $isValid = false;

  if(!$fic = fopen(FCONNEXION,"r")) {
    echo MSG_ERREUR;
    exit;
  }

  $ligne=fgets($fic);

  while (!feof($fic)){
    $unMembre = explode(";", $ligne);

    if($unMembre[0] === $email && $unMembre[1] === $password){
      $isValid = true;
      break;
    }

    $ligne=fgets($fic);
  }

  fclose($fic);

  if($isValid == true){
    echo MSG_CONNEXION;
  }else{
      echo MSG_ERREUR_CONNEXION;
  }
?>

</br>
</br>
<a href="../../index.html">Retour a la page d'accueil </a>