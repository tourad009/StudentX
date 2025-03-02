<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/controller/evaluation/EvaluationController.php";

try {
    $controller = new EvaluationController();
    $evaluations = $controller->getAllEvaluations();
} catch (Exception $e) {
    $_SESSION['error_message'] = "Erreur lors de la récupération des évaluations.";
}
?>

<!DOCTYPE html>
<html lang="fr">
  <!-- Section Head -->
  <?php require_once("../../../sections/admin/head.php") ?>

<body class="sb-nav-fixed">
    <!-- Section Menu Haut -->
    <?php require_once("../../../sections/admin/menuHaut.php") ?>

    <div id="layoutSidenav">
      <!-- Section Menu Gauche -->
      <?php require_once("../../../sections/admin/menuGauche.php") ?>

      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Gestion des évaluations</h1>

            <!-- Messages de succès/erreur -->
            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success_message']) ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error_message']) ?>
                </div>
                <?php unset($_SESSION['error_message']); ?>
            <?php endif; ?>

            <!-- Table des Évaluations -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste des évaluations
              </div>
              <div class="card-body">
                <!-- Button pour ajouter une évaluation -->
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addEvaluationModal">
                    Ajouter une évaluation
                </button>

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
                    <?php if (!empty($evaluations)): ?>
                        <?php foreach ($evaluations as $evaluation): ?>
                            <tr>
                                <td><?= htmlspecialchars($evaluation['nom']) ?></td>
                                <td><?= htmlspecialchars($evaluation['semestre']) ?></td>
                                <td><?= htmlspecialchars($evaluation['type']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm editEvalBtn" 
                                            data-id="<?= htmlspecialchars($evaluation['evaluation_id']) ?>"
                                            data-nom="<?= htmlspecialchars($evaluation['nom']) ?>"
                                            data-semestre="<?= htmlspecialchars($evaluation['semestre']) ?>"
                                            data-type="<?= htmlspecialchars($evaluation['type']) ?>"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEvaluationModal">
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm deleteEvalBtn"
                                            onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette évaluation ?')) {
                                                document.getElementById('deleteEvalId').value='<?= htmlspecialchars($evaluation['evaluation_id']) ?>';
                                                document.getElementById('deleteEvalForm').submit();
                                            }">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Aucune évaluation trouvée</td>
                        </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </main>

        <!-- Modal Ajouter une Évaluation -->
        <div class="modal fade" id="addEvaluationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter une évaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="EvaluationMainController" method="POST">
                            <input type="hidden" name="action" value="ajouter">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de l'évaluation</label>
                                <input type="text" class="form-control" name="nom" required>
                            </div>
                            <div class="mb-3">
                                <label for="semestre" class="form-label">Semestre</label>
                                <input type="text" class="form-control" name="semestre" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" name="type" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Modifier une Évaluation -->
        <div class="modal fade" id="editEvaluationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier l'évaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="EvaluationMainController" method="POST">
                            <input type="hidden" name="action" value="modifier">
                            <input type="hidden" name="evaluation_id" id="editEvalId">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom de l'évaluation</label>
                                <input type="text" class="form-control" name="nom" id="editNom" required>
                            </div>
                            <div class="mb-3">
                                <label for="semestre" class="form-label">Semestre</label>
                                <input type="text" class="form-control" name="semestre" id="editSemestre" required>
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" name="type" id="editType" required>
                            </div>
                            <button type="submit" class="btn btn-warning">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulaire de suppression caché -->
        <form id="deleteEvalForm" action="EvaluationMainController" method="POST" style="display: none;">
            <input type="hidden" name="action" value="supprimer">
            <input type="hidden" name="evaluation_id" id="deleteEvalId">
        </form>

        <!-- Section Footer -->
        <?php require_once("../../../sections/admin/footer.php") ?>
      </div>
    </div>

    <!-- Section Scripts -->
    <?php require_once("../../../sections/admin/script.php") ?>

    <script>
    // Remplir le modal de modification
    document.querySelectorAll('.editEvalBtn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('editEvalId').value = this.dataset.id;
            document.getElementById('editNom').value = this.dataset.nom;
            document.getElementById('editSemestre').value = this.dataset.semestre;
            document.getElementById('editType').value = this.dataset.type;
        });
    });
    </script>
</body>
</html>
