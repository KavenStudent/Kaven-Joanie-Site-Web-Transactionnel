
<?php
    define("FMEMBRE", "../donnees/membre.txt");
    define("FCONNEXION", "../donnees/connexion.txt");
    define("MSG_ERREUR", "Problème pour ouvrir le fichier");
    
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    define("MSG_BIENVENUE", "Bienvenue ".$prenom." ".$nom);
    define("MSG_EXISTE_DEJA", "Le courriel ".$email." est déjà utilisé. Choisissez un autre courriel.");
    $actif = true;
    $role = "M";  //A,M,E Admin, membre, employe
    $existant = false;

    // ouvrir fichier membre.txt
    if(!$fic = fopen(FMEMBRE,"r")) {
      echo MSG_ERREUR;
      exit;
    }

    $ligne=fgets($fic);

    while (!feof($fic)){
      $unMembre = explode(";", $ligne);

      if($unMembre[2] === $email){
        $existant = true;
        break;
      }

      $ligne=fgets($fic);
    }

    fclose($fic);

   if($existant == true){

   echo MSG_EXISTE_DEJA;

   } else {

  // ouvrir fichier membre.txt
    try {
      $f_membre = fopen(FMEMBRE,"a+");
      $ligne = $prenom.";".$nom.";".$email.";".$sexe.$dateNaissance."\n";
      fputs($f_membre,$ligne);  
      fclose($f_membre);
    } catch (Exeption $e) {
      echo MSG_ERREUR;
    }

    // ouvrir fichier connexion.txt
    try {
      $f_connexion = fopen(FCONNEXION,"a+");
      $ligne = $email.";".$password.";".$actif.";".$role."\n";
      fputs($f_connexion,$ligne); 
      fclose($f_connexion);
    } catch (Exeption $e) {
      echo MSG_ERREUR;
    }

    echo MSG_BIENVENUE;

   }
 
?>

</br>
</br>
<a href="../../index.html">Retour a la page d'accueil</a>