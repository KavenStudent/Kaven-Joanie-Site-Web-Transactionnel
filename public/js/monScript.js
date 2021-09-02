let valider = () => {
    let myForm = document.getElementById('formMembre');
    let password = myForm.password.value;
    let confirmPassword = myForm.confirmPassword.value;
    let etat = false;

    alert(`${password} ${confirmPasswordpassword}`);

    if(password == confirmPassword){
        etat = false;
        
        alert("allo");
    }
    return etat;
}

let montrer = (idElem) => {
    $('#').toggle();
}

let cacher = (idElem) => {
    document.getElementById(idElem).style.display = 'none';
}



