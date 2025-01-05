<?php
include('db.php');

// Fungsi untuk mengirim email dengan token
function sendResetEmail($email, $token) {
    $subject = "Reset Password";
    $message = "Klik tautan berikut untuk reset password Anda: ";
    $message .= "https://example.com/reset_password.php?token=$token&email=$email";
    $headers = "From: no-reply@example.com"; // Ganti dengan alamat email yang valid
    mail($email, $subject, $message, $headers);
}

// Cek jika ada email yang dikirim (misalnya dari form)
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    
    // Generate token reset password
    $token = bin2hex(random_bytes(16));
    $hashedToken = password_hash($token, PASSWORD_BCRYPT);

    // Simpan token ke database dengan waktu kedaluwarsa
    $stmt = $conn->prepare("INSERT INTO password_resets (email, token, expires_at) VALUES (?, ?, ?)");
    $expiresAt = date("Y-m-d H:i:s", strtotime("+15 minutes"));
    $stmt->bind_param("sss", $email, $hashedToken, $expiresAt);
    $stmt->execute();

    // Kirim email
    sendResetEmail($email, $token);

    echo "Email reset password telah dikirim!";
} else {
    echo "Email tidak ditemukan.";
}
?>
