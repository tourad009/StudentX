<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/model/EvaluationRepository.php";

class EvaluationController {
    private $repository;

    public function __construct() {
        $this->repository = new EvaluationRepository();
    }

    public function getAllEvaluations() {
        try {
            return $this->repository->getAll();
        } catch (Exception $e) {
            error_log("Erreur dans getAllEvaluations: " . $e->getMessage());
            return [];
        }
    }

    public function addEvaluation($nom, $semestre, $type) {
        try {
            return $this->repository->add($nom, $semestre, $type);
        } catch (Exception $e) {
            error_log("Erreur dans addEvaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function updateEvaluation($id, $nom, $semestre, $type) {
        try {
            return $this->repository->update($id, $nom, $semestre, $type);
        } catch (Exception $e) {
            error_log("Erreur dans updateEvaluation: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteEvaluation($id) {
        try {
            return $this->repository->delete($id);
        } catch (Exception $e) {
            error_log("Erreur dans deleteEvaluation: " . $e->getMessage());
            throw $e;
        }
    }
}
?>
