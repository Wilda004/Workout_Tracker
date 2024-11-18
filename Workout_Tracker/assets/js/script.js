// Mengatur navbar transparan saat scroll ke bawah dan solid saat scroll ke atas

console.log("dash test");


window.onscroll = function() {
    var navbar = document.querySelector("header");
    var scrollPosition = window.scrollY;
  
    if (scrollPosition > 50) {
        navbar.style.backgroundColor = "rgba(51, 51, 51, 0.8)";  // Transparan
    } else {
        navbar.style.backgroundColor = "rgba(51, 51, 51, 1)";    // Solid
    }
  };
  
  // Function untuk menambahkan workout ke rutinitas
  function addWorkout(name, duration) {
    alert(`Workout "${name}" untuk ${duration} menit ditambahkan ke rutinitas Anda!`);
  }


  
  // Menampilkan container login
  function showLoginContainer() {
    document.getElementById("authContainer").style.display = "flex";
    document.getElementById("loginBox").style.display = "block";
    document.getElementById("signupBox").style.display = "none";
  }
  
  // Menampilkan container sign-up
  function showSignupContainer() {
    document.getElementById("authContainer").style.display = "flex";
    document.getElementById("signupBox").style.display = "block";
    document.getElementById("loginBox").style.display = "none";
  }
  
  // Menutup container login/sign-up
  function closeAuthContainer() {
    document.getElementById("authContainer").style.display = "none";
  }
  

  // ! Fungsi untuk menambahkan workout ke rutinitas pengguna
  function addWorkout(workoutName, duration) {
    const user_id = sessionStorage.getItem("user_id"); // Ambil user_id dari sessionStorage
    
    fetch('../../Workout_Tracker/Home/add_workout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
            user_id: user_id,
            workout_name: workoutName,
            duration: duration
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Workout added to your routine!');
            window.location.reload(); // Reload halaman untuk menampilkan data terbaru
        } else {
            alert('Failed to add workout.');
        }
    })
    .catch(error => console.error('Error:', error));
}


  // todo : handle login
// Handle Login Form Submission dengan AJAX
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault(); // Mencegah form submit biasa
    
    const email = document.getElementById("loginEmail").value;
    const password = document.getElementById("loginPassword").value;

    // Kirim data login ke API backend menggunakan fetch
    fetch('http://localhost/Workout_Tracker/api/login/login.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams({
            email: email,
            password: password
        })
    })
    .then(response => response.json()) // Mengonversi respons menjadi JSON
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            // Menyembunyikan login/signup button, dan menampilkan user icon
            // document.querySelector(".auth-links").style.display = "none";
            // document.querySelector(".nav-links").innerHTML += `
            //     <li><a href="#profile"><i class="person-icon"></i> ${data.user_name}</a></li>
            //     <li><a href="#" onclick="logout()">Logout</a></li>
            // `;

            console.log("login berhasil");
            
            closeAuthContainer(); // Menutup form login setelah sukses
  
            // Pengalihan ke halaman dashboard
            
            window.location.href = "./Home/dashboard.php"; // Sesuaikan path sesuai dengan struktur folder
        } else {
            alert(data.message); // Tampilkan pesan error jika login gagal
        }
    })
    .catch(error => console.error('Error:', error));
  });
  
  // Todo : Handle signup
  // Handle Signup Form Submission dengan AJAX
  document.getElementById("signupForm").addEventListener("submit", function (e) {
    e.preventDefault();  // Mencegah form submit biasa
    
    const name = document.getElementById("signupName").value;
    const email = document.getElementById("signupEmail").value;
    const password = document.getElementById("signupPassword").value;

    fetch('http://localhost/Workout_Tracker/api/signup/signup.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',  // Pastikan konten tipe sesuai
        },
        body: new URLSearchParams({
            name: name,
            email: email,
            password: password
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert(data.message);
            // Tampilkan form login setelah signup berhasil
            showLoginContainer(); 
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
  
  // Todo : Logout
  // Fungsi logout
  function logout() {
    // Reset atau hapus session pengguna jika ada
    alert('Logged out');
    console.log("logout berhasil");
    
    window.location.href = '../home/logout.php';
    
  }
