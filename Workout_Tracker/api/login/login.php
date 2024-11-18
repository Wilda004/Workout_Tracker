<?php
// Mulai session untuk menyimpan data login
session_start();

// Menghubungkan dengan database
require_once '../../App/Config/Database.php';

// Set header untuk JSON response
header('Content-Type: application/json');

// Mengecek apakah form login sudah disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($email) || empty($password)) {
        // Response jika email atau password kosong
        echo json_encode([
            'status' => 'error',
            'message' => 'Email and password are required.'
        ]);
        exit();
    } else {
        // Buat koneksi database
        $database = new Database();
        $db = $database->getConnection();

        try {
            // Query untuk mengecek apakah email ada di database
            $query = "SELECT id, name, email, password FROM users WHERE email = :email";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Jika email ditemukan
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verifikasi password
                if (password_verify($password, $user['password'])) {
                    // Jika password benar, simpan data user ke session
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    
                    // Kirim respons JSON sukses
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Login successful!',
                        'user_name' => $user['name'] // Mengirimkan nama pengguna
                    ]);
                    exit();
                } else {
                    // Password salah
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Invalid password.'
                    ]);
                    exit();
                }
            } else {
                // Email tidak ditemukan
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Email not found.'
                ]);
                exit();
            }
        } catch (Exception $e) {
            // Error database
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage()
            ]);
            exit();
        }
    }
}
?>
