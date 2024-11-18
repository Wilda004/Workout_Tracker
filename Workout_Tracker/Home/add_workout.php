<?php
// Menghubungkan dengan database
require_once '../../App/Config/Database.php';

// Mengecek apakah data dikirim dengan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $workout_name = $_POST['workout_name'];
    $duration = $_POST['duration'];

    // Validasi input
    if (empty($user_id) || empty($workout_name) || empty($duration)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Buat koneksi database
    $database = new Database();
    $db = $database->getConnection();

    try {
        // Simpan workout ke database
        $query = "INSERT INTO workouts (user_id, workout_name, duration) VALUES (:user_id, :workout_name, :duration)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':workout_name', $workout_name);
        $stmt->bindParam(':duration', $duration);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Workout added successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add workout.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
