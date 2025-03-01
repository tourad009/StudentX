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
            <h1 class="mt-4">Liste des Notes</h1>
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
                <!-- Button pour ajouter une note -->
                <a href="ajouter_note.php" class="btn btn-primary mb-3">Ajouter une note</a>

                <!-- Table des notes -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nom de l'étudiant</th>
                      <th>Nom de l'évaluation</th>
                      <th>Note</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Exemple de note -->
                    <tr>
                      <td>Jean Dupont</td>
                      <td>Évaluation sur les réseaux</td>
                      <td>15</td>
                      <td>
                        <a href="modifier_note.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_note.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple de note -->
                    <tr>
                      <td>Marie Martin</td>
                      <td>Évaluation sur le marketing</td>
                      <td>18</td>
                      <td>
                        <a href="modifier_note.php?id=2" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_note.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple de note -->
                    <tr>
                      <td>Pierre Durand</td>
                      <td>Évaluation sur les mathématiques</td>
                      <td>12</td>
                      <td>
                        <a href="modifier_note.php?id=3" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_note.php?id=3" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple de note -->
                    <tr>
                      <td>Sophie Lefevre</td>
                      <td>Évaluation sur la programmation</td>
                      <td>16</td>
                      <td>
                        <a href="modifier_note.php?id=4" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_note.php?id=4" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette note ?')">Supprimer</a>
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
  </body>
</html>
