<?php
session_start(); // Démarrer la session avant toute sortie HTML
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/controller/note/NoteController.php";

try {
    $controller = new NoteController();
    $notes = $controller->getAllNotes();
} catch (Exception $e) {
    $_SESSION['error_message'] = "Erreur lors de la récupération des notes.";
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
        <!-- Section Content -->
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Gestion des Notes</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Gestion des notes</li>
            </ol>

            <!-- Affichage des messages de succès ou d'erreur -->
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

            <!-- Table des Notes -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Liste des notes
              </div>
              <div class="card-body">

                <!-- Barre de recherche et bouton Ajouter -->
                <div class="d-flex justify-content-between mb-3">
                  <input type="text" id="searchMatricule" class="form-control w-50" placeholder="Rechercher par matricule...">
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNoteModal">Ajouter une note</button>
                </div>

                <!-- Table des notes -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Matricule</th>
                      <th>Nom de l'évaluation</th>
                      <th>Note</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody id="notesTableBody">
                    <?php if (!empty($notes)): ?>
                        <?php foreach ($notes as $note): ?>
                            <tr>
                                <td><?= htmlspecialchars($note['matricule']) ?></td>
                                <td><?= htmlspecialchars($note['evaluation_nom']) ?></td>
                                <td><?= htmlspecialchars($note['note']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm editNoteBtn" 
                                            data-id="<?= htmlspecialchars($note['note_id']) ?>"
                                            data-note="<?= htmlspecialchars($note['note']) ?>"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editNoteModal">
                                        Modifier
                                    </button>
                                    <button class="btn btn-danger btn-sm deleteNoteBtn"
                                            onclick="if(confirm('Êtes-vous sûr de vouloir supprimer cette note ?')) {
                                                document.getElementById('deleteNoteId').value='<?= htmlspecialchars($note['note_id']) ?>';
                                                document.getElementById('deleteNoteForm').submit();
                                            }">
                                        Supprimer
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center">Aucune note trouvée</td>
                        </tr>
                    <?php endif; ?>
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

    <!-- MODALS -->

    <!-- Modal Ajouter une Note -->
    <div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNoteModalLabel">Ajouter une Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="NoteMainController" method="POST">
              <input type="hidden" name="action" value="ajouter">
              <div class="mb-3">
                <label for="matricule" class="form-label">Matricule</label>
                <input type="text" class="form-control" name="matricule" required>
              </div>
              <div class="mb-3">
                <label for="evaluation" class="form-label">Évaluation</label>
                <input type="text" class="form-control" name="evaluation" required>
              </div>
              <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" name="note" min="0" max="20" step="0.25" required>
              </div>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Modifier une Note -->
    <div class="modal fade" id="editNoteModal" tabindex="-1" aria-labelledby="editNoteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editNoteModalLabel">Modifier la Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="NoteMainController" method="POST">
              <input type="hidden" name="action" value="modifier">
              <input type="hidden" name="note_id" id="editNoteId">
              <div class="mb-3">
                <label for="note" class="form-label">Note</label>
                <input type="number" class="form-control" name="note" id="editNoteValue" 
                       min="0" max="20" step="0.25" required>
              </div>
              <button type="submit" class="btn btn-warning">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Formulaire de suppression caché -->
    <form id="deleteNoteForm" action="NoteMainController" method="POST" style="display: none;">
        <input type="hidden" name="action" value="supprimer">
        <input type="hidden" name="note_id" id="deleteNoteId">
    </form>

    <script>
      // Remplir le modal de modification
      document.querySelectorAll('.editNoteBtn').forEach(button => {
          button.addEventListener('click', function() {
              document.getElementById('editNoteId').value = this.dataset.id;
              document.getElementById('editNoteValue').value = this.dataset.note;
          });
      });

      // Recherche par matricule
      document.getElementById("searchMatricule").addEventListener("keyup", function() {
          let input = this.value.toLowerCase();
          let rows = document.querySelectorAll("#notesTableBody tr");

          rows.forEach(row => {
              let matricule = row.cells[0].textContent.toLowerCase();
              row.style.display = matricule.includes(input) ? "" : "none";
          });
      });
    </script>

  </body>
</html>
