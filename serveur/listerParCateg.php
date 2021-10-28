<?php
	
        $par=$_POST['par'];
        $valeurPar=strtolower(trim($_POST['valeurPar']));
        switch($par){
            case "tout" : 
                $requette="SELECT * FROM films WHERE 1=?";
                $valeurPar=1;
            break;
            case "res" :
                $requette="SELECT * FROM films WHERE LOWER(res) LIKE CONCAT('%', ?, '%')";
            break;
            case "categ" :
                $requette="SELECT * FROM films WHERE categ=?";
            break;
            case "titre" :
                $requette="SELECT * FROM films WHERE LOWER(titre) LIKE CONCAT('%', ?, '%')";
            break;
        }
        
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("s", $valeurPar);
        $stmt->execute();
        $listeFilms = $stmt->get_result();
        
        // $listeFilms = mysqli_query($connexion, $requette);
        // $rep = "<div class='page' id='liste-film'>";
        // $i = 0;

        // $rep .= ' <div class="row">';

        // $test = 'httpasdasd';

        // while ($ligne = mysqli_fetch_object($listeFilms)) {
        //     if ($i % 4 == 0) {
        //         $rep .= '</div>';
        //         $rep .= ' <div class="row">';
        //     }

        //     $rep .= '<div class="card">';



        //     if (substr($ligne->image, 0, 4) === "http") {
        //         $rep .= '<img class="image-film" src="' . ($ligne->image) . '" alt="image-film">';
        //     } else {
        //         $rep .= '<img class="image-film" src="imageFilm/' . ($ligne->image) . '" alt="image film">';
        //     }


        //     $rep .= '<div class="card-body">';
        //     $rep .= '<h5 class="card-title">' . ($ligne->titre) . '(' . ($ligne->annee) . ')' . "</h5>";
        //     $rep .= '<p class="card-text">' . ($ligne->realisateurs) . '</p>';
        //     $rep .= '<p class="card-text">' . ($ligne->prix) . '$</p>';
        //     $rep .= '<a href="#" class="btn btn-primary">Plus d info </a>';
        //     $rep .= '</div>';
        //     $rep .= '</div>';

        //     $i++;
        // }
        // $rep .= "</div>"; //fermer le dernier row
        // $rep .= "</div>"; //fermer le container
        // mysqli_free_result($listeFilms);
        
        header("Location:index.php");
    
                  
?>