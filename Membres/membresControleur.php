<?php
session_start();
require_once("../includes/modeles.inc.php");
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
        // regarde si le courriel n'est pas utilisé
        $requete = "SELECT * FROM membres WHERE courriel=?";
        $unModele = new Modele($requete, array($email));
        $stmt = $unModele->executer();

        // couriel deja utilisé existant
        if ($stmt->fetch(PDO::FETCH_OBJ)) {

            $tabRes['action'] = "enregistrerMembre";
            $tabRes['msg'] = "Le courriel $email est déjà utilisé. Choisissez un autre courriel.";
        } else {

            // enregistre dans membre
            $requete = "INSERT INTO membres VALUES(0,?,?,?,?,?)";
            $unModele = new Modele($requete, array($prenom, $nom, $email, $sexe, $dateNaissance));
            $stmt = $unModele->executer();

            // enregistre dans connexion
            $requete = "INSERT INTO connexion VALUES(0,?,?,'1','M')";
            $unModele = new Modele($requete, array($email, $password));
            $stmt = $unModele->executer();

            $idMembre = $unModele->getLastId();
            $_SESSION['membre'] = $idMembre;
            // 
            // listerFilm();

            // a connecter apres
            // $tabRes['action'] = "enregistrerMembre";
            $tabRes['idMembre'] = $idMembre;
            // $tabRes['msg'] = "Membre bien enregistre";
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
    $isValid = false;

    try {
        $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        $unModele = new Modele($requete, array($email, $password));
        $stmt = $unModele->executer();
        $tabRes['action'] = "connexion";
        if ($usager = $stmt->fetch()) {
            $id = $usager['idMembre'];
            // $tabRes['idMembre'] = $id;

            // $tabRes['usager'] = $usager;

            if ($usager['statut']) { // regarde si le compte est valide
                $tabRes['idMembre'] = $usager['idMembre'];

                if ($usager['role'] === 'M') { // regarde le role
                    $_SESSION['membre'] = $id;
                    // $tabRes['msg'] = "M";
                    // header("Location:../index.php");
                    // exit;
                } else {
                    $_SESSION['admin'] = $id;
                    // $tabRes['msg'] = "A";
                    // header("Location:../index.php");
                    // exit;
                }
            } else { // si le compte est inactif
                // header("Location:../index.php?msg=Compte+inactif.+Contacter+un+employé");
                $tabRes['msg'] = "Compte inactif. Contacter un employé";
            }
        } else { // si erreur de connexion
            $tabRes['msg'] = "Erreur de connexion. Vérifiez vos paramètes de connexion";
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function deconnexion()
{
    // global $tabRes;

    session_unset();
    session_destroy();
    // header("Location:../index.php");
    // exit;
}

function listerFilm()
{
    global $tabRes;

    try {

        $requete = "SELECT * FROM films ORDER BY `films`.`annee` DESC";
        $unModele = new Modele($requete, array());
        $stmt = $unModele->executer();
        $tabRes['listeFilms'] = array();

        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeFilms'][] = $ligne;
        }
    } catch (Exception $e) {
    } finally {
        unset($unModele);
    }
}

function tableMembres()
{
    global $tabRes;
    try {

        $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre";
        $unModele = new Modele($requete, array());
        $stmt = $unModele->executer();
        $tabRes['action'] = "tableMembres";
        $tabRes['listeMembres'] = array();

        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tabRes['listeMembres'][] = $ligne;
        }
    } catch (Exception $e) {
    } finally {
        // unset($unModele);
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

//Controller
$action = $_POST['action'];
switch ($action) {
    case "enregistrerMembre":
        enregistrerMembre();
        break;
    case "connexion":
        connexion();
        break;
    case "deconnexion":
        deconnexion();
        break;
    case "payerPanier":
        // enleverFilm();
        break;
    case "fiche":
        fiche();
        break;
    case "modifierProfil":
        modifierFilm();
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
        
}
echo json_encode($tabRes);
