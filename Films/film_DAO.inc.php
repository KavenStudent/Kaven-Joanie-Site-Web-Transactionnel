<?php
class Film 
{ 
    private $idFilm; 
    private $titre; 
    private $annee; 
    private $duree; 
    private $realisateurs; 
    private $acteurs; 
    private $description; 
    private $image; 
    private $bandeAnnonce; 
    private $prix; 
    private $genres; 
  
    public function __construct(int $idFilm, string $titre, int $annee, int $duree, string $realisateurs, string $acteurs, string $description, string $image, string $bandeAnnonce, float $prix, array $genres) 
    { 
        $this->idFilm = $idFilm; 
        $this->titre = $titre; 
        $this->annee = $annee; 
        $this->duree = $duree; 
        $this->realisateurs = $realisateurs; 
        $this->acteurs = $acteurs; 
        $this->description = $description; 
        $this->image = $image; 
        $this->bandeAnnonce = $bandeAnnonce; 
        $this->prix = $prix; 
        $this->genres = $genres; 
    } 

    // getters
    public function getId():int  
    { 
    return $this->idFilm; 
    } 

    public function getTitre():string  
    { 
    return $this->titre; 
    } 
  
    public function getAnnee():int  
    { 
    return $this->annee; 
    } 

    public function getDuree():int   
    { 
    return $this->duree; 
    } 

    public function getRealisateurs():string  
    { 
    return $this->realisateurs; 
    } 

    public function getActeurs():string  
    { 
    return $this->acteurs; 
    } 
  
    public function getDescription():string  
    { 
    return $this->description; 
    } 

    public function getImage():string  
    { 
    return $this->image; 
    } 

    public function getBandeAnnonce():string  
    { 
    return $this->bandeAnnonce; 
    } 

    public function getPrix():float  
    { 
    return $this->prix; 
    } 

    public function getGenres():array  
    { 
    return $this->genres; 
    } 

    //setters
    public function setTitre(string $titre)
    { 
    $this->titre = $titre; 
    } 
  
    public function setAnnee(int $annee)
    { 
    $this->annee = $annee; 
    } 

    public function setDuree(int $duree)
    { 
    $this->duree = $duree; 
    } 

    public function setRealisateurs(string $realisateurs)
    { 
    $this->realisateurs = $realisateurs; 
    } 

    public function setActeurs(string $acteurs)
    {
    $this->acteurs = $acteurs; 
    } 
  
    public function setDescription(string $description) 
    { 
    $this->description = $description; 
    } 
    
    public function setImage(string $image)
    { 
    $this->image = $image; 
    } 

    public function setBandeAnnonce(string $bandeAnnonce)
    {
    $this->bandeAnnonce = $bandeAnnonce; 
    } 

    public function setPrix(float $prix) 
    { 
    $this->prix = $prix; 
    } 

    public function setGenres(array $genres)
    { 
    $this->genres = $genres; 
    } 
} 

interface FilmDao  
{ 
    public function getAllFilms():array; 
    public function getFilm(int $idFilm):Film;
    public function enregistrerFilm(Film $film);
    public function updateDeveloppeur(Film $film); 
    public function deleteFilm(int $idFilm); 
}
