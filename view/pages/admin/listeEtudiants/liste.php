<!DOCTYPE html>
<html lang="en">
  <!-- Section Head -->
  <?php require_once("../../../sections/admin/head.php") ?>

<body class="sb-nav-fixed">
    <!-- Section Menu Haut -->
    <?php require_once("../../../sections/admin/menuHaut.php") ?>

    <div id="layoutSidenav">
      <!-- Section Menu Gauche -->
      <?php require_once("../../../sections/admin/menuGauche.php") ?>

      <div id="layoutSidenav_content">
        <!-- Section Content -->
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Gestion des étudiants</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Gestion des étudiants</li>
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

                <!-- Button pour ajouter un étudiant -->
                <a href="ajouter_etudiant.php" class="btn btn-primary mb-3">Ajouter un étudiant</a>

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
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="studentTableBody">
                    <!-- Exemple d'un étudiant -->
                    <tr>
                      <td>Dupont</td>
                      <td>Jean</td>
                      <td>202301</td>
                      <td>0123456789</td>
                      <td>jean.dupont@example.com</td>
                      <td>123 rue de Paris, 75001 Paris</td>
                      <td>
                        <div class="d-flex flex-column gap-1">
                          <a href="modifier_etudiant.php?id=202301" class="btn btn-warning btn-sm">Modifier</a>
                          <a href="supprimer_etudiant.php?id=202301" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
                        </div>
                      </td>
                    </tr>
                    <!-- Exemple d'un autre étudiant -->
                    <tr>
                      <td>Martin</td>
                      <td>Marie</td>
                      <td>202302</td>
                      <td>0987654321</td>
                      <td>marie.martin@example.com</td>
                      <td>456 avenue des Champs-Élysées, 75008 Paris</td>
                      <td>
                        <div class="d-flex flex-column gap-1">
                          <a href="modifier_etudiant.php?id=202302" class="btn btn-warning btn-sm">Modifier</a>
                          <a href="supprimer_etudiant.php?id=202302" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
                        </div>
                      </td>
                    </tr>
                    <!-- Ajouter d'autres étudiants ici -->
                  </tbody>
                </table>

              </div>
            </div>
          </div>
        </main>
        
        <!-- Section Footer -->
        <?php require_once("../../../sections/admin/footer.php") ?>
      </div>
    </div>

    <!-- Section Scripts -->
    <?php require_once("../../../sections/admin/script.php") ?>

    <script>
      document.getElementById("searchMatricule").addEventListener("keyup", function() {
        let input = this.value.toLowerCase();
        let rows = document.querySelectorAll("#studentTableBody tr");

        rows.forEach(row => {
          let matricule = row.cells[2].textContent.toLowerCase(); // Matricule est la 3ème colonne (index 2)
          row.style.display = matricule.includes(input) ? "" : "none";
        });
      });
    </script>

</body>
</html>
