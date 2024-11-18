<header>
    <nav>
        <div class="logo">Workout Tracker</div>
        <ul class="nav-links">
            <li><a href="#home">Home</a></li>
            <li><a href="#workouts">Workouts</a></li>
            <li><a href="#faq">FAQ</a></li>
            <li><a href="#testimonials">Testimonials</a></li>
            <li><a href="#gallery">Gallery</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>

        <div class="auth-links">
            <?php if (isset($_SESSION['user_id'])): ?>
                <!-- Jika pengguna sudah login, tampilkan tombol logout -->
                <button onclick="logout()">Logout</button>
            <?php else: ?>
                <!-- Jika pengguna belum login, tampilkan tombol login dan signup -->
                <button onclick="showLoginContainer()">Login</button>
                <button onclick="showSignupContainer()">Sign Up</button>
            <?php endif; ?>
        </div>
    </nav>
</header>
