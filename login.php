<?php
include('db.php');
session_start();

// Inisialisasi percobaan login
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

// Cek apakah data username dan password ada
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Jika percobaan login kurang dari 5
    if ($_SESSION['login_attempts'] < 5) {
        // Menyiapkan query untuk memeriksa username di database
        $stmt = $conn->prepare("SELECT password FROM users WHERE username=?");
        $stmt->bind_param("s", $username); // Bind parameter
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Mengecek apakah password yang dimasukkan cocok
        if ($row && password_verify($password, $row['password'])) {
            echo "Login berhasil!";
            $_SESSION['login_attempts'] = 0;  // Reset login attempts
        } else {
            $_SESSION['login_attempts']++;  // Increment login attempts
            echo "Login gagal! Percobaan ke-".$_SESSION['login_attempts'];
        }
    } else {
        echo "Akun terkunci sementara, coba lagi dalam 10 menit.";
        // Tambahkan logika untuk implementasi lockout dengan waktu
    }
} else {
    echo "Mohon masukkan username dan password.";
}
?>
