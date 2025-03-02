<?php

class UserMainController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['formLogin'])) {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if ($email === "test@test.com" && $password === "password123") {
                $_SESSION['user'] = [
                    'email' => $email,
                    'isConnected' => true
                ];
                header('Location: admin');
                exit;
            } else {
                header('Location: login&error=1&message=Identifiants incorrects');
                exit;
            }
        }
        
        require_once 'view/sections/login/form.php';
    }
} 