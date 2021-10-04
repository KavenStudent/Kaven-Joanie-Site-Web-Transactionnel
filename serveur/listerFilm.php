<?php
<<<<<<< Updated upstream
	 require_once("BD/connexion.inc.php");
=======
	require_once("../BD/connexion.inc.php");
	
>>>>>>> Stashed changes
	$requette="SELECT * FROM films";
	 try{
		 $listeFilms=mysqli_query($connexion,$requette);
         $rep="<div class='page' id='liste-film'>";
		 $i=0;
		
		 $rep.=' <div class="row">';
		 while($ligne=mysqli_fetch_object($listeFilms)){
			if ($i%4==0){
				$rep.='</div>';
				$rep.=' <div class="row">';
			}
				
<<<<<<< Updated upstream
					$rep.='<div class="card">';
                    
					//$rep.='<img src="../pochettes/'.($ligne->pochette).'" width=80 height=280 class="card-img-top" alt="...">';
                   // $idFilm= $ligne->idFilms;
                    //$requette ="SELECT image FROM films WHERE idFilm = $ligne->idFilms"
                   // $stmt = $connexion->prepare($requete);
                    //$stmt->bind_param("i",$idFilm);
                    //$stmt->execute();
                   // $result = $stmt->get_result();

                   // if(str_starts_with(string $result->fetch_object(), string $http)){
                    $rep.='<img class="image-film" src="'.($ligne->image).'" alt="image-film">';
                    
                    // }
                    // else{
                    //   $rep.='<img class"image-film" src="../pochettes/'.($ligne->pochette).' alt="image film">'
                    // }
                  
					 $rep.='<div class="card-body">';
					 $rep.='<h5 class="card-title">'.($ligne->titre).'('.($ligne->annee).')'."</h5>";
					 $rep.='<p class="card-text">'.($ligne->realisateurs).'5$</p>';
					 //$rep.='<p class="card-text">'.($ligne->prix).'</p>';
					 $rep.='<a href="#" class="btn btn-primary">Plus d info </a>';
					 $rep.='</div>';
					 $rep.='</div>';
=======
					$rep.='<div class="card';
                    $rep.='<a href="#">';
					//$rep.='<img src="../pochettes/'.($ligne->pochette).'" width=80 height=280 class="card-img-top" alt="...">';
                    $requette ="SELECT image FROM films WHERE $ligne->idFilms"
                    if(str_starts_with(string $requette, string $http)){

                    }
                    else{
                        $rep.='<img class"image-film" src="../pochettes/'.($ligne->pochette).' alt="image film">'
                    }
                    $rep.='</a>';
					$rep.='<div class="card-body">';
					$rep.='<h5 class="card-title">'.($ligne->titre).'</h5>';
					$rep.='<p class="card-text">'.($ligne->idf).'</p>';
					$rep.='<p class="card-text">'.($ligne->duree).'</p>';
					$rep.='<p class="card-text">'.($ligne->res).'</p>';
					$rep.='<a href="#" class="btn btn-primary">Détails</a>';
					$rep.='</div>';
					$rep.='</div>';
>>>>>>> Stashed changes
			
				$i++;
		}
			$rep.="</div>";//fermer le dernier row
		$rep.="</div>";//fermer le container
		mysqli_free_result($listeFilms);
	 }catch (Exception $e){
		echo "Probleme pour lister";
	 }finally {
		echo $rep;
	 }
	 mysqli_close($connexion);
?>