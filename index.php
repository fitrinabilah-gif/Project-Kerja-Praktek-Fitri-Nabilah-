<?php
// File: index.php
// Halaman Utama Website PERISAI
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PERISAI - Penggerak Jaminan Sosial Indonesia untuk Pekerja Mandiri & Informal">
    <meta name="keywords" content="PERISAI, BPJS Ketenagakerjaan, Pekerja Mandiri, Pekerja Informal, Jaminan Sosial">
    <title>PERISAI - Penggerak Jaminan Sosial Indonesia</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <!-- Header & Navigation -->
    <header>
        <nav class="navbar">
            <div class="logo-container">
                <img src="images/logo-bpjs.png" alt="BPJS Ketenagakerjaan" onerror="this.src='https://via.placeholder.com/150x50?text=BPJS'">
                <img src="images/logo-perisai.png" alt="PERISAI" onerror="this.src='https://via.placeholder.com/150x50?text=PERISAI'">
            </div>
            <ul class="nav-menu">
                <li><a href="#beranda">Beranda</a></li>
                <li><a href="#tentang">Tentang PERISAI</a></li>
                <li><a href="#cara-daftar">Cara Daftar</a></li>
                <li><a href="#manfaat">Manfaat</a></li>
                <li><a href="#kontak">Kontak</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="daftar.php" class="btn-daftar">Daftar Sekarang</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section">
        <div class="clouds">
            <!-- Decorative clouds will be added via CSS -->
        </div>
        <div class="hero-content">
            <div class="hero-text">
                <h1>Selamat Datang di <span style="color: #28a745;">PERISAI</span></h1>
                <p class="hero-subtitle">Penggerak Jaminan Sosial Indonesia</p>
                <p class="hero-description">
                    Perlindungan Kerja untuk Pekerja Mandiri & Informal
                </p>
                <button class="btn-learn-more" onclick="window.location.href='#tentang'">
                    Pelajari Lebih Lanjut
                </button>
            </div>
            <div class="hero-image">
                <img src="images/hero-illustration.png" alt="PERISAI Hero" onerror="this.src='https://via.placeholder.com/600x400?text=Hero+Image'">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="about-section">
        <h2 class="section-title">Apa Itu PERISAI?</h2>
        <div class="about-content">
            <div class="about-text">
                <p class="about-description">
                    PERISAI (Penggerak Jaminan Sosial Indonesia) adalah program inovatif yang membantu pekerja mandiri dan informal untuk bergabung dengan BPJS Ketenagakerjaan.
                </p>
                <p class="about-description">
                    Program ini dirancang khusus untuk memberikan perlindungan sosial yang komprehensif bagi para pekerja yang selama ini belum terjangkau oleh sistem jaminan sosial formal.
                </p>
            </div>
            <div class="about-image">
                <img src="images/about-illustration.png" alt="About PERISAI" onerror="this.src='https://via.placeholder.com/500x300?text=About+Image'">
            </div>
        </div>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="images/icon-education.png" alt="Edukasi" onerror="this.src='https://via.placeholder.com/50?text=📚'">
                </div>
                <h3 class="feature-title">Edukasi & Sosialisasi</h3>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="images/icon-registration.png" alt="Pendaftaran" onerror="this.src='https://via.placeholder.com/50?text=📝'">
                </div>
                <h3 class="feature-title">Pendaftaran Peserta</h3>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <img src="images/icon-claim.png" alt="Klaim" onerror="this.src='https://via.placeholder.com/50?text=📍'">
                </div>
                <h3 class="feature-title">Pendampingan Klaim</h3>
            </div>
        </div>
    </section>

    <!-- Steps Section -->
    <section id="cara-daftar" class="steps-section">
        <h2 class="section-title">Cara Bergabung dengan BPJS Ketenagakerjaan</h2>
        <div class="steps-container">
            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <img src="images/step1-icon.png" alt="Hubungi Agen" onerror="this.src='https://via.placeholder.com/80?text=📱'">
                    </div>
                    <h3 class="step-title">Hubungi Agen PERISAI</h3>
                    <p>Temui atau hubungi agen PERISAI terdekat di wilayah Anda</p>
                    <span class="step-arrow">›</span>
                </div>
                
                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <img src="images/step2-icon.png" alt="Isi Formulir" onerror="this.src='https://via.placeholder.com/80?text=📄'">
                    </div>
                    <h3 class="step-title">Isi Formulir Pendaftaran</h3>
                    <p>Lengkapi formulir dengan data diri yang akurat</p>
                    <span class="step-arrow">›</span>
                </div>
                
                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <img src="images/step3-icon.png" alt="Bayar Iuran" onerror="this.src='https://via.placeholder.com/80?text=💰'">
                    </div>
                    <h3 class="step-title">Bayar Iuran Pertama</h3>
                    <p>Lakukan pembayaran iuran sesuai program yang dipilih</p>
                    <span class="step-arrow">›</span>
                </div>
                
                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon">
                        <img src="images/step4-icon.png" alt="Kartu Peserta" onerror="this.src='https://via.placeholder.com/80?text=💳'">
                    </div>
                    <h3 class="step-title">Dapatkan Kartu Kepesertaan</h3>
                    <p>Terima kartu peserta dan nikmati manfaatnya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="manfaat" class="benefits-section">
        <h2 class="section-title">Manfaat Program PERISAI</h2>
        <div class="benefits-container">
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="images/icon-jkk.png" alt="JKK" onerror="this.src='https://via.placeholder.com/35?text=🏥'">
                    </div>
                    <div class="benefit-text">
                        <h3>Jaminan Kecelakaan Kerja (JKK)</h3>
                        <p>Perlindungan saat terjadi kecelakaan kerja dengan biaya pengobatan ditanggung</p>
                    </div>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="images/icon-jkm.png" alt="JKM" onerror="this.src='https://via.placeholder.com/35?text=🛡️'">
                    </div>
                    <div class="benefit-text">
                        <h3>Jaminan Kematian (JKM)</h3>
                        <p>Santunan kematian untuk ahli waris peserta</p>
                    </div>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="images/icon-jht.png" alt="JHT" onerror="this.src='https://via.placeholder.com/35?text=💵'">
                    </div>
                    <div class="benefit-text">
                        <h3>Jaminan Hari Tua (JHT)</h3>
                        <p>Tabungan untuk masa depan dengan hasil investasi yang menguntungkan</p>
                    </div>
                </div>
                
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <img src="images/icon-jp.png" alt="JP" onerror="this.src='https://via.placeholder.com/35?text=🏦'">
                    </div>
                    <div class="benefit-text">
                        <h3>Jaminan Pensiun (JP)</h3>
                        <p>Jaminan penghasilan di hari tua untuk kehidupan yang lebih sejahtera</p>
                    </div>
                </div>
            </div>
            
            <div class="video-container">
                <h3>Kenali Lebih Dekat Program PERISAI</h3>
                <div class="video-placeholder">
                    <div class="play-button"></div>
                    <p style="margin-top: 1rem; color: #666;">Tonton Video</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="contact-section">
        <h2 class="section-title">Hubungi Kami</h2>
        <div class="contact-container">
            <div class="contact-info">
                <h2>Hubungi Kami</h2>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <img src="images/icon-email.png" alt="Email" onerror="this.src='https://via.placeholder.com/20?text=✉️'">
                    </div>
                    <div class="contact-text">
                        <strong>Email:</strong><br>
                        info@perisai-bpjs.go.id
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <img src="images/icon-phone.png" alt="Phone" onerror="this.src='https://via.placeholder.com/20?text=📞'">
                    </div>
                    <div class="contact-text">
                        <strong>Telepon:</strong><br>
                        0812-4456-7890
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <img src="images/icon-location.png" alt="Location" onerror="this.src='https://via.placeholder.com/20?text=📍'">
                    </div>
                    <div class="contact-text">
                        <strong>Alamat:</strong><br>
                        Jl. Gatot Subroto No. 99, Jakarta
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <form id="contactForm" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" name="nama" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="pesan">Pesan</label>
                        <textarea id="pesan" name="pesan" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn-submit">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <p>&copy; 2024 BPJS Ketenagakerjaan - Program PERISAI. Semua Hak Cipta Dilindungi.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Twitter">𝕏</a>
                <a href="#" aria-label="Instagram">📷</a>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="js/script.js"></script>
</body>
</html>
