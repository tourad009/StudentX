
// Récupération des champs du formulaire
const currentPassword = document.getElementById("current_password");
const newPassword = document.getElementById("new_password");
const confirmPassword = document.getElementById("confirm_password");

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

// Validation du mot de passe actuelle
currentPassword.addEventListener("input", () => {
    const passwordValue = currentPassword.value.trim();
    const currentPasswordValidator = Validator.passwordValidator("Le mot de passe actuel", passwordValue, 8);

    if (currentPasswordValidator) {
        showError(currentPassword, currentPasswordValidator.message);
    }
    else
    {
        showError(currentPassword, "");
    }
});

// Validation du nouveau mot de passe
newPassword.addEventListener("input", () => {
    const newPasswordValue = newPassword.value.trim();
    const newPasswordValidator = Validator.passwordValidator("Le nouveau mot de passe", newPasswordValue, 8);

    if (newPasswordValidator) {
        showError(newPassword, newPasswordValidator.message);
    }
    else
    {
        showError(newPassword, "");
    }
});


// Validation du mot de passe de confirmation
confirmPassword.addEventListener("input", () => {
    const confirmPasswordValue = confirmPassword.value.trim();
    const confirmPasswordValidator = Validator.passwordValidator("Le mot de passe de confirmation", confirmPasswordValue, 8);

    if (confirmPasswordValidator) {
        showError(confirmPassword, confirmPasswordValidator.message);
    }
    else if (confirmPasswordValue != newPassword.value.trim()) {
        showError(confirmPassword, "Les deux mot de passe ne sont pas conformes");
    }
    else
    {
        showError(confirmPassword, "");
    }
});


