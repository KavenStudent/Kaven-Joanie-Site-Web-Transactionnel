var jsonUrl = './public/util/bdfilms.json';

let valider = () => {
    let myForm = document.getElementById('formMembre');
    let password = myForm.password.value;
    let confirmPassword = myForm.confirmPassword.value;
    let pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_])[A-Za-z\d\-_]{8,10}$/;

    if(!(password.trim() === confirmPassword.trim())){
       
        document.getElementById('msg-confirm-password-erreur').style.display = 'block';
        return false;

    }else if(!pattern.test(password)){

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

function listerFilms(){
  $.getJSON(jsonUrl, function(json){
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
      if(compteur == 4){
        compteur_row++;
        contenu += `</div>`;
        if(compteur_row != 3){
          contenu += `<div class="row">`;
        }
        compteur = 0;
      }

    }
    contenu += `</div>`;

    $('#liste-film').html(contenu);
});
}

let initialiser = (message) =>{
  let textToast = document.getElementById("textToast");
  let toastElList = [].slice.call(document.querySelectorAll('.toast'))
  let toastList = toastElList.map(function (toastEl) {
    return new bootstrap.Toast(toastEl)
  })
  if(message.length > 0){
    textToast.innerHTML = message;
    toastList[0].show();
  }
}
// $(document).ready(function(){
//   listerFilms();
// });