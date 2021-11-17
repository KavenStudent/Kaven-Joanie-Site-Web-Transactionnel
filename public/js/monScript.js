var jsonUrl = './public/util/bdfilms.json';
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
    //enregistrerMembre();
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

//liste les films a partir d'un json
function listerFilms() {
  $.getJSON(jsonUrl, function (json) {
    let contenu = `<div class="row">`;
    let compteur = 0;
    let compteur_row = 0;

    for (let i = 0; i < 12; i++) {

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

// Méthodes submit pour aller à une autre page
// function listerHistorique() {
//   document.getElementById('formHistorique').submit();
// }

// function retourAccueil() {
//   document.getElementById('formAccueil').submit();
// }

// function retourAccueilM() {
//   document.getElementById('formAccueilM').submit();
// }

// function listerFilms() {
//   document.getElementById('formListerFilms').submit();
// }

// function listerMembres() {
//   document.getElementById('formListerMembres').submit();
// }

// function AccueilAdmin() {
//   document.getElementById('formAccueilAdmin').submit();

// }

// function listerLocation() {
//   document.getElementById('formLocation').submit();
// }


// function deconnexion() {

//   document.getElementById('deconnexion').submit();
// }

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

// popule et montre le modal modifier film (admin modifier film)
// function populerModal(id, path) { //done
//   obtenirInfo(id, path).then(data => {
//     let genres = data[1];

//     document.getElementById('id-modifier').value = data[0].idFilm;
//     document.getElementById('titre-modifier').value = data[0].titre;
//     document.getElementById('annee-modifier').value = data[0].annee;
//     document.getElementById('duree-modifier').value = data[0].duree;
//     document.getElementById('realisateur-modifier').value = data[0].realisateurs;
//     document.getElementById('acteur-modifier').value = data[0].acteurs;
//     document.getElementById('description-modifier').value = data[0].description;
//     document.getElementById('prix-modifier').value = data[0].prix;
//     document.getElementById('bandeAnnonce-modifier').value = data[0].bandeAnnonce;

//     // parcours les checkbox des genres
//     $('input[type=checkbox]').each(function () {

//       genres.forEach(ligne => {
//         // si le value du checkbox est dans genres on le coche
//         if (ligne.genre === $(this).val()) {
//           $(this).prop('checked', true);
//         }

//       });

//     });

//   }).finally(() => {
//     $("#modal-modifier-film").modal('show');
//   });

// }

// popule et montre le modal quand on clique 'plus d'info' dans les cards des films
// function afficherTrailer(id, path) { done
//   obtenirInfo(id, path)
//     .then(data => {
//       let contenu = `<h4> ${data[0].titre} </h4>
//       <p><strong>Genres: </strong>`;

//       for (i = 0; i < data[1].length; i++) {
//         contenu += data[1][i].genre + " ";
//       };

//       contenu += `</p><p><strong>Durée: </strong> ${data[0].duree} minutes</p>
//       <p><strong>Réalisateur: </strong>${data[0].realisateurs} </p>
//       <p><strong>Acteurs: </strong>${data[0].acteurs} </p>
//       <p><strong>Description: </strong>${data[0].description} </p>`;



//       document.getElementById('trailer').src = data[0].bandeAnnonce;
//       document.getElementById('info-film').innerHTML = contenu;
//     })
//     .finally(() => {
//       $("#modal-trailer").modal('show');
//     });
// }



// Methodes du panier
// envoie l'id d'un film à ajouter au panier
function ajout(id) {
  document.getElementById('idLocation').value = id;
  $("#modal-location").modal('show');
}

// envoie le film dans le panier
// function envoyerAuPanier() {
//   let jour = Math.trunc(document.getElementById('jour').value);
//   idLocation = document.getElementById('idLocation').value;

//   if (jour < 1) { // si le jour est negatif met le jour a 1
//     jour = 1;
//   }
//   ajoutPanier(idLocation, jour);
// }

// appelé par envoyerAuPanier ajoute l'item au panier
// function ajoutPanier(id, jours) {
//   path = "../serveur/fiche.php";
//   let existe = false;
//   let duree = jours;


//   obtenirInfo(id, path).then(data => {
//     let prixTotal = data[0].prix * duree;
//     let idMembre = document.getElementById('idMembre').value;
//     let film = {
//       "idFilm": data[0].idFilm,
//       "titre": data[0].titre,
//       "dureeLocation": duree,
//       "image": data[0].image,
//       "prix": prixTotal.toFixed(2),
//       "idMembre": idMembre
//     };

//     panier = JSON.parse(localStorage.getItem("panier"));

//     // regarde si le film est deja dans le panier de
//     for (let i = 0; i < panier.length; i++) {

//       if (panier[i].idFilm == data[0].idFilm) { // si existe augmente la duree de la location
//         existe = true;

//         duree = panier[i].dureeLocation + jours;
//         prixTotal = data[0].prix * duree;

//         film = {
//           "idFilm": data[0].idFilm,
//           "titre": data[0].titre,
//           "dureeLocation": duree,
//           "image": data[0].image,
//           "prix": prixTotal.toFixed(2),
//           "idMembre": idMembre
//         };
        
//         panier[i] = film;
//       }
//     }

//     // si le film n'existe pas on ajoute le film au panier
//     if (!existe) {
//       panier.push(film);
//     }

//     localStorage.setItem("panier", JSON.stringify(panier));

//   }).finally(() => {
//     $("#modal-location").modal('hide');
//     afficherPanier();
//     document.getElementById('jour').value = 1; // remet le input du nombre de jour à 1
//     let bsOffcanvas = new bootstrap.Offcanvas(document.getElementById("offcanvasRight"));
//     bsOffcanvas.show(); // affiche le canvas du panier
//   });
// }

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

  panier = panier.filter(item => item.idFilm !== idFilm)
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

// paie le panier 
// function payerPanier() {
//   let total = 0;

//   panier.forEach(unFilm => {
//     total += parseFloat(unFilm.prix);
//   });

//   $("#btnPayer").css('display', 'none');
//   id = document.getElementById("myMemberid").value;

//   paypal.Buttons({
//     createOrder: function (data, actions) {
//       // This function sets up the details of the transaction, including the amount and line item details.
//       return actions.order.create({
//         purchase_units: [{
//           amount: {
//             value: total
//           }
//         }]
//       });
//     },
//     onApprove: function () {
//       fetch('../serveur/locationFilm.php', {
//         method: 'POST',
//         mode: 'cors',
//         headers: {
//           'content-type': 'application/json'
//         },
//         body: JSON.stringify(panier)
//       }).then(function () {
//         viderPanier();
//         initialiser('Transaction de ' + total + '$ complété');

//       })
//     }
//   }).render('#paypal-button-container');

// }

// vide le panier 
function viderPanier() {
  localStorage.setItem("panier", '[]');
  afficherPanier();
  document.getElementById("total").innerHTML = '';
  $('#paypal-button-container').empty();
}

// submit les criteres de recherche
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

function NbJours($debut, $fin)
{

    $tDeb = explode("-", $debut);
    $tFin = explode("-", $fin);

    $diff = mktime(0, 0, 0, $tFin[1], $tFin[2], $tFin[0]) -
        mktime(0, 0, 0, $tDeb[1], $tDeb[2], $tDeb[0]);

    return (($diff / 86400));
}

// ready
$(document).ready(function () {
  $(".toast-container").css("display", "none");
  listerFilms();
  pagination();
  afficherPanier();
});