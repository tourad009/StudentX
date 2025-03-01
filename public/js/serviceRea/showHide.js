// Recupération des éléments
const tableListe = document.getElementById("table-liste");
const tableCorbeille = document.getElementById("table-corbeille");
const btnShowListe = document.getElementById("btn-show-liste");
const btnShowCorbeille = document.getElementById("btn-show-corbeille");


tableCorbeille.setAttribute("hidden", "hidden");
btnShowListe.setAttribute("hidden", "hidden");


btnShowCorbeille.addEventListener("click", function (event) {
    this.setAttribute("hidden", "hidden"); //masquer
    btnShowListe.removeAttribute("hidden"); //afficher

    tableListe.setAttribute("hidden", "hidden");
    tableCorbeille.removeAttribute("hidden");
});


btnShowListe.addEventListener("click", function (event) {
    this.setAttribute("hidden", "hidden");
    btnShowCorbeille.removeAttribute("hidden");

    tableListe.removeAttribute("hidden");
    tableCorbeille.setAttribute("hidden", "hidden");
});