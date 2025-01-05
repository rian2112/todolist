<?php
$servername = "localhost";
$username = "root";  // Sesuaikan dengan username MySQL Anda
$password = "";      // Sesuaikan dengan password MySQL Anda (jika ada)
$dbname = "uastest";    // Nama database yang telah dibuat

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
