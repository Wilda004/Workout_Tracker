<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Traits/ResponseTrait.php';

class AuthController {
    use ResponseTrait;

    // Login method
    public function login($email, $password) {
        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            return $this->respondSuccess("Login successful", [
                "user_id" => $user['id'],
                "name" => $user['name'],
            ]);
        }

        return $this->respondError("Invalid email or password");
    }

    // Signup method
    public function signup($name, $email, $password) {
        $userModel = new User();
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if ($userModel->create($name, $email, $hashedPassword)) {
            return $this->respondSuccess("User registered successfully");
        }

        return $this->respondError("Failed to register user");
    }
}
