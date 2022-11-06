/* -----------------formulaire de connexion-------------------*/
/* const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = message;
    inputControl.classList.add('error');
    inputControl.classList.remove('success')
}

const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.error');

    errorDisplay.innerText = '';
    inputControl.classList.add('success');
    inputControl.classList.remove('error');
};


const form1 = document.getElementById("connexion");
const email = document.getElementById("email");
const mdp = document.getElementById("mdp");

form1.addEventListener('submit', e => {
    validateInputs1();
});

const validateInputs1 = () =>{
    const emailValue = email.value.trim();
    const mdpValue = mdp.value.trim();

    if (emailValue === "") {
        setError(email, "Veillez renseignez ce champ");
    }else{
        setSuccess(email);
    }

    if (mdpValue === "") {
        setError(mdp, "Veillez renseignez ce champ");
    }else{
        setSuccess(mdp);
    }
}
 */


/* -------------------------Formulaire d'inscription---------------------- */


document.getElementById("connexion").addEventListener("submit", function(e){
    var error1, error2;
    var email = document.getElementById("email");
    var password = document.getElementById("mdp");

    if (!email.value.trim()) {
        error1 = "Veillez renseigner l'adresse mail";
    }
    if (error1) {
        e.preventDefault();
        document.getElementById("error1").innerHTML = error1;
        return false;
    }


    if (!password.value) {
        error2 = "Veillez renseigner le mot de passe";
    }
    if (error2) {
        e.preventDefault();
        document.getElementById("error2").innerHTML = error2;
        return false;
    }
 })