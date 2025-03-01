
// Récupération des champs du formulaire
const nomInput = document.getElementById("user-nom");
const adresseInput = document.getElementById("user-adresse");
const telephoneInput = document.getElementById("user-telephone");
const emailInput = document.getElementById("user-email");
const photoInput = document.getElementById("user-photo");
const roleInput = document.getElementById("user-role");
const frmAddUser = document.getElementById("addUserForm");
const btnSubmit = frmAddUser.querySelector("button[type='submit']");

let isNameValid = false;
let isAdresseValid = false;
let isTelephoneValid = false;
let isEmailValid = false;
let isPhotoValid = false;
let isRoleValid = false;

// Désactive le bouton de soumission par defaut
// btnSubmit.disabled = true;

// Permet d'afficher ou masquer les message d'erreur
function showError(input, message)
{
    const baliseP = input.nextElementSibling;
    if (message) {
        baliseP.textContent = message;
        input.classList.add("is-invalid");
        baliseP.style.color = "brown";
        baliseP.style.fontWeight = "bold";
    }
    else
    {
        baliseP.textContent = "";
        input.classList.remove("is-invalid");
    }
}

function checkFormValidity()
{
    // if (isNameValid
    //     && isAdresseValid
    //     && isTelephoneValid
    //     && isEmailValid
    //     && isPhotoValid
    //     && isRoleValid) {
    //     btnSubmit.removeAttribute("disabled");
    // }
}

// Validation du champ nom à la saisie
nomInput.addEventListener("input", () => {
    const nom = nomInput.value.trim();
    const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

    if (nomValidator) {
        showError(nomInput, nomValidator.message);
        isNameValid = false;
    }
    else
    {
        showError(nomInput, "");
        isNameValid = true;
    }
    checkFormValidity();
});

// Validation du champ adresse à la saisie
adresseInput.addEventListener("input", () => {
    const adresse = adresseInput.value.trim();
    const adresseValidator = Validator.adresseValidator("L'adresse", 5, 50, adresse);

    if (adresseValidator) {
        showError(adresseInput, adresseValidator.message);
        isAdresseValid = false;
    }
    else
    {
        showError(adresseInput, "");
        isAdresseValid = true;
    }
    checkFormValidity();
});

// Validation du champ telephone à la saisie
telephoneInput.addEventListener("input", () => {
    const telephone = telephoneInput.value.trim();
    const telephoneValidator = Validator.phoneValidator("Le numéro de téléphone", 9, 17, telephone);

    if (telephoneValidator) {
        showError(telephoneInput, telephoneValidator.message);
        isTelephoneValid = false;
    }
    else
    {
        showError(telephoneInput, "");
        isTelephoneValid = true;
    }
    checkFormValidity();
});


// Validation du champ email à la saisie
emailInput.addEventListener("input", () => {
    const email = emailInput.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);

    if (emailValidator) {
        showError(emailInput, emailValidator.message);
        isEmailValid = false;
    }
    else
    {
        showError(emailInput, "");
        isEmailValid = true;
    }
    checkFormValidity();
});

// Validation du champ photo à la selection
photoInput.addEventListener("change", () => {
    const file = photoInput.files[0];
    if (!file) {
        showError(photoInput, "La photo est obligatoire.");
        isPhotoValid = false;
    }
    else if (!file.type.startsWith("image/")) {
        showError(photoInput, "Le fichier doit être une image.");
        isPhotoValid = false;
    }
    else {
        showError(photoInput, "");
        isPhotoValid = true;
    }
    checkFormValidity();
});

// Validation du champ role
roleInput.addEventListener("change", () => {
    if (roleInput.value === "") {
        showError(roleInput, "Veuillez sélectionner un role.");
        isRoleValid = false;
    }
    else
    {
        showError(roleInput, "");
        isRoleValid = true;
    }
    checkFormValidity();
});

frmAddUser.addEventListener("reset", () => {
    isNameValid = false;
    isAdresseValid = false;
    isTelephoneValid = false;
    isEmailValid = false;
    isPhotoValid = false;
    isRoleValid = false;
    btnSubmit.disabled = false;
});
