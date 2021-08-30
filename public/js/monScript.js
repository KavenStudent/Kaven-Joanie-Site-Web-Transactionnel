let valider = () => {
    let formEnreg = document.getElementById('form-Enreg');
    let num = formEnreg.num.value;
    let titre = formEnreg.titre.value;
    let pages = formEnreg.pages.value;
    let etat = true;

    if(num.length == 0 || titre.length == 0 || pages.length == 0){
        etat = false;
    }

    return etat;
}

let montrer = (idElem) => {
    $('#form-Enreg').toggle();
}

let cacher = (idElem) => {
    document.getElementById(idElem).style.display = 'none';
}
