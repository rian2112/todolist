<?php
include('db.php');

// Verifikasi token saat pengguna mencoba reset password
$inputToken = $_GET['token'];
$email = $_GET['email']; // Token dihubungkan dengan email

// Menyiapkan query dengan prepared statement untuk mencegah SQL Injection
$stmt = $conn->prepare("SELECT token, expires_at FROM password_resets WHERE email=?");
$stmt->bind_param("s", $email); // Bind parameter email
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Memeriksa apakah token valid dan belum kadaluarsa
if ($row && strtotime($row['expires_at']) > time() && password_verify($inputToken, $row['token'])) {
    echo "Token valid, pengguna dapat mengganti password.";
    // Tampilkan form untuk mengganti password
} else {
    echo "Token tidak valid atau telah kadaluarsa.";
}
?>
