<?php
require_once("../includes/modeles.inc.php");
$tabRes=array();

function enregistrerMembre(){
    global $tabRes;	
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    try{
        // regarde si le courriel n'est pas utilisé
        $requete = "SELECT * FROM membres WHERE courriel=?";
        $unModele=new Modele($requete,array($email));
        $stmt=$unModele->executer();

        // couriel deja utilisé existant
        if($stmt->fetch(PDO::FETCH_OBJ)){

            $tabRes['action']="enregistrerMembre";
            $tabRes['msg']="Le courriel $email est déjà+utilisé. Choisissez un autre courriel.";

        } else {

            // enregistre dans membre
            $requete = "INSERT INTO membres VALUES(0,?,?,?,?,?)";
            $unModele=new Modele($requete,array($prenom, $nom, $email, $sexe, $dateNaissance));
            $stmt=$unModele->executer();

            // enregistre dans connexion
            $requete = "INSERT INTO connexion VALUES(0,?,?,'1','M')";
            $unModele=new Modele($requete,array($email, $password));
            $stmt=$unModele->executer();

            $idMembre = $unModele->getLastId();

            // 
            listerFilm();

            // a connecter apres
            $tabRes['action']="enregistrerMembre";
            $tabRes['idMembre'] = $idMembre;
            $tabRes['msg']="Membre bien enregistre";
        }
           
        
    }catch(Exception $e){
    }finally{
        unset($unModele);
    }
}

function connexion(){
    global $tabRes;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $isValid = false;

    try{
        $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        $unModele=new Modele($requete,array($email, $password));
        $stmt=$unModele->executer();
        $tabRes['listeFilms']=array();
        while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
           $tabRes['listeFilms'][]=$ligne;
       }
   }catch(Exception $e){
   }finally{
       unset($unModele);
   }

}

function listerFilm(){
    global $tabRes;

    try{
        $requete= "SELECT * FROM films ORDER BY `films`.`annee` DESC";
         $unModele=new Modele($requete,array());
         $stmt=$unModele->executer();
         $tabRes['listeFilms']=array();
         while($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
            $tabRes['listeFilms'][]=$ligne;
        }
    }catch(Exception $e){
    }finally{
        unset($unModele);
    }
}

//Controller
$action=$_POST['action'];
switch($action){
    case "enregistrerMembre" :
        enregistrerMembre();
    break;
    case "connexion" :
        connexion();
    break;
    case "payerPanier" :
        enleverFilm();
    break;
    case "fiche" :
        fiche();
    break;
    case "modifierProfil" :
        modifierFilm();
    break;
}
echo json_encode($tabRes);
