var jsonUrl = './public/util/bdfilms.json';
var visibleConfirmer = false;
var visibleMotdePasse = false;

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

function montrerConfirmerPass(){
   
  if(visibleConfirmer === true){
    $("#confirmerPasse").css("display", "none");
    visibleConfirmer = false;
  }
  else{
    $("#confirmerPasse").css("display", "block");
    visibleConfirmer = true;
  }
}

  function montrerPassword2(){

    if(visibleMotdePasse === true){
      $("#password").prop("type", "password");
      $("#confirmPassword").prop("type", "password");
      visibleMotdePasse = false;
    }
    else{
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


async function obtenirInfo(id) {

  const response = await fetch('../serveur/fiche.php', {
    method: 'POST', 
    mode: 'cors', 
    headers: {
      'Content-Type': 'application/json'
    },

    body: JSON.stringify({ "idFilm": id }) 
  });
  return response.json();


  alert(JSON.stringify(response));

}

function listerHistorique(){
  document.getElementById('formHistorique').submit();
}

function retourAccueilM(){
  document.getElementById('formAccueilM').submit();
}

function populerModal(id){
  obtenirInfo(id).then(data => {
    console.log(data);
    document.getElementById('id-modifier').value = data.idFilm;
    document.getElementById('titre-modifier').value = data.titre;
    document.getElementById('annee-modifier').value = data.annee;
    document.getElementById('duree-modifier').value = data.duree;
    document.getElementById('realisateur-modifier').value = data.realisateurs;
    document.getElementById('acteur-modifier').value = data.acteurs;
    document.getElementById('description-modifier').value = data.description;
    document.getElementById('prix-modifier').value = data.prix;
   
  }).finally(() => {$("#modal-modifier-film").modal('show');});
  
}

function listerFilms(){
  document.getElementById('formListerFilms').submit();
}

function listerMembres(){
  document.getElementById('formListerMembres').submit();
}

function AccueilAdmin(){
  document.getElementById('formAccueilAdmin').submit();

}