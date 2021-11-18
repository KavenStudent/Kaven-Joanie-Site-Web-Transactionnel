<?php
class Membre {
    private $idMembre;
    private $prenom;
    private $courriel;
    private $sexe;
    private $dateDeNaisssance;

    public function __construct(int $idMembre, string $prenom , string $courriel, string $sexe, string $dateDeNaisssance) 
    { 
        $this->idMembre = $idMembre; 
        $this->prenom = $prenom;
        $this->courriel = $courriel;
        $this->sexe = $sexe;
        $this->dateDeNaisssance = $dateDeNaisssance; 
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
}

interface MembreDao  
{ 
    public function getAllMembre():array; 
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
?>