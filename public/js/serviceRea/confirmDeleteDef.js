document.addEventListener("DOMContentLoaded", function () {

    const btnDeleteDefElements = document.querySelectorAll(".btn-delete-definitive");
   
    btnDeleteDefElements.forEach((btnDeleteDef) => {
        btnDeleteDef.addEventListener("click", function (event) {
        event.preventDefault();

        const serviceReaId = this.getAttribute('data-id');
        const serviceReaName = this.getAttribute('name-servicerea');

        Swal.fire({
            title: `Voulez-vous bien supprimer définitivement la réalisation ${serviceReaName}? `,
            text: "Cette action est irréversible !",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Annuler la suppréssion définitive',
            confirmButtonColor: '#d33',
            confirmButtonText: 'Oui, Supprimer',
        }).then((reponse) => {
            if (reponse.isConfirmed) {
                window.location.href = `serviceReaMainController?id=${serviceReaId}&action=deleteDefinitive`;
            }
        })
    })
    })
});