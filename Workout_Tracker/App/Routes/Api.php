<?php

require_once __DIR__ . '/../Controller/AuthController.php';
require_once __DIR__ . '/../Controller/WorkoutController.php';

$authController = new AuthController();
$workoutController = new WorkoutController();

// Routing untuk Authentication (Login/Signup)
if ($_SERVER['REQUEST_URI'] === '/api/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $authController->login($_POST['email'], $_POST['password']);
} elseif ($_SERVER['REQUEST_URI'] === '/api/signup' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $authController->signup($_POST['name'], $_POST['email'], $_POST['password']);
}

// Routing untuk Workouts
if ($_SERVER['REQUEST_URI'] === '/api/workouts' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    echo $workoutController->getAllWorkouts();
} elseif ($_SERVER['REQUEST_URI'] === '/api/workouts' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $workoutController->addWorkout($data);
} elseif (preg_match('/\/api\/workouts\/(\d+)/', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $id = $matches[1];
    $data = json_decode(file_get_contents("php://input"), true);
    echo $workoutController->updateWorkout($id, $data);
} elseif (preg_match('/\/api\/workouts\/(\d+)/', $_SERVER['REQUEST_URI'], $matches) && $_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $matches[1];
    echo $workoutController->deleteWorkout($id);
}
