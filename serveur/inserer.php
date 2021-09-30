<?php
	require_once("../BD/connexion.inc.php");
	$str = file_get_contents('../public/util/bdfilms.json');
    $json = json_decode($str, true);

    foreach ($json['genres'] as $genre) {
        $requete="INSERT INTO genre values(0,?)";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("s", $genre);
        $stmt->execute();
    }

    foreach($json['movies'] as $film){
        $prix = (rand(1,4) * 5)-0.01;
        $requete="INSERT INTO films values(0,?,?,?,?,?,?,?,?)";
        $stmt = $connexion->prepare($requete);
        $stmt->bind_param("siisssss", $film['title'],$film['year'],$film['runtime'],$film['director'],$film['actors'],$film['plot'],$film['posterUrl'],strval($prix));
        $stmt->execute();
    }

    mysqli_close($connexion);

?>
<br><br>
<a href="../films.html">Retour à la page d'accueil</a>