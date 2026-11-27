<?php
// File: daftar.php
// Halaman Pendaftaran Peserta PERISAI

require_once 'includes/config.php';

$message = '';
$message_type = '';

// Jika koneksi database gagal, tampilkan pesan error yang jelas
if (!empty($db_connection_error)) {
    $message = "Maaf, sistem sedang mengalami gangguan koneksi database. Silakan coba lagi nanti.";
    $message_type = "error";
}

// Handle form submission
if (empty($db_connection_error) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = clean_input($_POST['nama']);
    $email = clean_input($_POST['email']);
    $no_hp = clean_input($_POST['no_hp']);
    $alamat = clean_input($_POST['alamat']);
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    
    // Validation
    if (empty($nama) || empty($email) || empty($no_hp) || empty($password)) {
        $message = "Semua field wajib diisi!";
        $message_type = "error";
    } elseif (!validate_email($email)) {
        $message = "Format email tidak valid!";
        $message_type = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password minimal 6 karakter!";
        $message_type = "error";
    } elseif ($password !== $password_confirm) {
        $message = "Konfirmasi password tidak cocok!";
        $message_type = "error";
    } else {
        // Cek apakah email sudah terdaftar
        $cek = mysqli_prepare($conn, "SELECT id FROM pendaftaran WHERE email = ?");
        mysqli_stmt_bind_param($cek, "s", $email);
        mysqli_stmt_execute($cek);
        mysqli_stmt_store_result($cek);
        
        if (mysqli_stmt_num_rows($cek) > 0) {
            $message = "Email ini sudah terdaftar. Silakan login.";
            $message_type = "error";
            mysqli_stmt_close($cek);
        } else {
            mysqli_stmt_close($cek);
            
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            
            // Insert to database
            $sql = "INSERT INTO pendaftaran (nama, email, password, no_hp, alamat) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssss", $nama, $email, $password_hash, $no_hp, $alamat);
                
                if (mysqli_stmt_execute($stmt)) {
                    $message = "Pendaftaran berhasil! Silakan login untuk mengecek status pendaftaran Anda.";
                    $message_type = "success";
                } else {
                    $message = "Terjadi kesalahan. Silakan coba lagi.";
                    $message_type = "error";
                }
                
                mysqli_stmt_close($stmt);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - PERISAI</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .registration-container {
            max-width: 800px;
            margin: 4rem auto;
            padding: 0 2rem;
        }
        
        .registration-card {
            background: white;
            padding: 3rem;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        
        .registration-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .registration-header h1 {
            color: #1565c0;
            margin-bottom: 0.5rem;
        }
        
        .registration-header p {
            color: #666;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-group-full {
            grid-column: 1 / -1;
        }
        
        .back-link {
            display: inline-block;
            margin-bottom: 2rem;
            color: #1565c0;
            text-decoration: none;
        }
        
        .back-link:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo-container">
                <img src="images/logo-bpjs.png" alt="BPJS Ketenagakerjaan" onerror="this.src='https://via.placeholder.com/150x50?text=BPJS'">
                <img src="images/logo-perisai.png" alt="PERISAI" onerror="this.src='https://via.placeholder.com/150x50?text=PERISAI'">
            </div>
            <ul class="nav-menu">
                <li><a href="index.php">Kembali ke Beranda</a></li>
            </ul>
        </nav>
    </header>

    <div class="registration-container">
        <a href="index.php" class="back-link">← Kembali ke Beranda</a>
        
        <div class="registration-card">
            <div class="registration-header">
                <h1>Formulir Pendaftaran PERISAI</h1>
                <p>Isi formulir di bawah ini untuk bergabung dengan program PERISAI</p>
            </div>
            
            <?php if ($message): ?>
                <div class="alert alert-<?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nama">Nama Lengkap *</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="no_hp">Nomor HP/WhatsApp *</label>
                        <input type="tel" id="no_hp" name="no_hp" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="pekerjaan">Jenis Pekerjaan</label>
                        <select id="pekerjaan" name="pekerjaan">
                            <option value="">Pilih Jenis Pekerjaan</option>
                            <option value="Ojek Online">Ojek Online</option>
                            <option value="Pedagang">Pedagang</option>
                            <option value="Freelancer">Freelancer</option>
                            <option value="Wirausaha">Wirausaha</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group form-group-full">
                    <label for="alamat">Alamat Lengkap</label>
                    <textarea id="alamat" name="alamat" rows="3"></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <input type="password" id="password" name="password" minlength="6" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirm">Konfirmasi Password *</label>
                        <input type="password" id="password_confirm" name="password_confirm" minlength="6" required>
                    </div>
                </div>
                <p style="color:#666; font-size:0.85rem; margin-top:-1rem; margin-bottom:1.5rem;">
                    Password ini akan digunakan untuk login dan mengecek status pendaftaran Anda.
                </p>
                
                <div class="form-group form-group-full">
                    <label>
                        <input type="checkbox" required>
                        Saya menyetujui syarat dan ketentuan yang berlaku
                    </label>
                </div>
                
                <button type="submit" class="btn-submit">Daftar Sekarang</button>
            </form>
            
            <p style="text-align:center; margin-top:1.5rem;">
                Sudah punya akun? <a href="login.php" style="color:#1565c0;">Login di sini</a>
            </p>
        </div>
    </div>

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 BPJS Ketenagakerjaan - Program PERISAI</p>
        </div>
    </footer>
</body>
</html>
