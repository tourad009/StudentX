<!DOCTYPE html>
<html lang="fr">
  <?php require_once("../../../sections/admin/head.php") ?>

<body class="sb-nav-fixed">
    <?php require_once("../../../sections/admin/menuHaut.php") ?>

    <div id="layoutSidenav">
      <?php require_once("../../../sections/admin/menuGauche.php") ?>

      <div id="layoutSidenav_content">
        <main>
          <div class="container-fluid px-4">
            <h1 class="mt-4">Changer de mot de passe</h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item active">Sécurité du compte</li>
            </ol>

            <div class="card mb-4">
              <div class="card-header">
                <i class="fas fa-key me-1"></i> Modifier votre mot de passe
              </div>
              <div class="card-body">
                <?php if (isset($message)) : ?>
                  <div class="alert alert-info"><?= $message; ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                  <div class="mb-3">
                    <label for="ancien_mdp" class="form-label">Ancien mot de passe</label>
                    <input type="password" name="ancien_mdp" id="ancien_mdp" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label for="nouveau_mdp" class="form-label">Nouveau mot de passe</label>
                    <input type="password" name="nouveau_mdp" id="nouveau_mdp" class="form-control" required>
                  </div>

                  <div class="mb-3">
                    <label for="confirmer_mdp" class="form-label">Confirmer le nouveau mot de passe</label>
                    <input type="password" name="confirmer_mdp" id="confirmer_mdp" class="form-control" required>
                  </div>

                  <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
              </div>
            </div>
          </div>
        </main>

        <?php require_once("../../../sections/admin/footer.php") ?>
      </div>
    </div>

    <?php require_once("../../../sections/admin/script.php") ?>
</body>
</html>
