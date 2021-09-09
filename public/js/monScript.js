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
