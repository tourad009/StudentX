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
            <h1 class="mt-4">Gestion des Notes</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Gestion des notes</li>
            </ol>

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
                    <tr>
                      <td>ETU001</td>
                      <td>Évaluation sur les réseaux</td>
                      <td>15</td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editNoteModal" onclick="fillEditModal('ETU001', 'Évaluation sur les réseaux', 15)">Modifier</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNoteModal" onclick="fillDeleteModal('ETU001')">Supprimer</button>
                      </td>
                    </tr>
                    <tr>
                      <td>ETU002</td>
                      <td>Évaluation sur le marketing</td>
                      <td>18</td>
                      <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editNoteModal" onclick="fillEditModal('ETU002', 'Évaluation sur le marketing', 18)">Modifier</button>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteNoteModal" onclick="fillDeleteModal('ETU002')">Supprimer</button>
                      </td>
                    </tr>
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
            <form action="ajouter_note.php" method="POST">
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
                <input type="number" class="form-control" name="note" min="0" max="20" required>
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
            <form action="modifier_note.php" method="POST">
              <input type="hidden" id="editMatricule" name="matricule">
              <div class="mb-3">
                <label class="form-label">Évaluation</label>
                <input type="text" id="editEvaluation" class="form-control" name="evaluation" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Note</label>
                <input type="number" id="editNote" class="form-control" name="note" min="0" max="20" required>
              </div>
              <button type="submit" class="btn btn-warning">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Supprimer une Note -->
    <div class="modal fade" id="deleteNoteModal" tabindex="-1" aria-labelledby="deleteNoteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteNoteModalLabel">Supprimer la Note</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Êtes-vous sûr de vouloir supprimer cette note ?</p>
            <form action="supprimer_note.php" method="POST">
              <input type="hidden" id="deleteMatricule" name="matricule">
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      function fillEditModal(matricule, evaluation, note) {
        document.getElementById("editMatricule").value = matricule;
        document.getElementById("editEvaluation").value = evaluation;
        document.getElementById("editNote").value = note;
      }

      function fillDeleteModal(matricule) {
        document.getElementById("deleteMatricule").value = matricule;
      }
    </script>

  </body>
</html>
