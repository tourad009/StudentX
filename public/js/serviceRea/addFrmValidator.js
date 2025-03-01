
// Récupération des champs du formulaire
const nomInput = document.getElementById("nom");
const descriptionInput = document.getElementById("description");
const photoInput = document.getElementById("photo");
const typeInput = document.getElementById("type");
const frmAddRealisation = document.getElementById("addRealisationForm");
const btnSubmit = frmAddRealisation.querySelector("button[type='submit']");

let isNameValid = false;
let isDescriptionValid = false;
let isPhotoValid = false;
let isTypeValid = false;

// Désactive le bouton de soumission par defaut
btnSubmit.disabled = false;

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
    if (isNameValid && isDescriptionValid && isPhotoValid && isTypeValid) {
        btnSubmit.removeAttribute("disabled");
    }
    
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

// Validation du champ description à la saisie
descriptionInput.addEventListener("input", () => {
    const description = descriptionInput.value.trim();
    const descriptionValidator = Validator.nameValidator("La description", 10, 500, description);

    if (descriptionValidator) {
        showError(descriptionInput, descriptionValidator.message);
        isDescriptionValid = false;
    }
    else
    {
        showError(descriptionInput, "");
        isDescriptionValid = true;
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

// Validation du champ type
typeInput.addEventListener("change", () => {
    if (typeInput.value === "") {
        showError(typeInput, "Veuillez sélectionner un type.");
        isTypeValid = false;
    }
    else
    {
        showError(typeInput, "");
        isTypeValid = true;
    }
    checkFormValidity();
});

frmAddRealisation.addEventListener("reset", () => {
    isNameValid = false;
    isDescriptionValid = false;
    isPhotoValid = false;
    isTypeValid = false;
    btnSubmit.disabled = true;
});
