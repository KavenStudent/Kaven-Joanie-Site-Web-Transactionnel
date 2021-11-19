<?php
session_start();
require_once("../includes/modeles.inc.php");
require_once("membre_DAO.inc.php");
$tabRes = array();

function enregistrerMembre()
{
    global $tabRes;
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    try {
        $unMembre = new Membre(0,$prenom,$nom,$email,$sexe,$dateNaissance,$password,1);
        $dao = new MembreDaoImp();
        // couriel deja utilisé existant
        if ($dao->verifiCourriel($email)) {

            $tabRes['action'] = "enregistrerMembre";
            $tabRes['msg'] = "Le courriel $email est déjà utilisé. Choisissez un autre courriel.";
        } else {

            $dao->enregistrerMembre($unMembre);
            $idMembre = $dao->getLastId();
            $_SESSION['membre'] = $idMembre;
            $tabRes['idMembre'] = $idMembre;
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function modifierProfil()
{
    global $tabRes;
    $idMembre =$_POST['idMembre'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];
    
    try {
        $unMembre = new Membre($idMembre,$prenom,$nom,$email,$sexe,$dateNaissance,$password,1);
        $dao = new MembreDaoImp();
        
        // couriel deja utilisé existant
        if ($dao->verifiCourrielModifier($email,$idMembre)) {

            $tabRes['action'] = "modifierProfil";
            $tabRes['msg'] = "Le courriel $email est déjà utilisé. Choisissez un autre courriel.";
            
        } else {

            $dao->modifierMembre($unMembre);
            $tabRes['msg'] = "Profil à jour";
            
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function connexion()
{
    global $tabRes;
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        // $unModele = new Modele($requete, array($email, $password));
        // $stmt = $unModele->executer();
        $tabRes['action'] = "connexion";
        $dao = new MembreDaoImp();
        $tabRes['msg'] = $dao->connecter($email,$password);
        

        // si usager existant dans la bd
        // if ($usager = $stmt->fetch()) {
        //     $id = $usager['idMembre'];
         
        //     if ($usager['statut']) { // regarde si le compte est valide
        //         $tabRes['idMembre'] = $usager['idMembre'];

        //         if ($usager['role'] === 'M') { // regarde le role
        //             $_SESSION['membre'] = $id;
              
        //         } else {
        //             $_SESSION['admin'] = $id;
                 
        //         }

        //     } else { // si le compte est inactif
               
        //         $tabRes['msg'] = "Compte inactif. Contacter un employé";
        //     }

        // } else { // si erreur de connexion ou usager inexistant
        //     $tabRes['msg'] = "Erreur de connexion. Vérifiez vos paramètes de connexion";
        // }

    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function deconnexion()
{
    session_unset();
    session_destroy();
 
}

function tableMembres()
{
    global $tabRes;
    try {

        $tabRes['action'] = "tableMembres";
        $dao = new MembreDaoImp();
        $tabRes['listeMembres'] = $dao->getAllMembre();
    } catch (Exception $e) {
    } finally {

    }
}

function activerMembre()
{

    global $tabRes;
    $idMembre = $_POST['idMembre'];
    $statut = 1;

    try {
        $tabRes['action'] = "activerMembre";

        if ($idMembre == 1) { // si admin
            $tabRes['msg'] = "Impossible de modifier l'administrateur";       
    
        } else {

            $requete = "UPDATE connexion SET statut=? WHERE idMembre=?";
            $unModele = new Modele($requete, array($statut, $idMembre));
            $stmt = $unModele->executer();
            
            $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre";
            $unModele = new Modele($requete, array());
            $stmt = $unModele->executer();
            $tabRes['action'] = "tableMembres";
            $tabRes['listeMembres'] = array();
       
            while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
                $tabRes['listeMembres'][] = $ligne;
            }
    
            $tabRes['msg'] = "Le membre $idMembre a été réactivé";         
        }

    } catch (Exception $e) {
        echo "Problème avec la base de donnée";
    } finally {
        unset($unModele);
    }
}

function desactiverMembre()
{

    global $tabRes;
    $idMembre = $_POST['idMembre'];
    $statut = 0;

    try {
        $tabRes['action'] = "desactiverMembre";

        if ($idMembre == 1) { // si admin
            $tabRes['msg'] = "Impossible de modifier l'administrateur";         
        } else {

            $requete = "UPDATE connexion SET statut=? WHERE idMembre=?";
            $unModele = new Modele($requete, array($statut, $idMembre));
            $stmt = $unModele->executer();
    
            $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre";
            $unModele = new Modele($requete, array());
            $stmt = $unModele->executer();
            $tabRes['action'] = "tableMembres";
            $tabRes['listeMembres'] = array();
    
            while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
                $tabRes['listeMembres'][] = $ligne;
            }
    
            $tabRes['msg'] = "Le membre $idMembre a été désactivé";         
        }

    } catch (Exception $e) {
        echo "Problème avec la base de donnée";
    } finally {
        unset($unModele);
    }
}

function tableHistoriquesLocation(){
    global $tabRes;
    $idMembre = $_POST['idMembre'];
    //$idMembre = 3;
    
    try {
        $requete = "SELECT h.idMembre, f.idFilm, f.titre, h.dateAchat, f.image FROM historiquelocation h INNER JOIN films f ON h.idFilm = f.idFilm WHERE h.idMembre = ? ORDER by h.dateAchat DESC";
        $unModele = new Modele($requete, array($idMembre));
        $stmt = $unModele->executer();
        $tabRes['action'] = "tableHistoriqueLocation";
        $tabRes['listeLocations'] = array();

        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeLocations'][] = $ligne;
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function NbJours($debut, $fin)
{

    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

    return (($diff / 86400));
}

function tableLocations(){
    global $tabRes;
    $idMembre = $_POST['idMembre'];
    
    try {
        $requete = "SELECT f.idFilm, f.titre ,l.dateAchat, l.dureeLocation, f.image FROM location l INNER JOIN films f ON l.idFilm = f.idFilm WHERE l.idMembre = ? ORDER by l.dateAchat DESC ";
        $unModele = new Modele($requete, array($idMembre));
        $stmt = $unModele->executer();
        $tabRes['action'] = "tableLocation";
        $tabRes['listeLocations'] = array();

        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            //Variable
            $dateAujourd = date("Y-m-d");
            $dateFin= date("Y-m-d", strtotime($ligne->dateAchat . "+ $ligne->dureeLocation days"));
            //Ajouter colones
            $ligne->dateFin = $dateFin;
            $ligne->nbJourRestant = round(NbJours($dateAujourd, $dateFin));
            //si la location n'est plus a louable il supprime de location et ajoute dans son historique
            if ($ligne->nbJourRestant < 0) {

                $idFilm = $ligne->idFilm;
                $requete1 = "DELETE FROM location WHERE idFilm=?";
                $unModele = new Modele($requete1, array($idFilm));
                $stmt = $unModele->executer();
    
                $requete1 = "INSERT INTO historiquelocation VALUES(?,?,?)";
                $unModele = new Modele($requete1, array($idFilm,$idMembre,$ligne->dateAchat));
                $stmt = $unModele->executer();
            }
            else{
                $tabRes['listeLocations'][] = $ligne;
            }
            
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
function profil(){
    global $tabRes;
    $idMembre = $_POST['idMembre']; 
    try {
        $requete = $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.motDePasse, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre WHERE m.idMembre = ?";
        $unModele = new Modele($requete, array($idMembre));
        $stmt = $unModele->executer();
        
        $tabRes['action'] = "profil";
        // $tabRes['afficherProfil'] = array();

        if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
            $tabRes['afficherProfil'] = $ligne;
            // $tabRes['OK']=true;
        }
        // else{
        //     $tabRes['OK']=false;
        // }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

//Controller
$action = $_POST['action'];
switch ($action) {
    case "enregistrerMembre":
        enregistrerMembre();
        break;
    case "modifierProfil":
        modifierProfil();
        break;
    case "connexion":
        connexion();
        break;
    case "deconnexion":
        deconnexion();
        break;
    case "tableMembres":
        tableMembres();
        break;
    case "activerMembre":
        activerMembre();
        break;
    case "desactiverMembre":
        desactiverMembre();
        break;
    case "tableHistoriqueLocation":
        tableHistoriquesLocation();
        break;
    case "profil":
        profil();
        break;
    case "tableLocation":
        tableLocations();
        break;

}
echo json_encode($tabRes);
