<?php
 require_once("../util/fichier-params.inc.php");
 $prenom = $_POST['prenom'];
 $nom = $_POST['nom'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $sexe = $_POST['sexe'];
 $dateNaissance = $_POST['dateNaissance'];

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

}
    fclose($fic);

    // function infoConnexion(email){

    // }

?>
<table class="table table-striped">
<thead>
    <tr>
      <th scope="col">Prenom</th>
      <th scope="col">Nom</th>
      <th scope="col">Courriel</th>
      <th scope="col">Statut</th>
      <th scope="col">Rôle</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>