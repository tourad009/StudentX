document.addEventListener("DOMContentLoaded", function () {

    const btnRestaurerElements = document.querySelectorAll(".btn-restaurer");
   
    btnRestaurerElements.forEach((btnRestaurer) => {
        btnRestaurer.addEventListener("click", function (event) {
        event.preventDefault();

        const serviceReaId = this.getAttribute('data-id');
        const serviceReaName = this.getAttribute('name-servicerea');

        Swal.fire({
            title: `Voulez-vous bien restaurer la réalisation ${serviceReaName}? `,
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Annuler la restauration',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Oui, restaurer',
        }).then((reponse) => {
            if (reponse.isConfirmed) {
                window.location.href = `serviceReaMainController?id=${serviceReaId}&action=restaurer`;
            }
        })
    })
    })
});