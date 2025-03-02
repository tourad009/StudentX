<?php
require_once "../../model/StudentRepository.php";

class StudentController {
    private $repository;

    public function __construct() {
        $this->repository = new StudentRepository();
    }

    public function listStudents() {
        return $this->repository->getAllStudents();
    }

    public function getStudentById($id) {
        return $this->repository->getStudentById($id);
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
