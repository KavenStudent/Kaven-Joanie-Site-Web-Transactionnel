var visibleConfirmer = false;
var visibleMotdePasse = false;
var panier = null;

// initialise le panier s'il n'existe pas 
if (localStorage.getItem("panier") == undefined) {
  localStorage.setItem("panier", '[]'); //panier vide
}

// valide le form devenir membre
let valider = (id) => {
  let myForm = document.getElementById(id);
  let password = myForm.password.value;
  let confirmPassword = myForm.confirmPassword.value;
  let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_])[A-Za-z\d\-_]{8,10}$/;
  let valide = true;

  if (!myForm.checkValidity()){
    document.getElementById('validation-form-membre').click();
    valide = false;

	}else if (!(password.trim() === confirmPassword.trim())) {

    document.getElementById('msg-confirm-password-erreur').style.display = 'block';
    valide = false;

  } else if (!pattern.test(password)) {

    document.getElementById('msg-password-erreur').style.display = 'block';
    valide = false;

  }

  if(valide){
    enregistrerMembre();
  }

}

// valide le form pour changer le profil du membre
let validerM = (id) => {
  let myForm = document.getElementById(id);
  let password = myForm.password.value;
  let confirmPassword = myForm.confirmPassword.value;
  let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_])[A-Za-z\d\-_]{8,10}$/;
  let valide = true;

  if (!myForm.checkValidity()){
    document.getElementById('validation-form-profil').click();
    valide = false;

	}else if (!(password.trim() === confirmPassword.trim())) {

    document.getElementById('msg-confirm-password-erreur2').style.display = 'block';
    valide = false;

  } else if (!pattern.test(password)) {

    document.getElementById('msg-password-erreur2').style.display = 'block';
    valide = false;

  }

  if(valide){
    document.getElementById('msg-confirm-password-erreur2').style.display = 'none';
    document.getElementById('msg-password-erreur2').style.display = 'none';
    modifierProfil();
  }

}

// montre le password dans l'input password dans devenir membre et connexion
function montrerPassword(id) {
  var x = document.getElementById(id);
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

// montre la confirmation du password dans devenir membre 
function montrerConfirmerPass() {

  if (visibleConfirmer === true) {
    $("#confirmerPasse").css("display", "none");
    visibleConfirmer = false;
  } else {
    $("#confirmerPasse").css("display", "block");
    visibleConfirmer = true;
  }
}

// affiche les 2 passwords dans modal modifier profil membre
function montrerPassword2() {

  if (visibleMotdePasse === true) {
    $("#profil-password").prop("type", "password");
    $("#profil-confirmPassword").prop("type", "password");
    visibleMotdePasse = false;
  } else {
    $("#profil-password").prop("type", "text");
    $("#profil-confirmPassword").prop("type", "text");
    visibleMotdePasse = true;
  }
}


// initialise les toast
let initialiser = (message) => {
  let textToast = document.getElementById("textToast");
  let toastElList = [].slice.call(document.querySelectorAll('.toast'))
  let toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl)
  })

  if (message.length > 0) {
    textToast.innerHTML = message;
    $(".toast-container").css("display", "block");
    toastList[0].show();
  }
}

// envoie l'id du film a supprimer (admin.php)
function envoyerIdFilm(id) {
  document.getElementById('id-film-delete').value = id;
}

// envoie l'id du membre pour le reactiver (admin.php)
function envoyerIdMembreActive(id) {
  document.getElementById('id-membre-activer').value = id;
}

// envoie l'id du membre pour le desactiver (admin.php)
function envoyerIdMembreDesactive(id) {
  document.getElementById('id-membre-delete').value = id;
}

// obtient les info d'un film en json
async function obtenirInfo(id, path) {

  const response = await fetch(path, {
    method: 'POST',
    mode: 'cors',
    headers: {
      'Content-Type': 'application/json'
    },

    body: JSON.stringify({
      "idFilm": id
    })
  });
  return response.json();

}


// Methodes du panier
// envoie l'id d'un film à ajouter au panier
function ajout(id) {
  document.getElementById('idLocation').value = id;
  $("#modal-location").modal('show');
}


// affiche les items du panier 
function afficherPanier() {
  $('#paypal-button-container').empty();
  var lePanier = `<table class="table table-sm"">
  <thead>
    <tr>
      <th scope="col">Image</th>
      <th scope="col">Titre</th>
      <th scope="col">Durée (jours)</th>
      <th scope="col">Prix</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>`;

  panier = JSON.parse(localStorage.getItem("panier"));
  let total = 0;
  let nbItems = panier.length;

  for (var unFilm of panier) {
    if (unFilm !== null) {
      lePanier += `
      
        <tr>
          <td><img class="icon-film" src="${unFilm.image}" alt="image-film"></td>
          <td>${unFilm.titre}</td>
          <td>${unFilm.dureeLocation}</td>
          <td>${unFilm.prix}$</td>
          <td><i class="material-icons btn-retirer-Film" onclick="retirerFilm(${unFilm.idFilm})"">&#xE872;</i></td>
        </tr>
     `;

      total += parseFloat(unFilm.prix);

    }

  }

  lePanier += ` </tbody>
  </table>`;

  // si le panier est vide n'on affiche pas ca 
  if (nbItems != 0) {

    document.getElementById("total").innerHTML = `
    <div id="container-total-panier">
    <button type="button" id="btnVider" class="btn btn-primary" onclick="viderPanier()">Vider</button>
    <button type="button" id="btnPayer" class="btn btn-primary" onclick="payerPanier()">Payer</button>
     ${nbItems} item(s) Total : ${total.toFixed(2)}$
     </div>`;

  }

  document.getElementById("panier").innerHTML = lePanier;

}

// retire un film du panier
function retirerFilm(idFilm) {
  
  panier = panier.filter(item => item.idFilm != idFilm);
  localStorage.setItem("panier", JSON.stringify(panier));
  let total = 0;

  if (panier.length == 0) {
    $('#total').empty();
  }
 
  if (panier.length > 0) {
    panier.forEach(unFilm => {
      total += parseFloat(unFilm.prix);
    });

    document.getElementById("total").innerHTML = `
    <button type="button" class="btn btn-primary" onclick="viderPanier()">Vider</button>
    <button type="button" id="btnPayer" class="btn btn-primary" onclick="payerPanier()">Payer</button>
     ${panier.length} item(s) Total : ${total.toFixed(2)}$`;

  }
  afficherPanier();
}

// vide le panier 
function viderPanier() {
  localStorage.setItem("panier", '[]');
  afficherPanier();
  document.getElementById("total").innerHTML = '';
  $('#paypal-button-container').empty();
}

// submit les criteres de recherche pour les films
function lister(par, valeurPar) {
  if (par !== "") {
    document.getElementById('par').value = par;
    document.getElementById('valeurPar').value = valeurPar;
  }
  let afficher =  document.getElementById('afficher').value
  if (afficher == "card"){
    listerFilms();
  }else if (afficher == "table"){
    tableFilms();
  }
    
}

// submit les criteres de recherche pour les membres
function listerMembre(par, valeurPar) {
  if (par !== "") {
    document.getElementById('par').value = par;
    document.getElementById('valeurPar').value = valeurPar;
  }
  tableMembres();
    
}

// pagination des cards des films
function pagination() {
  pageSize = 5;

  var pageCount = $(".row").length / pageSize;
  $("#pagin").empty();
  for (var i = 0; i < pageCount; i++) {

    $("#pagin").append('<li><a href="#">' + (i + 1) + '</a></li> ');
  }

  $("#pagin li").first().find("a").addClass("current")
  showPage = function (page) {

    $(".row").hide();
    $(".row").each(function (n) {
      if (n >= pageSize * (page - 1) && n < pageSize * page)
        $(this).show();
    });
  }
  showPage(1);

  $("#pagin li a").click(function () {
    $("#pagin li a").removeClass("current");
    $(this).addClass("current");
    showPage(parseInt($(this).text()))
  });
}

// pagination des table lister membre et lister film
function paginationTable() {
  nbLigne = 20;

  var pageCount = $(".uneLigne").length / nbLigne;
  $("#pagin").empty();
  for (var i = 0; i < pageCount; i++) {

    $("#pagin").append('<li><a href="#">' + (i + 1) + '</a></li> ');
  }

  $("#pagin li").first().find("a").addClass("current")
  showPage = function (page) {

    $(".uneLigne").hide();
    $(".uneLigne").each(function (n) {
      if (n >= nbLigne * (page - 1) && n < nbLigne * page)
        $(this).show();
    });
  }
  showPage(1);

  $("#pagin li a").click(function () {
    $("#pagin li a").removeClass("current");
    $(this).addClass("current");
    showPage(parseInt($(this).text()))
  });
}

// reinitialise les valeur des recherches films
function resetSearchBar(){
  $('#par').val('tout');
  $('#valeurPar').val('');
	$('select').prop('selectedIndex', 0);
	$('input[type=search]').prop('value','');
}

// ready
$(document).ready(function () {
  $(".toast-container").css("display", "none");
  listerFilms();
  afficherPanier();
  
  // empeche d'utiliser la touche enter dans les forms
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
});