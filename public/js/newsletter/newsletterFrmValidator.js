

const emailNewsletterInput = document.getElementById("newsletter-email");
const frmAddNewsletter = document.getElementById("addNewsletterForm");
const btnNewsletterSubmit = frmAddNewsletter.querySelector("button[type='submit']");

let isEmailNewsletterValid = false;


// Désactive le bouton de soumission par defaut
btnNewsletterSubmit.disabled = true;

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
    if (isEmailNewsletterValid) {
        btnNewsletterSubmit.removeAttribute("disabled");
    }
}

// Validation du champ email à la saisie
emailNewsletterInput.addEventListener("input", () => {
    const email = emailNewsletterInput.value.trim();
    const emailValidator = Validator.emailValidator("L'email", email);

    if (emailValidator) {
        showError(emailNewsletterInput, emailValidator.message);
        isEmailNewsletterValid = false;
    }
    else
    {
        showError(emailNewsletterInput, "");
        isEmailNewsletterValid = true;
    }
    checkFormValidity();
});
