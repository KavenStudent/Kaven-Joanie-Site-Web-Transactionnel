
<?php
  define("FMEMBRE", "./donnees/membre.txt");
  define("FCONNEXION", "./donnees/connexion.txt");
  
    if(!$f_membre = fopen(FMEMBRE,"a+")) {
        echo "Probleme pour ouvrir le fichier";
        exit;
    }

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    $actif = true;
    $role = "M";  //A,M,E Admin, membre, employe

    // ligne pour fichier membre
    $ligne = $prenom.";".$nom.";".$email.";".$sexe.$dateNaissance."\n";

    fputs($f_membre,$ligne); 

    fclose($f_membre);
 
    if(!$f_connexion = fopen(FCONNEXION,"a+")) {
      echo "Probleme pour ouvrir le fichier";
      exit;
  }
    // ligne pour fichier connexion
    $ligne = $email.";".$password.";".$actif.";".$role."\n";

    fputs($f_connexion,$ligne); 

    fclose($f_connexion);


   // echo "Vous êtes enregistré ".$numf." bien enregiste";
?>

</br>
</br>
<a href="../index.html">Retour a la page d'accueil </a>