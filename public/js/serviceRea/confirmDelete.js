document.addEventListener("DOMContentLoaded", function () {

    const btnDeleteElements = document.querySelectorAll(".btn-delete");
   
    btnDeleteElements.forEach((btnDelete) => {
        btnDelete.addEventListener("click", function (event) {
        event.preventDefault();

        const serviceReaId = this.getAttribute('data-id');
        const serviceReaName = this.getAttribute('name-servicerea');

        Swal.fire({
            title: `Voulez-vous bien supprimer la réalisation ${serviceReaName}? `,
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Annuler la suppression',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Oui, supprimer',
        }).then((reponse) => {
            if (reponse.isConfirmed) {
                window.location.href = `serviceReaMainController?id=${serviceReaId}&action=delete`;
            }
        })
    })
    })
});