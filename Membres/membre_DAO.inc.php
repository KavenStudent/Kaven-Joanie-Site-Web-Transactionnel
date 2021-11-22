<?php
class Membre
{
    private $idMembre;
    private $prenom;
    private $nom;
    private $courriel;
    private $sexe;
    private $dateDeNaissance;
    private $motDePasse;
    private $statut;

    public function __construct(int $idMembre, string $prenom, string $nom, string $courriel, string $sexe, string $dateDeNaissance, string $motDePasse, int $statut)
    {
        $this->idMembre = $idMembre;
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->courriel = $courriel;
        $this->sexe = $sexe;
        $this->dateDeNaissance = $dateDeNaissance;
        $this->motDePasse = $motDePasse;
        $this->statut = $statut;
    }

    public function getIdMembre(): int
    {
        return $this->idMembre;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;
    }

    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getCourriel(): string
    {
        return $this->courriel;
    }
    public function setCourriel(string $courriel)
    {
        $this->courriel = $courriel;
    }

    public function getSexe(): string
    {
        return $this->sexe;
    }
    public function setSexe(string $sexe)
    {
        $this->sexe = $sexe;
    }

    public function getDateDeNaisssance(): string
    {
        return $this->dateDeNaissance;
    }
    public function setDateDeNaisssance(string $dateDeNaissance)
    {
        $this->dateDeNaissance = $dateDeNaissance;
    }
    public function getMotdePasse(): string
    {
        return $this->motDePasse;
    }
    public function setMotdePasse(string $motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }
    public function getStatue(): string
    {
        return $this->statut;
    }
    public function setStatue(string $statut)
    {
        $this->statut = $statut;
    }
}

interface MembreDao
{
    public function getAllMembre(): array;
    public function enregistrerMembre(Membre $Membre);
    public function verifiCourriel(string $courriel): bool;
    public function verifiCourrielModifier(string $courriel, int $idMembre): bool;
    public function modifierMembre(Membre $Membre);
    public function connecter(string $courriel, string $motDePasse): string;
    public function changerStatutMembre(int $statut, int $idMembre);
    public function afficherHistoriqueMembre(int $idMembre): array;
    public function afficherLocationMembre(int $idMembre): array;
    public function getMembre(int $idMembre):Membre;
}

class MembreDaoImp extends Modele implements MembreDao
{

    public function getAllMembre(): array
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
    public function verifiCourrielModifier(string $courriel, int $idMembre): bool
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
        $this->setParams(array($Membre->getCourriel(), $Membre->getMotdePasse(), $Membre->getIdMembre()));
        $stmt = $this->executer();
    }
    public function connecter(string $courriel, string $motDePasse): string
    {
        $msgErreur = "";
        $requete = "SELECT * FROM connexion WHERE courriel=? AND motDePasse=?";
        $this->setRequete($requete);
        $this->setParams(array($courriel, $motDePasse));
        $stmt = $this->executer();

        if ($membre = $stmt->fetch(PDO::FETCH_OBJ)) {
            if ($membre->statut == 1) {

                if ($membre->role === "M") {
                    $_SESSION['membre'] = $membre->idMembre;
                } else {
                    $_SESSION['admin'] = $membre->idMembre;
                }
            } else {
                $msgErreur = "Compte inactif. Contacter un employé";
            }
        } else {
            $msgErreur = "Erreur de connexion. Vérifiez vos paramètes de connexion";
        }
        return $msgErreur;
    }
    public function changerStatutMembre(int $statut, int $idMembre)
    {
        $requete = "UPDATE connexion SET statut=? WHERE idMembre=?";
        $this->setRequete($requete);
        $this->setParams(array($statut, $idMembre));
        $stmt = $this->executer();
    }

    public function afficherHistoriqueMembre(int $idMembre): array
    {
        $tab = array();
        $requete = "SELECT h.idMembre, f.idFilm, f.titre, h.dateAchat, f.image FROM historiquelocation h INNER JOIN films f ON h.idFilm = f.idFilm WHERE h.idMembre = ? ORDER by h.dateAchat DESC";
        $this->setRequete($requete);
        $this->setParams(array($idMembre));
        $stmt = $this->executer();
        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            $tab[] = $ligne;
        }
        return $tab;
    }
    
    public function afficherLocationMembre(int $idMembre): array
    {
        $tab = array();
        $requete = "SELECT f.idFilm, f.titre ,l.dateAchat, l.dureeLocation, f.image FROM location l INNER JOIN films f ON l.idFilm = f.idFilm WHERE l.idMembre = ? ORDER by l.dateAchat DESC ";
        $this->setRequete($requete);
        $this->setParams(array($idMembre));
        $stmt = $this->executer();

        while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
            //Variable
            $dateAujourd = date("Y-m-d");
            $dateFin = date("Y-m-d", strtotime($ligne->dateAchat . "+ $ligne->dureeLocation days"));
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
                $unModele = new Modele($requete1, array($idFilm, $idMembre, $ligne->dateAchat));
                $stmt = $unModele->executer();
            }else{
                $tab[] = $ligne;
            }
        }
        return $tab;
    }
    public function getMembre(int $idMembre):Membre{
        
        $requete = $requete = "SELECT m.idMembre, m.prenom, m.nom, m.courriel, m.sexe, m.dateDeNaissance, c.motDePasse, c.statut, c.role FROM membres m INNER JOIN connexion c ON m.idMembre = c.idMembre WHERE m.idMembre = ?";
        $this->setRequete($requete);
        $this->setParams(array($idMembre));
        $stmt = $this->executer();
    
        if($ligne=$stmt->fetch(PDO::FETCH_OBJ)){
            $unMembre = new Membre($ligne->idMembre, $ligne->prenom, $ligne->nom, $ligne->courriel, $ligne->sexe, $ligne->dateDeNaissance, $ligne->motDePasse, $ligne->statut);
        }

        return $unMembre;
    }
    
}
