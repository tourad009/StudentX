<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/controller/etudiant/StudentController.php";

try {
    $controller = new StudentController();
    $etudiants = $controller->listStudents();
} catch (Exception $e) {
    $_SESSION['error_message'] = "Erreur lors de la récupération des étudiants.";
}
?>

<!DOCTYPE html>
<html lang="en">
  <!-- Section Head -->
  <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentX/view/sections/admin/head.php") ?>

<body class="sb-nav-fixed">
    <!-- Section Menu Haut -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentX/view/sections/admin/menuHaut.php") ?>

    <div id="layoutSidenav">
      <!-- Section Menu Gauche -->
      <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentX/view/sections/admin/menuGauche.php") ?>

      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Liste des étudiants</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Liste des étudiants</li>
            </ol>

            <!-- Table des Étudiants -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste des étudiants
              </div>
              <div class="card-body">
                <!-- Barre de recherche par matricule -->
                <div class="mb-3">
                  <input type="text" id="searchMatricule" class="form-control" placeholder="Rechercher par matricule...">
                </div>

                <!-- Table des étudiants -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Prénom</th>
                      <th>Matricule</th>
                      <th>Téléphone</th>
                      <th>Email</th>
                      <th>Adresse</th>
                    </tr>
                  </thead>
                  <tbody id="studentTableBody">
                    <?php if (!empty($etudiants)): ?>
                        <?php foreach ($etudiants as $etudiant): ?>
                            <tr>
                                <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                                <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                                <td><?= htmlspecialchars($etudiant['matricule']) ?></td>
                                <td><?= htmlspecialchars($etudiant['tel']) ?></td>
                                <td><?= htmlspecialchars($etudiant['email']) ?></td>
                                <td><?= htmlspecialchars($etudiant['adresse']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucun étudiant trouvé</td>
                        </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>
        
        <!-- Section Footer -->
        <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentX/view/sections/admin/footer.php") ?>
      </div>
    </div>

    <!-- Section Scripts -->
    <?php require_once($_SERVER['DOCUMENT_ROOT'] . "/StudentX/view/sections/admin/script.php") ?>

    <script>
    document.getElementById("searchMatricule").addEventListener("keyup", function() {
        let input = this.value.toLowerCase();
        let rows = document.querySelectorAll("#studentTableBody tr");

        rows.forEach(row => {
            let matricule = row.cells[2].textContent.toLowerCase(); // Index 2 correspond à la colonne Matricule
            row.style.display = matricule.includes(input) ? "" : "none";
        });
    });
    </script>

</body>
</html>
