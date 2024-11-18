<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Workout Tracker</title>
  <link rel="stylesheet" href="/../Workout_Tracker/assets/css/styles.css">
</head>

<body>

  <!-- Navbar -->
  <?php include './include/header.php' ?>

  <!-- Main Content -->
  <main>
    <!-- Home Section -->
    <?php include './include/home.html' ?>

    <!-- Workouts Section -->
    <?php include './include/workouts.html' ?>

    <!-- FAQ Section -->
    <?php include './include/faq.html' ?>

    <!-- Testimonials Section -->
    <?php include './include/testimon.html' ?>

    <!-- Gallery Section -->
    <?php include './include/gallery.html' ?>

    <!-- Contact Section -->
    <?php include './include/contact.html' ?>

  </main>
  <!-- Footer -->
  <?php include './include/footer.html' ?>

  <!-- Login / Sign Up Container -->
  <?php include './include/BoxLoginSignUp.html'?>

  <script src="/../Workout_Tracker/assets/js/script.js"></script>
  <!-- <script src="https://apis.google.com/js/api:client.js"></script> -->
</body>

</html>