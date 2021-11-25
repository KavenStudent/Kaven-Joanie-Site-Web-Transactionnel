<?php 
use PHPUnit\Framework\TestCase;
require_once("includes/modele.inc.php");
require_once("Films/film_DAO.inc.php");

final class FilmDaoImpTest extends TestCase
{
    public function testObtenirFilmExistantParIdRetourneFilmAvecMemeId(): void{
        $dao = new FilmDaoImp();
        $id = 1;
        $filmObtenu = $dao->getFilm($id);

        $this->assertEquals($id, $filmObtenu->getId());
    }
}

?>