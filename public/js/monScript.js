var jsonUrl = './public/util/bdfilms.json';
var visibleConfirmer = false;
var visibleMotdePasse = false;
var panier = null;

if (localStorage.getItem("panier") == undefined) {
  localStorage.setItem("panier", '[]');//panier vide
}

let valider = (id) => {
  let myForm = document.getElementById(id);
  let password = myForm.password.value;
  let confirmPassword = myForm.confirmPassword.value;
  let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_])[A-Za-z\d\-_]{8,10}$/;

  if (!(password.trim() === confirmPassword.trim())) {

    document.getElementById('msg-confirm-password-erreur').style.display = 'block';
    return false;

  } else if (!pattern.test(password)) {

    document.getElementById('msg-password-erreur').style.display = 'block';
    return false;

  }
  return true;
}

function montrerPassword(id) {
  var x = document.getElementById(id);
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function montrerConfirmerPass() {

  if (visibleConfirmer === true) {
    $("#confirmerPasse").css("display", "none");
    visibleConfirmer = false;
  }
  else {
    $("#confirmerPasse").css("display", "block");
    visibleConfirmer = true;
  }
}

function montrerPassword2() {

  if (visibleMotdePasse === true) {
    $("#password").prop("type", "password");
    $("#confirmPassword").prop("type", "password");
    visibleMotdePasse = false;
  }
  else {
    $("#password").prop("type", "text");
    $("#confirmPassword").prop("type", "text");
    visibleMotdePasse = true;
  }
}

function listerFilms() {
  $.getJSON(jsonUrl, function (json) {
    let contenu = `<div class="row">`;
    let compteur = 0;
    let compteur_row = 0;

    for (let i = 0; i < 12; i++) { // 012340123401234

      contenu += `<div class="card">
      <a href="#"><img class="image-film" src="${json.movies[i].posterUrl}" alt="image film"></a>
      <div class="card-body">
        <h5 class="card-title">${json.movies[i].title} (${json.movies[i].year})</h5>
        <p class="card-text">${json.movies[i].director}</p>
        <a href="#" class="btn btn-primary">Plus d'info</a>
      </div>
      </div>`;

      compteur++;
      if (compteur == 4) {
        compteur_row++;
        contenu += `</div>`;
        if (compteur_row != 3) {
          contenu += `<div class="row">`;
        }
        compteur = 0;
      }

    }
    contenu += `</div>`;

    $('#liste-film').html(contenu);
  });
}

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

function envoyerIdFilm(id) {
  document.getElementById('id-film-delete').value = id;
}

function envoyerIdMembre(id) {
  document.getElementById('id-membre-delete').value = id;
}

function envoyerIdMembreActive(id) {
  document.getElementById('id-membre-activer').value = id;
}

$(document).ready(function () {
  $(".toast-container").css("display", "none");
});


function listerHistorique() {
  document.getElementById('formHistorique').submit();
}

function retourAccueilM() {
  document.getElementById('formAccueilM').submit();
}

async function obtenirInfo(id, path) {

  const response = await fetch(path, {
    method: 'POST',
    mode: 'cors',
    headers: {
      'Content-Type': 'application/json'
    },

    body: JSON.stringify({ "idFilm": id })
  });
  return response.json();

}

function populerModal(id, path) {
  obtenirInfo(id, path).then(data => {
    document.getElementById('id-modifier').value = data.idFilm;
    document.getElementById('titre-modifier').value = data.titre;
    document.getElementById('annee-modifier').value = data.annee;
    document.getElementById('duree-modifier').value = data.duree;
    document.getElementById('realisateur-modifier').value = data.realisateurs;
    document.getElementById('acteur-modifier').value = data.acteurs;
    document.getElementById('description-modifier').value = data.description;
    document.getElementById('prix-modifier').value = data.prix;
    document.getElementById('bandeAnnonce-modifier').value = data.bandeAnnonce;

  }).finally(() => { $("#modal-modifier-film").modal('show'); });

}

function afficherTrailer(id, path) {
  obtenirInfo(id, path)
    .then(data => {
      let contenu = `<h4> ${data.titre} </h4>
    <p><strong>Durée: </strong> ${data.duree} minutes</p>
    <p><strong>Réalisateur: </strong>${data.realisateurs} </p>
    <p><strong>Acteurs: </strong>${data.acteurs} </p>
    <p><strong>Description: </strong>${data.description} </p>`;

      document.getElementById('trailer').src = data.bandeAnnonce;
      document.getElementById('info-film').innerHTML = contenu;
    })
    .finally(() => { $("#modal-trailer").modal('show'); });
}

function listerFilms() {
  document.getElementById('formListerFilms').submit();
}

function listerMembres() {
  document.getElementById('formListerMembres').submit();
}

function AccueilAdmin() {
  document.getElementById('formAccueilAdmin').submit();

}

function listerLocation() {
  document.getElementById('formLocation').submit();
}


function deconnexion() {
  document.getElementById('deconnexion').submit();
}

function ajout(id) {
  document.getElementById('idLocation').value = id;
  $("#modal-location").modal('show');
}

function envoyerAuPanier() {
  let jour = Math.trunc(document.getElementById('jour').value);
  idLocation = document.getElementById('idLocation').value;

  if (jour < 1) {
    jour = 1;
  }
  ajoutPanier(idLocation, jour);
}

function ajoutPanier(id, jours) {
  path = "../serveur/fiche.php";
  let existe = false;
  let duree = jours;

  obtenirInfo(id, path).then(data => {
    let prixTotal = data.prix * duree;
    let film = { "idFilm": data.idFilm, "titre": data.titre, "dureeLocation": duree, "image": data.image, "prix": prixTotal.toFixed(2) };

    panier = JSON.parse(localStorage.getItem("panier"));

    for (let i = 0; i < panier.length; i++) {

      if (panier[i].idFilm == data.idFilm) {
        existe = true;

        duree = panier[i].dureeLocation + jours;
        prixTotal = data.prix * duree;

        film = { "idFilm": data.idFilm, "titre": data.titre, "dureeLocation": duree, "image": data.image, "prix": prixTotal.toFixed(2) };
        panier[i] = film;
      }
    }

    if (!existe) {
      panier.push(film);
    }
    localStorage.setItem("panier", JSON.stringify(panier));

  }).finally(() => {
    $("#modal-location").modal('hide');
    afficherPanier();
    document.getElementById('jour').value = 1;
    let bsOffcanvas = new bootstrap.Offcanvas(document.getElementById("offcanvasRight"));
    bsOffcanvas.show();
  });


}

function afficherPanier() {
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
          <td><img id="icon-film" class="image-film" src="${unFilm.image}" alt="image-film"></td>
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

  if (nbItems != 0) {
    ``
    document.getElementById("total").innerHTML = `
    <button type="button" class="btn btn-primary" onclick="viderPanier()">Vider</button>
    <button type="button" class="btn btn-primary" onclick="payerPanier()">Payer</button>
     ${nbItems} item(s) Total : ${total.toFixed(2)}$`;

  }

  document.getElementById("panier").innerHTML = lePanier;

 
}

function retirerFilm(idFilm) {

  panier = panier.filter(item => item.idFilm !== idFilm)
  localStorage.setItem("panier", JSON.stringify(panier));

  afficherPanier();
}

function payerPanier() {
  let total = 0;

  panier.forEach(unFilm => {
    total += parseFloat(unFilm.prix);
  });

  alert(`Montant payé : ${total.toFixed(2)}$`);

  viderPanier();
}

function viderPanier() {
  localStorage.setItem("panier", '[]');
  afficherPanier();
  document.getElementById("total").innerHTML = '';
}

$(document).ready(function () {

  pagination();

  if(window.location.pathname == '/Kaven-Joanie-TP/pages/listerFilms.php'|| window.location.pathname == '/Kaven-Joanie-TP/pages/listerMembres.php'){
    paginationTable();
  }
  
  if(window.location.pathname == '/Kaven-Joanie-TP/pages/membre.php'){
    afficherPanier();
  }
});


function lister(par, valeurPar) {
  if (par !== "") {
    document.getElementById('par').value = par;
    document.getElementById('valeurPar').value = valeurPar;
  }
  document.getElementById('formLister').submit();
}

function deconnexion() {
  document.getElementById('deconnexion').submit();

}

function pagination() {
  pageSize = 5;

  var pageCount = $(".row").length / pageSize;

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

function paginationTable() {
  nbLigne = 20;

  var pageCount = $(".uneLigne").length / nbLigne;

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
