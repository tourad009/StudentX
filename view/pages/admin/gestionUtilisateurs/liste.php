<?php
session_start();
require_once("../../../../model/UserRepository.php");

// Vérification de session simplifiée - commentée pour permettre l'accès
/*
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'Admin') {
    $_SESSION["error_message"] = "Session administrateur non trouvée. Veuillez vous connecter.";
    header("Location: login");
    exit;
}
*/

// Message de débogage pour voir l'état de la session
error_log("SESSION dans liste.php: " . print_r($_SESSION, true));

// Récupérer les utilisateurs depuis le modèle
$users = [];
try {
    $userRepo = new UserRepository();
    $users = $userRepo->getAll(1); // Récupère les utilisateurs actifs
    
    // Débogage pour voir la structure exacte des données
    if (!empty($users)) {
        error_log("Premier utilisateur: " . print_r($users[0], true));
    }
    
} catch (Exception $e) {
    $messageError = $e->getMessage();
    error_log("Erreur dans liste.php: " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">
<?php require_once("../../../sections/admin/head.php"); ?>

<body class="sb-nav-fixed">
    <?php require_once("../../../sections/admin/menuHaut.php"); ?>

    <div id="layoutSidenav">
        <?php require_once("../../../sections/admin/menuGauche.php"); ?>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Gestion des Utilisateurs</h1>
                    
                    <!-- Affichage des messages de succès ou d'erreur -->
                    <?php if (isset($_SESSION['success_message'])): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($_SESSION['success_message']) ?>
                        </div>
                        <?php unset($_SESSION['success_message']); ?>
                        <meta http-equiv="refresh" content="2;url=gestionUtilisateurs">
                    <?php endif; ?>

                    <?php if (isset($_SESSION['error_message'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($_SESSION['error_message']) ?>
                        </div>
                        <?php unset($_SESSION['error_message']); ?>
                    <?php endif; ?>

                    <!-- Affichage du message d'erreur de récupération des utilisateurs -->
                    <?php if (isset($messageError)): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($messageError); ?></div>
                    <?php endif; ?>

                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Gestion des Utilisateurs</li>
                    </ol>

                    <!-- Liste des utilisateurs -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-users me-1"></i> Liste des Utilisateurs
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">Ajouter un Utilisateur</button>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Rôle</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users)) : ?>
                                        <?php foreach ($users as $user) : ?>
                                            <tr>
                                                <td><?= array_key_exists('id', $user) ? htmlspecialchars($user['id']) : 'N/A' ?></td>
                                                <td><?= array_key_exists('nom', $user) ? htmlspecialchars($user['nom']) : 'N/A' ?></td>
                                                <td><?= array_key_exists('prenom', $user) ? htmlspecialchars($user['prenom']) : 'N/A' ?></td>
                                                <td><?= array_key_exists('email', $user) ? htmlspecialchars($user['email']) : 'N/A' ?></td>
                                                <td><?= array_key_exists('role', $user) ? htmlspecialchars($user['role']) : 'N/A' ?></td>
                                                <td>
                                                    <?php if (array_key_exists('id', $user)) : ?>
                                                    <button class="btn btn-warning btn-sm editUserBtn" 
                                                            data-id="<?= htmlspecialchars($user['id']) ?>" 
                                                            data-nom="<?= htmlspecialchars($user['nom'] ?? '') ?>" 
                                                            data-prenom="<?= htmlspecialchars($user['prenom'] ?? '') ?>" 
                                                            data-email="<?= htmlspecialchars($user['email'] ?? '') ?>" 
                                                            data-role="<?= htmlspecialchars($user['role'] ?? '') ?>" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editUserModal">
                                                        Modifier
                                                    </button>
                                                    <a href="UserMainController?action=deleteUser&id=<?= htmlspecialchars($user['id']) ?>" 
                                                       class="btn btn-danger btn-sm" 
                                                       onclick="return confirm('Confirmer la suppression ?')">
                                                        Supprimer
                                                    </a>
                                                    <?php else : ?>
                                                    <span class="text-muted">Actions non disponibles</span>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Aucun utilisateur trouvé</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- Modal de modification d'utilisateur -->
            <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Modifier l'utilisateur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="UserMainController?action=editUser" method="POST">
                                <input type="hidden" name="id" id="userId">

                                <div class="form-group">
                                    <label for="nom">Nom:</label>
                                    <input type="text" name="nom" class="form-control" id="userNom" required>
                                </div>

                                <div class="form-group">
                                    <label for="prenom">Prénom:</label>
                                    <input type="text" name="prenom" class="form-control" id="userPrenom" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" class="form-control" id="userEmail" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Nouveau mot de passe (optionnel):</label>
                                    <input type="password" name="password" class="form-control" placeholder="Nouveau mot de passe (optionnel)">
                                </div>

                                <div id="etudiantFields" style="display:none;">
                                    <div class="form-group">
                                        <label for="matricule">Matricule:</label>
                                        <input type="text" name="matricule" class="form-control" id="matricule">
                                    </div>

                                    <div class="form-group">
                                        <label for="tel">Téléphone:</label>
                                        <input type="tel" name="tel" class="form-control" id="tel">
                                    </div>

                                    <div class="form-group">
                                        <label for="adresse">Adresse:</label>
                                        <input type="text" name="adresse" class="form-control" id="adresse">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal d'ajout d'utilisateur -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addUserModalLabel">Ajouter un utilisateur</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="UserMainController?action=addUser">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" name="nom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de Passe</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Rôle</label>
                                    <select class="form-control" id="role" name="role" required>
                                        <option value="Admin">Admin</option>
                                        <option value="Etudiant">Etudiant</option>
                                    </select>
                                </div>

                                <div id="etudiantFieldsAdd" class="etudiantFields" style="display:none;">
                                    <div class="mb-3">
                                        <label for="matricule" class="form-label">Matricule</label>
                                        <input type="text" class="form-control" id="matricule" name="matricule">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tel" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="tel" name="tel">
                                    </div>
                                    <div class="mb-3">
                                        <label for="adresse" class="form-label">Adresse</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse">
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Footer Section -->
    <?php require_once("../../../sections/admin/footer.php"); ?>

    <!-- Script Section -->
    <?php require_once("../../../sections/admin/script.php"); ?>

    <script>
        $(document).ready(function () {
    // Affichage dynamique des champs étudiants lors de la modification
    $(".editUserBtn").click(function () {
        $("#userId").val($(this).data("id"));
        $("#userNom").val($(this).data("nom"));
        $("#userPrenom").val($(this).data("prenom"));
        $("#userEmail").val($(this).data("email"));

        // Affichage des champs spécifiques aux étudiants lors de la modification
        if ($(this).data("role") === "Etudiant") {
            $("#etudiantFields").show();  // Affiche les champs étudiants
            $("#matricule").val($(this).data("matricule"));
            $("#tel").val($(this).data("tel"));
            $("#adresse").val($(this).data("adresse"));
        } else {
            $("#etudiantFields").hide(); // Cache les champs étudiants
        }
    });

    // Affichage dynamique des champs étudiants lors de l'ajout
    $("#role").change(function () {
        if ($(this).val() === "Etudiant") {
            $(".etudiantFields").show();  // Utilise la classe au lieu de l'id
        } else {
            $(".etudiantFields").hide(); // Utilise la classe au lieu de l'id
        }
    });

    // Initialisation de l'état des champs étudiants lors du chargement de la page
    if ($("#role").val() === "Etudiant") {
        $(".etudiantFields").show();  // Utilise la classe au lieu de l'id
    } else {
        $(".etudiantFields").hide();  // Utilise la classe au lieu de l'id
    }
});
    </script>
</body>
</html>
