<?php
require_once("model/DBRepository.php");

class TestConnection extends DBRepository {
    public function testConnection() {
        try {
            // Tenter une requête simple
            $stmt = $this->db->query("SELECT 1");
            return "Connexion réussie à la base de données!";
        } catch (PDOException $e) {
            return "Erreur de connexion: " . $e->getMessage();
        }
    }
    
    public function showTableStructure($tableName) {
        try {
            $stmt = $this->db->query("DESCRIBE $tableName");
            $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $columns;
        } catch (PDOException $e) {
            return "Erreur lors de la récupération de la structure de la table: " . $e->getMessage();
        }
    }
    
    public function showSampleData($tableName, $limit = 5) {
        try {
            $stmt = $this->db->query("SELECT * FROM $tableName LIMIT $limit");
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            return "Erreur lors de la récupération des données: " . $e->getMessage();
        }
    }
}

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Tester la connexion
$test = new TestConnection();
$connectionResult = $test->testConnection();

// Tables à vérifier
$tables = ['users', 'admins', 'etudiants'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de connexion à la base de données</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1, h2, h3 { color: #333; }
        .success { color: green; }
        .error { color: red; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        pre { background-color: #f5f5f5; padding: 10px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>Test de connexion à la base de données</h1>
    
    <h2>Résultat de la connexion</h2>
    <p class="<?= strpos($connectionResult, 'réussie') !== false ? 'success' : 'error' ?>">
        <?= htmlspecialchars($connectionResult) ?>
    </p>
    
    <?php if (strpos($connectionResult, 'réussie') !== false): ?>
        <?php foreach ($tables as $table): ?>
            <h2>Structure de la table <?= htmlspecialchars($table) ?></h2>
            <?php 
            $structure = $test->showTableStructure($table);
            if (is_array($structure)): 
            ?>
                <table>
                    <thead>
                        <tr>
                            <th>Champ</th>
                            <th>Type</th>
                            <th>Null</th>
                            <th>Clé</th>
                            <th>Défaut</th>
                            <th>Extra</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($structure as $column): ?>
                            <tr>
                                <td><?= htmlspecialchars($column['Field']) ?></td>
                                <td><?= htmlspecialchars($column['Type']) ?></td>
                                <td><?= htmlspecialchars($column['Null']) ?></td>
                                <td><?= htmlspecialchars($column['Key']) ?></td>
                                <td><?= htmlspecialchars($column['Default'] ?? 'NULL') ?></td>
                                <td><?= htmlspecialchars($column['Extra']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <h3>Exemple de données dans <?= htmlspecialchars($table) ?></h3>
                <?php 
                $data = $test->showSampleData($table);
                if (is_array($data) && !empty($data)): 
                ?>
                    <table>
                        <thead>
                            <tr>
                                <?php foreach (array_keys($data[0]) as $key): ?>
                                    <th><?= htmlspecialchars($key) ?></th>
                                <?php endforeach; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $row): ?>
                                <tr>
                                    <?php foreach ($row as $value): ?>
                                        <td><?= htmlspecialchars($value ?? 'NULL') ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucune donnée trouvée ou erreur: <?= is_string($data) ? htmlspecialchars($data) : 'Table vide' ?></p>
                <?php endif; ?>
            <?php else: ?>
                <p class="error"><?= htmlspecialchars($structure) ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <p><a href="gestionUtilisateurs">Retour à la gestion des utilisateurs</a></p>
</body>
</html> 