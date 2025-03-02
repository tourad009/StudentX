<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/StudentX/model/StudentRepository.php";

class StudentController {
    private $repository;

    public function __construct() {
        $this->repository = new StudentRepository();
    }

    public function listStudents() {
        try {
            return $this->repository->getAllStudents();
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération des étudiants: " . $e->getMessage());
            return [];
        }
    }

    public function getStudentById($id) {
        try {
            return $this->repository->getStudentById($id);
        } catch (Exception $e) {
            error_log("Erreur lors de la récupération de l'étudiant: " . $e->getMessage());
            return null;
        }
    }

    public function addStudent($nom, $email, $password, $matricule, $tel, $adresse) {
        return $this->repository->addStudent($nom, $email, $password, $matricule, $tel, $adresse);
    }

    public function updateStudent($id, $nom, $email, $matricule, $tel, $adresse) {
        return $this->repository->updateStudent($id, $nom, $email, $matricule, $tel, $adresse);
    }

    public function deleteStudent($id) {
        return $this->repository->deleteStudent($id);
    }

    public function activateStudent($id) {
        return $this->repository->activateStudent($id);
    }

    public function deactivateStudent($id) {
        return $this->repository->deactivateStudent($id);
    }
}
?>
