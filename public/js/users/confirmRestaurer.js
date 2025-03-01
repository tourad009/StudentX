const btnRestaurerElements = document.querySelectorAll(".btn-restaurer-user");

btnRestaurerElements.forEach((btnRestaurer) => {
    btnRestaurer.addEventListener("click", function (event) {
        event.preventDefault();

        const userId = this.getAttribute('data-confirm-id-user');
        const userName = this.getAttribute('data-confirm-nom-user');

        Swal.fire({
            title: `Voulez-vous bien restaurer l'utilisateur ${userName}? `,
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Annuler la restauration',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Oui, restaurer',
        }).then((reponse) => {
            if (reponse.isConfirmed) {
                window.location.href = `userMainController?id=${userId}&action=restaurer`;
            }
        });
    });
});
