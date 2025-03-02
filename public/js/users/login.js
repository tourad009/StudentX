$(document).ready(function () {
  $("#loginForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "index.php?page=login",
      type: "POST",
      data: $(this).serialize(),
      dataType: "json",
      success: function (response) {
        if (response.success) {
          // Afficher le message de succès
          $("#successMessage")
            .show()
            .text("Connexion réussie ! Redirection...");

          // Redirection vers la page admin
          setTimeout(function () {
            window.location.href = "index.php?page=admin";
          }, 1000);
        } else {
          // Afficher le message d'erreur
          $("#errorMessage")
            .show()
            .text(response.message || "Identifiants incorrects");
        }
      },
      error: function (xhr, status, error) {
        console.error("Erreur AJAX:", error);
        $("#errorMessage")
          .show()
          .text("Une erreur est survenue lors de la connexion");
      },
    });
  });
});
