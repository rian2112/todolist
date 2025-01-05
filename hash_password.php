<?php
include('db.php');
$password = "user_password"; // Password asli
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Verifikasi password
$inputPassword = "user_password";
if (password_verify($inputPassword, $hashedPassword)) {
    echo "Password valid!";
} else {
    echo "Password tidak valid!";
}
?>
