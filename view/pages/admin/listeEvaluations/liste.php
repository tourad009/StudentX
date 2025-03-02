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
            <h1 class="mt-4">Gestion des évaluations</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Gestion des évaluations</li>
            </ol>

            <!-- Table des Évaluations -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste des évaluations
              </div>
              <div class="card-body">
                <!-- Button pour ajouter une évaluation -->
                <a href="ajouter_evaluation.php" class="btn btn-primary mb-3">Ajouter une évaluation</a>

                <!-- Table des évaluations -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nom de l'évaluation</th>
                      <th>Semestre</th>
                      <th>Type</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Exemple d'une évaluation -->
                    <tr>
                      <td>Évaluation sur les réseaux</td>
                      <td>Semestre 1</td>
                      <td>Examen</td>
                      <td>
                        <a href="modifier_evaluation.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_evaluation.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple d'une autre évaluation -->
                    <tr>
                      <td>Évaluation sur le marketing</td>
                      <td>Semestre 2</td>
                      <td>Contrôle continu</td>
                      <td>
                        <a href="modifier_evaluation.php?id=2" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_evaluation.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Ajouter d'autres évaluations ici -->
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
  </div>
</body>
</html>
