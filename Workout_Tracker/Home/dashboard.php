<?php
// Menghubungkan dengan database
require_once 'C:/xampp/htdocs/Workout_Tracker/App/Config/Database.php';



// Mengecek apakah pengguna sudah login
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil informasi pengguna
$user_id = $_SESSION['user_id'];
$database = new Database();
$db = $database->getConnection();

// Ambil nama pengguna
$query = "SELECT name FROM users WHERE id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil workout yang sudah ditambahkan oleh pengguna
$query = " SELECT w.workout_name, w.duration FROM user_workouts uw JOIN workouts w ON uw.workout_id = w.id WHERE uw.user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/../Workout_Tracker/assets/css/styles.css">
</head> 
<body>

<!-- Navbar -->
<?php include '../include/header.php'; ?>

<!-- Dashboard Content -->
<main>
    <!-- Pesan Hello World -->
    <!-- <h1>Hello Fit Fam !!!</h1> Ini adalah tempat kamu menampilkan pesan "Hello World" -->

    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    
    <!-- Workouts Section -->
    <section id="workouts">
        <h2>Workouts</h2>
        <p>Here are some exercises to get you started:</p>
        <div class="workout-list">
            <div class="workout-item">
                <h3>Push Ups</h3>
                <p>Duration: 15 mins</p>
                <button onclick="addWorkout('Push Ups', 15)">Add to Routine</button>
            </div>
            <div class="workout-item">
                <h3>Squats</h3>
                <p>Duration: 20 mins</p>
                <button onclick="addWorkout('Squats', 20)">Add to Routine</button>
            </div>
            <div class="workout-item">
                <h3>Sit Ups</h3>
                <p>Duration: 15 mins</p>
                <button onclick="addWorkout('Sit Ups', 15)">Add to Routine</button>
            </div>
        </div>
    </section>

    <!-- User's Workouts -->
    <section id="userWorkouts">
        <h2>Your Routine</h2>
        <p>Here are the workouts you've added:</p>
        <?php if (empty($workouts)) : ?>
            <p>No workouts added yet.</p>
        <?php else : ?>
            <ul>
                <?php foreach ($workouts as $workout) : ?>
                    <li><?php echo htmlspecialchars($workout['workout_name']); ?> - <?php echo $workout['duration']; ?> mins</li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </section>
</main>

<!-- Footer -->
<?php include '../include/footer.html'; ?>


<script src="../assets/js/script.js"></script>
</body>
</html>
