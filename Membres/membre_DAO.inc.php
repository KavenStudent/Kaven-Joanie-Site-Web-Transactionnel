<?php
class Membre {
    private $idMembre;
    private $prenom;
    private $nom;
    private $courriel;
    private $sexe;
    private $dateDeNaisssance;
    private $motDePasse;
    private $statue;

    public function __construct(int $idMembre, string $prenom , string $nom, string $courriel, string $sexe, string $dateDeNaisssance, string $motDePasse, int $statue) 
    { 
        $this->idMembre = $idMembre; 
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->courriel = $courriel;
        $this->sexe = $sexe;
        $this->dateDeNaisssance = $dateDeNaisssance; 
        $this->motDePasse = $motDePasse;
        $this->statue = $statue;
    } 
    
    public function getIdMembre():int
    {
        return $this->idMembre;
    }

    public function getPrenom():string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function getNom():string
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getCourriel():string
    {
        return $this->courriel;
    }
    public function setCourriel(string $courriel)
    {
        $this->courriel = $courriel;
    }

    public function getSexe():string
    {
        return $this->sexe;
    }
    public function setSexe(string $sexe)
    {
        $this->sexe = $sexe;
    }

    public function getDateDeNaisssance():string
    {
        return $this->dateDeNaisssance;
    }
    public function setDateDeNaisssance(string $dateDeNaisssance)
    {
        $this->dateDeNaisssance = $dateDeNaisssance;
    }
    public function getMotdePasse():string
    {
        return $this->motDePasse;
    }
    public function setMotdePasse(string $motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }
    public function getStatue():string
    {
        return $this->statue;
    }
    public function setStatue(string $statue)
    {
        $this->statue = $statue;
    }
}

interface MembreDao  
{ 
    public function getAllMembre():array; 
    public function enregistrerMembre(Membre $Membre);
    public function verifiCourriel(string $courriel):bool;
    public function verifiCourrielModifier(string $courriel, int $idMembre):bool;
    public function modifierMembre(Membre $Membre);
    public function connecter(string $courriel, string $motDePasse):string;
    // public function getMembre(int $idMembre):int; 
    // public function updateMembre(Membre $Membre); 
    // public function deleteMembre(int $idMembre); 
}

class MembreDaoImp extends Modele implements MembreDao {

    public function getAllMembre():array
    {
        $tab = array();
        $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre";
        $this->setRequete($requete);
        $this->setParams(array());
        $stmt = $this->executer();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
           $tab[] = $ligne;
        }
        return $tab;
    }
    public function enregistrerMembre(Membre $Membre)
    {
        // enregistre dans membre
        $requete = "INSERT INTO membres VALUES(0,?,?,?,?,?)";
        $this->setRequete($requete);
        $this->setParams(array($Membre->getPrenom(), $Membre->getNom(), $Membre->getCourriel(), $Membre->getSexe(), $Membre->getDateDeNaisssance()));
        $stmt = $this->executer();

        // enregistre dans connexion
        $requete = "INSERT INTO connexion VALUES(0,?,?,'1','M')";
        $this->setRequete($requete);
        $this->setParams(array($Membre->getCourriel(), $Membre->getMotdePasse()));
        $stmt = $this->executer();
    }
    public function verifiCourriel(string $courriel): bool
    {
        $existe = false;
        $requete = "SELECT * FROM membres WHERE courriel=?";
        $this->setRequete($requete);
        $this->setParams(array($courriel));
        $stmt = $this->executer();
        if ($stmt->fetch(PDO::FETCH_OBJ)) {
            $existe = true;
        }
        return $existe;
    }
    public function verifiCourrielModifier(string $courriel, int $idMembre):bool
    {
        $existe = false;
        $requete = "SELECT * FROM membres WHERE courriel=? and idMembre NOT IN ($idMembre)";
        $this->setRequete($requete);
        $this->setParams(array($courriel));
        $stmt = $this->executer();
        if ($stmt->fetch(PDO::FETCH_OBJ)) {
            $existe = true;
        }
        return $existe;
    }
    public function modifierMembre(Membre $Membre)
    {
        // modifie dans membre
        $requete = "UPDATE membres SET prenom=?,nom=?,courriel=?,sexe=?,dateDeNaissance=? WHERE idMembre=?";
        $this->setRequete($requete);
        $this->setParams(array($Membre->getPrenom(), $Membre->getNom(), $Membre->getCourriel(), $Membre->getSexe(), $Membre->getDateDeNaisssance(), $Membre->getIdMembre()));
        $stmt = $this->executer();

        // modifie dans connexion
        $requete = "UPDATE connexion SET courriel=?,motDePasse=? WHERE idMembre=?";
        $this->setRequete($requete);
        $this->setParams(array($Membre->getCourriel(),$Membre->getMotdePasse(),$Membre->getIdMembre()));
        $stmt = $this->executer();
    }
    public function connecter(string $courriel, string $motDePasse): string
    {
        $msgErreur = "";
        $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        $this->setRequete($requete);
        $this->setParams(array($courriel,$motDePasse));
        $stmt = $this->executer();

        if ($membre = $stmt->fetch(PDO::FETCH_OBJ)) {
            if($membre->statut == 1){

                if($membre->role === "M"){
                    $_SESSION['membre'] = $membre->idMembre;
                }
                else{
                    $_SESSION['admin'] = $membre->idMembre;
                }
            }
            else{
                $msgErreur = "Compte inactif. Contacter un employé";
            }
        }
        else{
             $msgErreur = "Erreur de connexion. Vérifiez vos paramètes de connexion";
        }
        return $msgErreur;
    }
    // public function getMembre(int $idMembre):int
    // {

    // }
    // public function updateMembre(Membre $Membre)
    // {
    //     $this->nom = $Membre->nom;
    // }
    // public function deleteMembre(int $idMembre)
    // {

    //}
}
