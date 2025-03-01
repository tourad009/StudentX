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
            <h1 class="mt-4">Liste des étudiants</h1>
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
                <!-- Button pour ajouter un étudiant -->
                <a href="ajouter_etudiant.php" class="btn btn-primary mb-3">Ajouter un étudiant</a>

                <!-- Table des étudiants -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Matricule</th>
                      <th>Téléphone</th>
                      <th>Email</th>
                      <th>Adresse</th>
                      <th>Date d'inscription</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Exemple d'un étudiant -->
                    <tr>
                      <td>Jean Dupont</td>
                      <td>202301</td>
                      <td>0123456789</td>
                      <td>jean.dupont@example.com</td>
                      <td>123 rue de Paris, 75001 Paris</td>
                      <td>2023-01-15</td>
                      <td>
                        <a href="modifier_etudiant.php?id=202301" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_etudiant.php?id=202301" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple d'un autre étudiant -->
                    <tr>
                      <td>Marie Martin</td>
                      <td>202302</td>
                      <td>0987654321</td>
                      <td>marie.martin@example.com</td>
                      <td>456 avenue des Champs-Élysées, 75008 Paris</td>
                      <td>2023-07-20</td>
                      <td>
                        <a href="modifier_etudiant.php?id=202302" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_etudiant.php?id=202302" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?')">Supprimer</a>
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

</body>
</html>
