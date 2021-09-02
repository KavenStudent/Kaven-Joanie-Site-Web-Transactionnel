<h2>GESTTION DES LIVRES</h2>
<?php
    define("MSG", "Livre bien enregistrer");
    define("FICHIER", "../donnees/livre.txt");
    $num = $_POST['num'];
    $titre = $_POST['titre'];
    $pages = $_POST['pages'];


    try{
        $fic = fopen(FICHIER,"a+");
        $ligne= $num.";".$titre.";".$pages."\n";
        fputs($fic,$ligne);
        fclose($fic);
        echo "<br><br>".MSG;
    }catch(Exeption $e){
        echo "Probleme d'ecriture dans le fichier";
    }
?>