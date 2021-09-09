<?php
  define("FCONNEXION", "../donnees/connexion.txt");
  define("MSG_ERREUR", "Problème pour ouvrir le fichier");
  define("MSG_ERREUR_CONNEXION", "Erreur de connexion");
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
      $statut = $unMembre[3];
      $isValid = true;
      break;
    }

    $ligne=fgets($fic);
  }

  fclose($fic);

  if($isValid == true){

  if($statut === "A"){
   echo "<script> location.href='./admin.php'; </script>";
  }

  if($statut === "M"){
  echo "<script> location.href='./membre.php'; </script>";
  }
  
  exit;
  
  }else{
      echo MSG_ERREUR_CONNEXION;
  }
?>

</br>
</br>
<a href="../../index.html">Retour a la page d'accueil</a>