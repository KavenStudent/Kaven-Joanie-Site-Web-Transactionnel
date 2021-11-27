<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once("includes/modele.inc.php");
require_once("Membres/membre_DAO.inc.php");

final class MembreDaoImpTest extends TestCase
{

    public function testGetAllMembreReturnArray(): void
    {
        $dao = new MembreDaoImp();
        $result = $dao->getAllMembre();

        $this->assertIsArray(
            $result,
            "assert variable is array or not"
        );
    }

    public function testGetAllMembreReturnNonNull(): void
    {
        $dao = new MembreDaoImp();
        $result = $dao->getAllMembre();

        $this->assertNotNull( 
            $result, 
            "variable is null or not"
        ); 
    }

    public function testGetAllMembreCountPlusUn(): void
    {
        $dao = new MembreDaoImp();
        $result = $dao->getAllMembre();
        $expected = 1;
        $nbresult = count($result);

        $this->assertGreaterThanOrEqual( 
            $expected, 
            $nbresult, 
            "actual value is greater than or equal to expected"
        );
    }
}