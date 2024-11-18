<?php

// Autoload file autoloading jika diperlukan (optional jika Anda menggunakan Composer atau semacamnya)
// require_once 'vendor/autoload.php'; 

// Menangani request API dan memanggil routing
require_once __DIR__ . '/Routes/Api.php';

// Jika endpoint tidak dikenali, kembalikan 404
http_response_code(404);
echo json_encode(["status" => "error", "message" => "Endpoint not found"]);
?>
