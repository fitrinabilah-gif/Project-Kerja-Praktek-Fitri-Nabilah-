<?php
// File: user-dashboard.php
// Halaman sederhana untuk peserta setelah login

session_start();
require_once 'includes/config.php';

// Proteksi halaman: harus login dulu
if (!isset($_SESSION['user_logged_in'])) {
    header('Location: login.php');
    exit;
}

$data = null;
if (empty($db_connection_error)) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM pendaftaran WHERE id = ?");
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
}

$status_label = [
    'menunggu'  => ['text' => 'Menunggu Diproses', 'color' => '#f0ad4e'],
    'diproses'  => ['text' => 'Sedang Diproses',   'color' => '#5bc0de'],
    'disetujui' => ['text' => 'Disetujui',         'color' => '#4caf50'],
    'ditolak'   => ['text' => 'Ditolak',           'color' => '#e53935'],
];
$status = $data['status_pendaftaran'] ?? 'menunggu';
$status_info = $status_label[$status] ?? $status_label['menunggu'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peserta - PERISAI</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f9;
            margin: 0;
        }

        .navbar-simple {
            background: white;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }
        .navbar-simple .brand { color: #1565c0; font-weight: bold; font-size: 1.2rem; }
        .navbar-simple a {
            color: #e53935;
            text-decoration: none;
            font-weight: 500;
        }
        .navbar-simple a:hover { text-decoration: underline; }

        .dashboard-container {
            max-width: 700px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        .welcome-card {
            background: white;
            border-radius: 10px;
            padding: 2.5rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .welcome-card h1 { color: #1565c0; margin-bottom: 0.5rem; }
        .welcome-card p { color: #666; }

        .status-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }
        .status-card h2 { color: #333; margin-bottom: 1rem; font-size: 1.1rem; }

        .status-badge {
            display: inline-block;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            color: white;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label { color: #888; }
        .info-value { color: #333; font-weight: 500; }
    </style>
</head>
<body>
    <div class="navbar-simple">
        <span class="brand">PERISAI</span>
        <div>
            <a href="index.php" style="color:#1565c0; margin-right:1.5rem; text-decoration:none;">Beranda</a>
            <a href="logout_user.php">Logout</a>
        </div>
    </div>

    <div class="dashboard-container">
        <div class="welcome-card">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user_nama']); ?>!</h1>
            <p>Ini adalah halaman peserta PERISAI Anda.</p>
        </div>

        <?php if ($data): ?>
        <div class="status-card">
            <h2>Status Pendaftaran Anda</h2>
            <span class="status-badge" style="background: <?php echo $status_info['color']; ?>;">
                <?php echo $status_info['text']; ?>
            </span>

            <div class="info-row">
                <span class="info-label">Nama</span>
                <span class="info-value"><?php echo htmlspecialchars($data['nama']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value"><?php echo htmlspecialchars($data['email']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">No. HP</span>
                <span class="info-value"><?php echo htmlspecialchars($data['no_hp']); ?></span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Daftar</span>
                <span class="info-value"><?php echo htmlspecialchars($data['tanggal_daftar']); ?></span>
            </div>
        </div>
        <?php else: ?>
        <div class="status-card">
            <p>Data pendaftaran tidak ditemukan. Silakan hubungi admin.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
