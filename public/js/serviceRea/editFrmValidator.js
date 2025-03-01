// Récupération des champs du formulaire
const idInputEdit = document.getElementById("edit-id");
const nomInputEdit = document.getElementById("edit-nom");
const descriptionInputEdit = document.getElementById("edit-description");
const photoInputEdit = document.getElementById("edit-photo");
const typeInputEdit = document.getElementById("edit-type");
const frmEditRealisation = document.getElementById("editRealisationForm");
const btnSubmitEdit = frmEditRealisation.querySelector("button[type='submit']");
const photoPreview = document.getElementById("photo-preview");

// Désactive le bouton de soumission par defaut
btnSubmitEdit.disabled = true;

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


// Validation du champ nom à la saisie
nomInputEdit.addEventListener("input", () => {
    const nom = nomInputEdit.value.trim();
    const nomValidator = Validator.nameValidator("Le nom", 5, 40, nom);

    if (nomValidator) {
        showError(nomInput, nomValidator.message);
    }
    else
    {
        showError(nomInput, "");
    }
    checkFormValidity();
});

// Validation du champ description à la saisie
descriptionInputEdit.addEventListener("input", () => {
    const description = descriptionInputEdit.value.trim();
    const descriptionValidator = Validator.nameValidator("La description", 10, 500, description);

    if (descriptionValidator) {
        showError(descriptionInput, descriptionValidator.message);
    }
    else
    {
        showError(descriptionInput, "");
    }
    checkFormValidity();
});

// Validation du champ photo à la selection
photoInputEdit.addEventListener("change", () => {
    const file = photoInputEdit.files[0];
    if (!file && !photoPreview.src) {
        showError(photoInput, "La photo est obligatoire.");
    }
    else if (!file.type.startsWith("image/")) {
        showError(photoInput, "Le fichier doit être une image.");
    }
    else {
        showError(photoInput, "");
    }
    checkFormValidity();
});

// Validation du champ type
typeInputEdit.addEventListener("change", () => {
    if (typeInputEdit.value === "") {
        showError(typeInput, "Veuillez sélectionner un type.");
    }
    else
    {
        showError(typeInput, "");
    }
    checkFormValidity();
});



function checkFormValidity() {
    // const nom = nomInputEdit.value.trim();
    // const description = descriptionInputEdit.value.trim();
    // const photo = photoInputEdit.files[0];
    // const type = typeInputEdit.value;

    // const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
    // const isDescriptionValid = Validator.nameValidator("La description", 10, 500, description) == null;
    // const isPhotoValid = photo && photo.type.startsWith("image/") || photoPreview.src !== "";
    // const isTypeValid = type !== "";

    // if (isNameValid && isDescriptionValid && isPhotoValid && isTypeValid) {
    //     btnSubmitEdit.removeAttribute("disabled");
    // }
}

const editButtons = document.querySelectorAll('.btn-edit');

editButtons.forEach(button => {
    button.addEventListener("click", () => {
        // Récupération de la valeur des attributs data-* de la balise cliquée
        const id = button.getAttribute("data-id");
        const nom = button.getAttribute("data-nom");
        const description = button.getAttribute("data-description");
        const type = button.getAttribute("data-type");
        const photo = button.getAttribute("data-photo");

        // Remplir les champs du formulaire avec les données récupérées
        idInputEdit.value = id;
        nomInputEdit.value = nom;
        descriptionInputEdit.value = description;
        typeInputEdit.value = type;

        // Mettre à jour la source de l'aperçu de la photo
        if (photo) {
            photoPreview.src = `../../images/servicesRea/${photo}`;
        } else {
            photoPreview.src = "";
        }

        const isNameValid = Validator.nameValidator("Le nom", 5, 40, nom) == null;
        const isDescriptionValid = Validator.nameValidator("La description", 10, 500, description) == null;
        const isPhotoValid = photo != null;
        const isTypeValid = type !== "";

        btnSubmitEdit.disabled = !(isNameValid && isDescriptionValid && isPhotoValid && isTypeValid);
    });
});
