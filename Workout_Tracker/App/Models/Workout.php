<?php

require_once __DIR__ . '/../Config/Database.php';

class Workout {
    private $conn;
    private $table = "workouts";

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Mendapatkan semua workout
    public function findAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menambahkan workout baru
    public function create($data) {
        $query = "INSERT INTO " . $this->table . " (name, duration) VALUES (:name, :duration)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':duration', $data['duration']);

        return $stmt->execute();
    }

    // Memperbarui workout
    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " SET name = :name, duration = :duration WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':duration', $data['duration']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Menghapus workout
    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}
