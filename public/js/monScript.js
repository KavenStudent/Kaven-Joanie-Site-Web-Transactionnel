let valider = () => {

    let myForm = document.getElementById('formMembre');
    let password = myForm.password.value;
    let confirmPassword = myForm.confirmPassword.value;
    let isValid = password.trim() === confirmPassword.trim();


    if(isValid == false){
        document.getElementById('msg-password-erreur').style.display = 'block';
    }

    return isValid;
}

//pas besoin ?
// let montrer = (idElem) => {
//     //$('#').toggle();
//     $('modalMembre').toggle();
// }

// function connexion(idElem) {
//     $('modalConnexion').toggle();
// }

// let cacher = (idElem) => {
//     document.getElementById(idElem).style.display = 'none';
// }



