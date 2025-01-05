<?php
include('db.php');

// Simpan pengguna dengan password terenkripsi
$username = 'user1';
$password = 'password123'; // Ganti dengan password yang diinginkan
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

$stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);
$stmt->execute();

echo "Pengguna berhasil ditambahkan!";
?>
