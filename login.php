<?php
// File: login.php
// Halaman Login Peserta (User) PERISAI

session_start();
require_once 'includes/config.php';

// Kalau sudah login, langsung arahkan ke dashboard user
if (isset($_SESSION['user_logged_in'])) {
    header('Location: user-dashboard.php');
    exit;
}

$error = '';

if (!empty($db_connection_error)) {
    $error = "Sistem sedang mengalami gangguan koneksi database. Silakan coba lagi nanti.";
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = clean_input($_POST['email']);
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Email dan password wajib diisi!";
    } else {
        $sql = "SELECT * FROM pendaftaran WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_nama'] = $user['nama'];
                $_SESSION['user_email'] = $user['email'];

                header('Location: user-dashboard.php');
                exit;
            } else {
                $error = "Email atau password salah!";
            }
        } else {
            $error = "Email atau password salah!";
        }

        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Peserta - PERISAI</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --biru: #1565c0;
            --biru-tua: #0d3d73;
            --hijau: #2e7d32;
            --hijau-muda: #4caf50;
            --tinta: #12233b;
            --abu: #6b7a90;
            --krem: #f4f8fb;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: var(--tinta);
            min-height: 100vh;
        }

        .layar {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 1fr;
        }

        /* ---------- Panel kiri: sapaan ---------- */
        .panel-sapaan {
            position: relative;
            background: linear-gradient(160deg, var(--biru) 0%, var(--biru-tua) 62%, var(--hijau) 130%);
            color: white;
            padding: 3.5rem 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .panel-sapaan::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle, rgba(255,255,255,0.14) 1.5px, transparent 1.5px);
            background-size: 26px 26px;
            opacity: 0.5;
            pointer-events: none;
        }

        .brand-mini {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
            letter-spacing: 0.01em;
            position: relative;
            z-index: 1;
        }
        .brand-mini .dot { width: 9px; height: 9px; border-radius: 50%; background: #ffd166; }

        .sapaan-utama {
            position: relative;
            z-index: 1;
            max-width: 26rem;
        }

        .sapaan-utama h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: clamp(2rem, 3.4vw, 2.7rem);
            line-height: 1.15;
            margin-bottom: 1rem;
        }

        .sapaan-utama p {
            font-size: 1.02rem;
            line-height: 1.6;
            color: rgba(255,255,255,0.86);
        }

        .kartu-manfaat {
            position: relative;
            z-index: 1;
            display: flex;
            gap: 1.5rem;
            margin-top: 2.5rem;
        }
        .kartu-manfaat div { flex: 1; }
        .kartu-manfaat strong {
            display: block;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.4rem;
            font-weight: 800;
        }
        .kartu-manfaat span {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.75);
        }

        .figur-pekerja {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.85rem;
            color: rgba(255,255,255,0.7);
        }

        /* ---------- Panel kanan: form ---------- */
        .panel-form {
            background: var(--krem);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem;
        }

        .kartu-form {
            width: 100%;
            max-width: 22rem;
        }

        .kartu-form h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            margin-bottom: 0.35rem;
        }

        .kartu-form .sub {
            color: var(--abu);
            font-size: 0.92rem;
            margin-bottom: 1.8rem;
        }

        .peringatan {
            background: #fdecea;
            border: 1px solid #f3b8b3;
            color: #a12b22;
            font-size: 0.88rem;
            padding: 0.8rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .field { margin-bottom: 1.3rem; }
        .field label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 0.45rem;
            color: var(--tinta);
        }
        .field input {
            width: 100%;
            padding: 0.75rem 0.9rem;
            border: 1.5px solid #dbe4ee;
            border-radius: 8px;
            font-size: 0.96rem;
            font-family: inherit;
            background: white;
            transition: border-color 0.15s;
        }
        .field input:focus {
            outline: none;
            border-color: var(--biru);
        }

        .tombol-masuk {
            width: 100%;
            padding: 0.85rem;
            background: var(--biru);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.98rem;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.15s;
            margin-top: 0.4rem;
        }
        .tombol-masuk:hover { background: var(--biru-tua); }
        .tombol-masuk:focus-visible { outline: 2px solid var(--hijau); outline-offset: 2px; }

        .tautan-daftar {
            text-align: center;
            font-size: 0.9rem;
            color: var(--abu);
            margin-top: 1.6rem;
        }
        .tautan-daftar a { color: var(--biru); font-weight: 600; text-decoration: none; }
        .tautan-daftar a:hover { text-decoration: underline; }

        .tautan-beranda {
            text-align: center;
            margin-top: 1.1rem;
        }
        .tautan-beranda a {
            color: var(--abu);
            font-size: 0.85rem;
            text-decoration: none;
        }
        .tautan-beranda a:hover { color: var(--biru); }

        @media (prefers-reduced-motion: no-preference) {
            .kartu-form { animation: masuk 0.45s ease; }
            @keyframes masuk {
                from { opacity: 0; transform: translateY(8px); }
                to { opacity: 1; transform: translateY(0); }
            }
        }

        @media (max-width: 900px) {
            .layar { grid-template-columns: 1fr; }
            .panel-sapaan { padding: 2.2rem 1.8rem; }
            .kartu-manfaat { display: none; }
            .panel-form { padding: 2.2rem 1.5rem 3rem; }
        }
    </style>
</head>
<body>
    <div class="layar">
        <div class="panel-sapaan">
            <div class="brand-mini"><span class="dot"></span>PERISAI</div>

            <div class="sapaan-utama">
                <h1>Selamat datang kembali</h1>
                <p>Masuk untuk memantau status pendaftaran BPJS Ketenagakerjaan Anda, kapan saja, dari mana saja.</p>

                <div class="kartu-manfaat">
                    <div>
                        <strong>1 Akun</strong>
                        <span>Data pendaftaran Anda tersimpan aman</span>
                    </div>
                    <div>
                        <strong>Real-time</strong>
                        <span>Status diperbarui langsung oleh admin</span>
                    </div>
                </div>
            </div>

            <div class="figur-pekerja">Untuk ojek online, pedagang, dan pekerja mandiri lainnya</div>
        </div>

        <div class="panel-form">
            <div class="kartu-form">
                <h2>Login Peserta</h2>
                <p class="sub">Masukkan email dan password akun PERISAI Anda</p>

                <?php if ($error): ?>
                    <div class="peringatan"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="field">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required autofocus>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>

                    <button type="submit" class="tombol-masuk">Masuk</button>
                </form>

                <div class="tautan-daftar">
                    Belum punya akun? <a href="daftar.php">Daftar sekarang</a>
                </div>

                <div class="tautan-beranda">
                    <a href="index.php">← Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
