<?php
	 require_once("BD/connexion.inc.php");
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