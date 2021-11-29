<?php
session_start();
require_once("../includes/modele.inc.php");
require_once("membre_DAO.inc.php");
$tabRes = array();

//Enregistre un membre
function enregistrerMembre()
{
    global $tabRes;
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    try {
        $unMembre = new Membre(0, $prenom, $nom, $courriel, $sexe, $dateNaissance, $password, 1);
        $dao = new MembreDaoImp();
        // couriel deja utilisé existant
        if ($dao->verifiCourriel($courriel)) {

            $tabRes['action'] = "enregistrerMembre";
            $tabRes['msg'] = "Le courriel $courriel est déjà utilisé. Choisissez un autre courriel.";
        } else {
            //enregistre le membre
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
//modifie un membre
function modifierProfil()
{
    global $tabRes;
    $idMembre = $_POST['idMembre'];
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $courriel = $_POST['email'];
    $password = $_POST['password'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];

    try {
        $unMembre = new Membre($idMembre, $prenom, $nom, $courriel, $sexe, $dateNaissance, $password, 1);
        $dao = new MembreDaoImp();

        // couriel deja utilisé existant
        if ($dao->verifiCourrielModifier($courriel, $idMembre)) {

            $tabRes['action'] = "modifierProfil";
            $tabRes['msg'] = "Le courriel $courriel est déjà utilisé. Choisissez un autre courriel.";
        } else {
            //modifie le membre
            $dao->modifierMembre($unMembre);
            $tabRes['msg'] = "Profil à jour";
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
//Connexion d'un membre
function connexion()
{
    global $tabRes;
    $courriel = $_POST['email'];
    $password = $_POST['password'];

    try {
        
        $tabRes['action'] = "connexion";
        $dao = new MembreDaoImp();
        //Connecter le membre
        $tabRes['msg'] = $dao->connecter($courriel, $password);

    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
//deconnexion d'un membre
function deconnexion()
{
    session_unset();
    session_destroy();
}
//table de tous les membre
function tableMembres()
{
    global $tabRes;
    $par = $_POST['par'];
	$valeurPar = strtolower(trim($_POST['valeurPar']));
    try {
        $tabRes['action'] = "tableMembres";
        $dao = new MembreDaoImp();
        //retourne tout les membre
        $tabRes['listeMembres'] = $dao->getAllMembreRecherche($par, $valeurPar);
    } catch (Exception $e) {
    } finally {
    }
}
//Activation d'un membre
function activerMembre()
{

    global $tabRes;
    $idMembre = $_POST['idMembre'];
    $statut = 1;

    try {
        $tabRes['action'] = "activerMembre";

        if ($idMembre == 1) { // si admin
            $tabRes['msg'] = "Impossible de modifier l'administrateur";
        } else { // si membre
            $dao = new MembreDaoImp();
            //change son statut en actif
            $dao->changerStatutMembre($statut, $idMembre);
          
            $tabRes['action'] = "tableMembres";
            $tabRes['listeMembres'] = $dao->getAllMembre();
            
            $tabRes['msg'] = "Le membre $idMembre a été réactivé";
        }
    } catch (Exception $e) {
        echo "Problème avec la base de donnée";
    } finally {
        unset($unModele);
    }
}

//Desactiver un membre
function desactiverMembre()
{

    global $tabRes;
    $idMembre = $_POST['idMembre'];
    $statut = 0;

    try {
        $tabRes['action'] = "desactiverMembre";

        if ($idMembre == 1) { // si admin
            $tabRes['msg'] = "Impossible de modifier l'administrateur";
        } else { // si membre
            $dao = new MembreDaoImp();
            //change son statut en desactiver
            $dao->changerStatutMembre($statut, $idMembre);
            
            $tabRes['action'] = "tableMembres";
            $tabRes['listeMembres'] = $dao->getAllMembre();

            $tabRes['msg'] = "Le membre $idMembre a été désactivé";
        }
    } catch (Exception $e) {
        echo "Problème avec la base de donnée";
    } finally {
        unset($unModele);
    }
}
//Table des historiques de locations
function tableHistoriquesLocation()
{
    global $tabRes;
    $idMembre = $_POST['idMembre'];

    try {
       
        $tabRes['action'] = "tableHistoriqueLocation";
        $dao = new MembreDaoImp();
        $tabRes['listeLocations'] = $dao->afficherHistoriqueMembre($idMembre);

    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
//Permet de compter combien de jour entre le debut et la fin
function NbJours($debut, $fin)
{

    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

    return (($diff / 86400));
}
//Table de locations
function tableLocations()
{
    global $tabRes;
    $idMembre = $_POST['idMembre'];

    try {
        
        $tabRes['action'] = "tableLocation";
        $dao = new MembreDaoImp();
        $tabRes['listeLocations'] = $dao->afficherLocationMembre($idMembre);

    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}
//Affiche le profil d'un membre
function profil()
{
    global $tabRes;
    $idMembre = $_POST['idMembre'];
    try {
      
        $tabRes['action'] = "profil";
        $dao = new MembreDaoImp();

        // convertissement du l'objet en array et en enleve le "Membre" dans chaque attribut 
        foreach ((array) $dao->getMembre($idMembre) as $k => $v) {
            $k = preg_match('/^\x00(?:.*?)\x00(.+)/', $k, $matches) ? $matches[1] : $k;
            $unMembre[$k] = $v;
        }
        $tabRes['afficherProfil'] = $unMembre;

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
