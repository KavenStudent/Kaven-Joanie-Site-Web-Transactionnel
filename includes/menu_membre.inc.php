<?php
if (!isset($_SESSION['membre'])) {
    echo "Vous devez être connecté pour accéder à cette page";
    exit;
} else {

?>
	<input type="hidden" id="myMemberid" name="myMemberid" value="<?php echo $_SESSION['membre']; ?>">
    <!-- nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <div class="container-fluid">

            <div class="company">
                <img id="monLogo" class="navbar-brand" src="public/images/icon-logo-film.png" alt="" class="logo">
                <h3> Kajo movie </h3>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="javascript:listerFilms()">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:profil()" >Profil</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="javascript:tableHistoriques();">Historique d'achat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="javascript:tableLocation();">Location en cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="javascript:deconnexion()">Déconnexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary myButton" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"> <i class="material-icons">&#xe8cc;</i></a>
                    </li>

                </ul>

                <div class="d-flex  nav-droite">
                    <select class="form-select" onChange="lister('categ',this.options[this.selectedIndex].value)">
                        <option value="dr">Choisir ...</option>
                        <option value="Comedy">Comédie</option>
                        <option value="Fantasy">Fantaisie</option>
                        <option value="Drama">Drama</option>
                        <option value="Music">Music</option>
                        <option value="Adventure">Adventure</option>
                        <option value="History">Historique</option>
                        <option value="Thriller">Suspense</option>
                        <option value="Animation">Animation</option>
                        <option value="Familly">Famille</option>
                        <option value="Biography">Biographie</option>
                        <option value="Action">Action</option>
                        <option value="Film-Noir">Film-Noir</option>
                        <option value="Romance">Romance</option>
                        <option value="Sci-Fi">Sci-Fi</option>
                        <option value="War">Guerre</option>
                        <option value="Western">Western</option>
                        <option value="Horror">Horreur</option>
                        <option value="Musical">Musical</option>
                        <option value="Sport">Sport</option>
                    </select>
                </div>

                <div class="d-flex nav-droite">
                    <input class="inputSearch" type="search" id="rctitre" placeholder="Titre" aria-label="Recherche">
                    <button class="btn btn-outline-success" onClick="lister('titre',document.getElementById('rctitre').value)">Recherche</button>
                </div>


                <div class="d-flex nav-droite">
                    <input class="inputSearch" type="search" id="rcres" placeholder="Réalisateur" aria-label="Recherche">
                    <button class="btn btn-outline-success" onClick="lister('res',document.getElementById('rcres').value)">Recherche</button>
                </div>

            </div>
        </div>
    </nav>

<?php
}
?>