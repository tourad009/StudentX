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
            <h1 class="mt-4">Gestion des Utilisateurs</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Gestion des utilisateurs</li>
            </ol>

            <!-- Table des Utilisateurs -->
            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-users me-1"></i>
                Liste des utilisateurs
              </div>
              <div class="card-body">
                <!-- Button pour ajouter un utilisateur -->
                <a href="ajouter_utilisateur.php" class="btn btn-primary mb-3">Ajouter un utilisateur</a>

                <!-- Table des utilisateurs -->
                <table id="datatablesSimple" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nom de l'utilisateur</th>
                      <th>Email</th>
                      <th>Rôle</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- Exemple d'un utilisateur -->
                    <tr>
                      <td>Jean Dupont</td>
                      <td>jean.dupont@example.com</td>
                      <td>Étudiant</td>
                      <td>
                        <a href="modifier_utilisateur.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_utilisateur.php?id=1" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple d'un autre utilisateur -->
                    <tr>
                      <td>Marie Martin</td>
                      <td>marie.martin@example.com</td>
                      <td>Administrateur</td>
                      <td>
                        <a href="modifier_utilisateur.php?id=2" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_utilisateur.php?id=2" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple d'un autre utilisateur -->
                    <tr>
                      <td>Pierre Durand</td>
                      <td>pierre.durand@example.com</td>
                      <td>Étudiant</td>
                      <td>
                        <a href="modifier_utilisateur.php?id=3" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_utilisateur.php?id=3" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
                      </td>
                    </tr>
                    <!-- Exemple d'un autre utilisateur -->
                    <tr>
                      <td>Sophie Lefevre</td>
                      <td>sophie.lefevre@example.com</td>
                      <td>Administrateur</td>
                      <td>
                        <a href="modifier_utilisateur.php?id=4" class="btn btn-warning btn-sm">Modifier</a>
                        <a href="supprimer_utilisateur.php?id=4" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">Supprimer</a>
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
