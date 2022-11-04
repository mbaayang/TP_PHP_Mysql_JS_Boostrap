/* -------------------------Formulaire d'inscription---------------------- */


document.getElementById("inscription").addEventListener("submit", function(e){
    var error1, error2, error3, error4, error5, error6;
    var nom = document.getElementById("nom");
    var prenom = document.getElementById("prenom");
    var email = document.getElementById("Email");
    var role = document.getElementById("role");
    var password1 = document.getElementById("mdp1");
    var password2 = document.getElementById("mdp2");

    if (!nom.value.trim()) {
        error1 = "Veillez renseigner un nom";
    }
    if (error1) {
        e.preventDefault();
        document.getElementById("error1").innerHTML = error1;
        return false;
    }else{
        document.getElementById("error1").innerHTML = "";
    }

    if (!prenom.value.trim()) {
        error2 = "Veillez renseigner un prenom";
    }
    if (error2) {
        e.preventDefault();
        document.getElementById("error2").innerHTML = error2;
        return false;
    }else{
        document.getElementById("error2").innerHTML = "";
    }

    if (!email.value.trim()) {
        error3 = "Veillez renseigner l'adresse mail";
    }
    if (error3) {
        e.preventDefault();
        document.getElementById("error3").innerHTML = error3;
        return false;
    }else{
        document.getElementById("error3").innerHTML = "";
    }

    if (!role.value.trim()) {
        error4 = "Veillez renseigner le role";
    }
    if (error4) {
        e.preventDefault();
        document.getElementById("error4").innerHTML = error4;
        return false;
    }else{
        document.getElementById("error4").innerHTML = "";
    }

    if (!password1.value) {
        error5 = "Veillez renseigner un mot de passe";
    }
    if (error5) {
        e.preventDefault();
        document.getElementById("error5").innerHTML = error5;
        return false;
    }else{
        document.getElementById("error5").innerHTML = "";
    }

    if (!password2.value) {
        error6 = "Veillez confirmer le mot de passe";
    }
    if (error6) {
        e.preventDefault();
        document.getElementById("error6").innerHTML = error6;
        return false;
    }else{
        document.getElementById("error6").innerHTML = "";
    }
 })