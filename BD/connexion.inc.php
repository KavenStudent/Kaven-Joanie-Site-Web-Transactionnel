<?php
	define("SERVEUR","localhost");
	define("USAGER","root");
	define("PASSE","");
	define("BD","bdfilmsjoaniekaven");
	
	$connexion = new mysqli(SERVEUR,USAGER,PASSE,BD);
	if ($connexion->connect_errno) {
		echo "Erreur de connexion au serveur de la bd";
		exit();
	}
?>