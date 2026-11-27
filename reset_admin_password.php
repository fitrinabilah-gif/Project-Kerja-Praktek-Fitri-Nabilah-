<?php
// File: reset_admin_password.php
// SKRIP SEKALI PAKAI - HAPUS FILE INI SETELAH DIGUNAKAN!
// Fungsinya: generate ulang hash password admin agar pasti cocok dengan 'admin123'

require_once 'includes/config.php';

if (!empty($db_connection_error)) {
    die("Koneksi database gagal: " . htmlspecialchars($db_connection_error));
}

$new_password = 'admin123';
$new_hash = password_hash($new_password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare($conn, "UPDATE admin SET password = ? WHERE username = 'admin'");
mysqli_stmt_bind_param($stmt, "s", $new_hash);

if (mysqli_stmt_execute($stmt)) {
    $affected = mysqli_stmt_affected_rows($stmt);
    echo "<h2>Berhasil!</h2>";
    if ($affected > 0) {
        echo "<p>Password admin berhasil di-reset.</p>";
    } else {
        echo "<p>Tidak ada baris yang terupdate. Kemungkinan username 'admin' tidak ditemukan di tabel admin.</p>";
    }
    echo "<p><strong>Username:</strong> admin<br><strong>Password:</strong> admin123</p>";
    echo "<p style='color:red; font-weight:bold;'>PENTING: Hapus file reset_admin_password.php ini sekarang juga dari server untuk alasan keamanan!</p>";
    echo "<p><a href='admin/login.php'>Coba Login Admin Sekarang &raquo;</a></p>";
} else {
    echo "<h2>Gagal</h2><p>" . htmlspecialchars(mysqli_error($conn)) . "</p>";
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
