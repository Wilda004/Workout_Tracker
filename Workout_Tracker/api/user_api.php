<?php
header("Content-Type: application/json");

// Include the database configuration
require '../App/Config/Database.php';

// Create an instance of the Database class and get the connection
$database = new Database();
$conn = $database->getConnection();

// Menangani request GET
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    try {
        // Cek apakah parameter id ada
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']); // Validasi ID sebagai angka
            $sql = "SELECT id, name, email FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        } else {
            $sql = "SELECT id, name, email FROM users";
            $stmt = $conn->prepare($sql);
        }

        $stmt->execute();

        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            "status" => "success",
            "data" => $users
        ]);
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request POST (Create)
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['name'], $data['email'], $data['password'])) {
            $name = $data['name'];
            $email = $data['email'];
            $password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash password untuk keamanan

            // Query untuk menyimpan user baru
            $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil ditambahkan"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menambahkan user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request PUT (Update)
elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['id'], $data['name'], $data['email'])) {
            $id = intval($data['id']);
            $name = $data['name'];
            $email = $data['email'];

            // Query untuk update data user
            $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil diperbarui"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal memperbarui user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}

// Menangani request DELETE
elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    try {
        // Ambil data dari body request
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi data
        if (isset($data['id'])) {
            $id = intval($data['id']);

            // Query untuk menghapus user
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode([
                    "status" => "success",
                    "message" => "User berhasil dihapus"
                ]);
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "Gagal menghapus user"
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Data tidak lengkap"
            ]);
        }
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage()
        ]);
    }
}
?>
