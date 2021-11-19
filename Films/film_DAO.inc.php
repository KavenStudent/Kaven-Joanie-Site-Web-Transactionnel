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
    public function getId(): int
    {
        return $this->idFilm;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getAnnee(): int
    {
        return $this->annee;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getRealisateurs(): string
    {
        return $this->realisateurs;
    }

    public function getActeurs(): string
    {
        return $this->acteurs;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function getBandeAnnonce(): string
    {
        return $this->bandeAnnonce;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getGenres(): array
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
    public function getAllFilms(string $par, string $valeurPar): array;
    public function getFilm(int $idFilm): Film;
    public function enregistrerFilm(Film $film, $dossier): int;
    public function modifierFilm(Film $film, $dossier): int;
    public function deleteFilm(int $idFilm);
    public function enregistrerPanier(array $panier): float;
}

class FilmDaoImp extends Modele implements FilmDao
{
    public function getAllFilms(string $par, string $valeurPar): array
    {
        $listeFilms = array();

        switch (trim($par)) {
            case "tout":
                $requete = "SELECT * FROM films WHERE 1=? ORDER BY annee DESC";
                $valeurPar = 1;
                break;
            case "id":
                $requete = "SELECT * FROM films WHERE 1=? ORDER BY idFilm";
                $valeurPar = 1;
                break;
            case "res":
                $requete = "SELECT * FROM films WHERE LOWER(realisateurs) LIKE CONCAT('%', ?, '%') ORDER BY annee DESC";
                break;
            case "categ":
                $requete = "SELECT * FROM films f INNER JOIN filmgenre fg ON f.idFilm = fg.idFilm INNER JOIN genre g ON g.idGenre = fg.idGenre WHERE g.nomGenre = ? ORDER BY annee DESC";
                break;
            case "titre":
                $requete = "SELECT * FROM films WHERE LOWER(titre) LIKE CONCAT('%', ?, '%') ORDER BY annee DESC";
                break;
        }
        try {

            $this->setRequete($requete);
            $this->setParams(array(trim($valeurPar)));
            $stmt = $this->executer();

            while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
                $listeFilms[] = $ligne;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            unset($requete);
        }

        return $listeFilms;
    }

    public function getFilm(int $idFilm): Film
    {
        $tabGenres = array();

        try {
            // les info du film
            $requete = "SELECT * FROM films WHERE idFilm=?";
            $this->setRequete($requete);
            $this->setParams(array($idFilm));
            $stmt = $this->executer();
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            //les genres du film
            $requete = "SELECT nomgenre as genre FROM `genre` INNER JOIN filmgenre on genre.idGenre = filmgenre.idGenre where filmgenre.idFilm = ?";
            $this->setRequete($requete);
            $this->setParams(array($idFilm));
            $stmt = $this->executer();

            while ($ligne = $stmt->fetch(PDO::FETCH_OBJ)) {
                $tabGenres[] = $ligne;
            }

            // instantiation d'un film 
            $unFilm = new Film($result->idFilm, $result->titre, $result->annee, $result->duree, $result->realisateurs, $result->acteurs, $result->description, $result->image, $result->bandeAnnonce, $result->prix, $tabGenres);
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            unset($requete);
        }

        return $unFilm;
    }

    public function enregistrerFilm(Film $film, $dossier): int
    {
        try {
            // mettre image dans le dossier
            $image = $this->verserFichier($dossier, "image", $film->getImage(), $film->getTitre());

            // enregistrer film
            $requete = "INSERT INTO films values(0,?,?,?,?,?,?,?,?,?)";
            $this->setRequete($requete);
            $this->setParams(array($film->getTitre(), $film->getAnnee(), $film->getDuree(), $film->getRealisateurs(), $film->getActeurs(), $film->getDescription(), $image, $film->getBandeAnnonce(), $film->getPrix()));
            $stmt = $this->executer();


            $id = $this->getLastId();
            $tabGenres = $film->getGenres();

            // ajoute les genres du film dans la bd
            foreach ($tabGenres as $genre) {

                $requete = "SELECT idGenre FROM genre WHERE nomGenre LIKE ?";
                $this->setRequete($requete);
                $this->setParams(array($genre));
                $stmt = $this->executer();

                $result = $stmt->fetch(PDO::FETCH_OBJ);
                $idGenre = $result->idGenre;

                $requete = "INSERT INTO filmgenre values(?,?)";
                $this->setRequete($requete);
                $this->setParams(array($id, $idGenre));
                $stmt = $this->executer();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            unset($requete);
        }

        return $id;
    }

    public function modifierFilm(Film $film, $dossier): int
    {
        try {
            // cherche l'image du film
            $requete = "SELECT image FROM films WHERE idFilm=?";
            $this->setRequete($requete);
            $this->setParams(array($film->getId()));
            $stmt = $this->executer();
            $ligne = $stmt->fetch(PDO::FETCH_OBJ);
            $ancienneImage = $ligne->image;

            $image = $this->verserFichier($dossier, "image", $ancienneImage, $film->getTitre());

            // update du film
            $requete = "UPDATE films SET titre=?,annee=?,duree=?,realisateurs=?,acteurs=?,description=?,image=?,bandeAnnonce=?,prix=? WHERE idFilm=?";
            $this->setRequete($requete);
            $this->setParams(array($film->getTitre(), $film->getAnnee(), $film->getDuree(), $film->getRealisateurs(), $film->getActeurs(), $film->getDescription(), $image, $film->getBandeAnnonce(), $film->getPrix(), $film->getId()));
            $stmt = $this->executer();

            // delete les genres du film
            $requete = "DELETE FROM filmgenre WHERE idFilm=?";
            $this->setRequete($requete);
            $this->setParams(array($film->getId()));
            $stmt = $this->executer();

            // ajout des genres du film
            $tabGenres = $film->getGenres();


            foreach ($tabGenres as $genre) {

                $requete = "SELECT idGenre FROM genre WHERE nomGenre LIKE ?";
                $this->setRequete($requete);
                $this->setParams(array($genre));
                $stmt = $this->executer();

                $result = $stmt->fetch(PDO::FETCH_OBJ);
                $idGenre = $result->idGenre;

                $requete = "INSERT INTO filmgenre values(?,?)";
                $this->setRequete($requete);
                $this->setParams(array($film->getId(), $idGenre));
                $stmt = $this->executer();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            unset($requete);
        }

        return $film->getId();
    }

    public function deleteFilm(int $idFilm)
    {
        try {
            // cherche l'image
            $requete = "SELECT image FROM films WHERE idFilm=?";
            $this->setRequete($requete);
            $this->setParams(array($idFilm));
            $stmt = $this->executer();

            $image = $stmt->fetch(PDO::FETCH_OBJ)->image;

            if ($image != null) {
                $this->enleverFichier("imageFilm", $image); // enleve l'image

                // enleve le film de la bd
                $requete = "DELETE FROM films WHERE idFilm=?";
                $this->setRequete($requete);
                $stmt = $this->executer();

                // enleve les genres du film de la bd
                $requete = "DELETE FROM filmgenre WHERE idFilm=?";
                $this->setRequete($requete);
                $stmt = $this->executer();
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            unset($requete);
        }
    }

    public function enregistrerPanier(array $panier): float
    {
        $date = date("Y-m-d");
        $total = 0;
        try {

            // parcours les item achetes et les insere dans location
            foreach ($panier as $film) {
                $total += (float)$film['prix'];

                $idFilm = $film['idFilm'];
                $dureeLocation = $film['dureeLocation'];
                $idMembre = $film['idMembre'];

                $requete = "INSERT INTO location values(?,?,?,?)";
                $this->setRequete($requete);
                $this->setParams(array($idFilm, $idMembre, $date, $dureeLocation));
                $stmt = $this->executer();
    
            }

            //parcours les item achetes et les insere dans paiement
            foreach ($panier as $film) {

                $idMembre = $film['idMembre'];
                $idFilm = $film['idFilm'];
                $prixFilm = $film['prix'];

                $requete = "INSERT INTO paiement values(0,?,?,?,?)";
                $this->setRequete($requete);
                $this->setParams(array($idMembre, $idFilm,  $date, $prixFilm));
                $stmt = $this->executer();

            }
        } finally {
            unset($requete);
        }
        return $total;
    }
}
