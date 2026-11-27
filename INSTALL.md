# PANDUAN INSTALASI LENGKAP
# Website PERISAI - BPJS Ketenagakerjaan

## LANGKAH-LANGKAH INSTALASI DI XAMPP

### A. PERSIAPAN AWAL

1. **Install XAMPP**
   - Download dari: https://www.apachefriends.org/
   - Pilih versi PHP 7.4 atau lebih tinggi
   - Install di C:\xampp (default location)

2. **Download Website PERISAI**
   - Extract folder perisai-website
   - Lokasi hasil extract akan berisi:
     * admin/
     * css/
     * js/
     * includes/
     * database.sql
     * index.php
     * daftar.php
     * submit_form.php
     * README.md
     * .htaccess

### B. INSTALASI DATABASE

1. **Jalankan XAMPP**
   - Buka XAMPP Control Panel
   - Start "Apache"
   - Start "MySQL"
   - Pastikan kedua service berwarna hijau

2. **Buat Database**
   - Buka browser (Chrome/Firefox)
   - Ketik: http://localhost/phpmyadmin
   - Klik "New" di sidebar kiri
   - Nama database: perisai_db
   - Collation: utf8_general_ci
   - Klik "Create"

3. **Import Database**
   Cara 1 - Via phpMyAdmin:
   - Pilih database "perisai_db"
   - Klik tab "Import"
   - Click "Choose File"
   - Pilih file "database.sql"
   - Scroll ke bawah, klik "Go"
   - Tunggu hingga muncul "Import has been successfully finished"

   Cara 2 - Via SQL Tab:
   - Pilih database "perisai_db"
   - Klik tab "SQL"
   - Buka file database.sql dengan Notepad
   - Copy semua isi file
   - Paste di kolom SQL
   - Klik "Go"

4. **Verifikasi Database**
   - Klik database "perisai_db"
   - Pastikan ada 4 tabel:
     * admin
     * pendaftaran
     * pesan
     * statistik

### C. INSTALASI WEBSITE

1. **Copy File Website**
   - Copy folder "perisai-website" ke: C:\xampp\htdocs\
   - Path lengkap: C:\xampp\htdocs\perisai-website\

2. **Struktur Folder Akhir**
   ```
   C:\xampp\htdocs\perisai-website\
   ├── admin\
   │   ├── login.php
   │   ├── dashboard.php
   │   └── logout.php
   ├── css\
   │   └── style.css
   ├── js\
   │   └── script.js
   ├── includes\
   │   └── config.php
   ├── images\ (buat folder ini)
   ├── index.php
   ├── daftar.php
   ├── submit_form.php
   ├── database.sql
   ├── README.md
   └── .htaccess
   ```

3. **Buat Folder Images**
   - Buat folder "images" di dalam perisai-website
   - Path: C:\xampp\htdocs\perisai-website\images\
   - Copy semua gambar ke folder ini

### D. KONFIGURASI (JIKA DIPERLUKAN)

Jika database tidak bisa connect, edit file: includes/config.php

```php
define('DB_HOST', 'localhost');     // Alamat MySQL
define('DB_USER', 'root');          // Username MySQL
define('DB_PASS', '');              // Password MySQL (kosong untuk default)
define('DB_NAME', 'perisai_db');   // Nama database
```

### E. TESTING WEBSITE

1. **Test Halaman Utama**
   - Buka: http://localhost/perisai-website/
   - Harus muncul halaman beranda PERISAI

2. **Test Form Pendaftaran**
   - Klik menu "Daftar Sekarang"
   - Atau akses: http://localhost/perisai-website/daftar.php
   - Isi form dan submit
   - Harus muncul pesan sukses

3. **Test Form Kontak**
   - Scroll ke bagian Kontak di halaman utama
   - Isi form dan submit
   - Harus muncul alert sukses

4. **Test Admin Panel**
   - Akses: http://localhost/perisai-website/admin/login.php
   - Username: admin
   - Password: admin123
   - Harus masuk ke dashboard

### F. VERIFIKASI DATA

1. **Cek Data Pendaftaran**
   - Login ke admin panel
   - Lihat di dashboard
   - Atau cek langsung di phpMyAdmin → perisai_db → tabel pendaftaran

2. **Cek Data Pesan**
   - Login ke admin panel
   - Lihat di dashboard
   - Atau cek langsung di phpMyAdmin → perisai_db → tabel pesan

## TROUBLESHOOTING

### Problem 1: "Object not found" atau 404
**Solusi:**
- Pastikan folder ada di C:\xampp\htdocs\perisai-website\
- Pastikan Apache di XAMPP sudah running
- Akses dengan: http://localhost/perisai-website/ (perhatikan slash)

### Problem 2: "Database connection failed"
**Solusi:**
- Pastikan MySQL di XAMPP sudah running
- Cek database sudah dibuat dengan nama: perisai_db
- Cek username/password di includes/config.php
- Default XAMPP: user=root, password=(kosong)

### Problem 3: Form tidak terkirim
**Solusi:**
- Cek console browser (F12) untuk error JavaScript
- Pastikan file submit_form.php ada
- Cek koneksi database
- Cek permission folder (chmod 755 di Linux)

### Problem 4: Gambar tidak muncul
**Solusi:**
- Buat folder images/ jika belum ada
- Copy semua file gambar ke folder images/
- Atau biarkan (akan muncul placeholder)

### Problem 5: CSS tidak load
**Solusi:**
- Pastikan folder css/ ada
- Pastikan file css/style.css ada
- Clear browser cache (Ctrl+F5)
- Cek path di index.php: <link rel="stylesheet" href="css/style.css">

### Problem 6: Cannot login admin
**Solusi:**
- Pastikan tabel admin sudah ada data
- Cek di phpMyAdmin → perisai_db → admin
- Jika kosong, jalankan ulang database.sql
- Default login: admin / admin123

## CARA MENGGANTI PASSWORD ADMIN

1. Buka: http://localhost/phpmyadmin
2. Pilih database: perisai_db
3. Klik tabel: admin
4. Klik tab "SQL"
5. Jalankan query:

```sql
-- Ganti password menjadi "newpassword123"
UPDATE admin 
SET password = '$2y$10$Q3Xv5Z8xKE5ydZ4p.VxJcO7a8g3fB9pD1L2wN5mK3qA2rT7sU9vWe' 
WHERE username = 'admin';
```

Atau generate hash baru dengan PHP:
```php
<?php echo password_hash('newpassword123', PASSWORD_DEFAULT); ?>
```

## CARA BACKUP DATABASE

### Via phpMyAdmin:
1. Buka: http://localhost/phpmyadmin
2. Pilih database: perisai_db
3. Klik tab "Export"
4. Pilih "Quick" export method
5. Format: SQL
6. Klik "Go"
7. File akan terdownload

### Via Command Line:
```bash
cd C:\xampp\mysql\bin
mysqldump -u root perisai_db > backup.sql
```

## CARA RESTORE DATABASE

### Via phpMyAdmin:
1. Buka: http://localhost/phpmyadmin
2. Pilih database: perisai_db
3. Klik tab "Import"
4. Choose file → pilih file backup
5. Klik "Go"

### Via Command Line:
```bash
cd C:\xampp\mysql\bin
mysql -u root perisai_db < backup.sql
```

## DEPLOY KE HOSTING (ONLINE)

1. **Upload Files**
   - Upload semua file via FTP/cPanel File Manager
   - Jangan upload folder xampp atau database.sql ke root

2. **Create Database**
   - Buat database via cPanel → MySQL Databases
   - Catat nama database, username, dan password

3. **Import Database**
   - Via phpMyAdmin hosting
   - Import file database.sql

4. **Update Config**
   - Edit includes/config.php
   - Sesuaikan DB_HOST, DB_USER, DB_PASS, DB_NAME
   - dengan data dari hosting

5. **Test Website**
   - Akses domain Anda
   - Test semua fitur

## KONTAK SUPPORT

Jika masih ada masalah:
- Email: support@perisai.com
- WhatsApp: 0812-4456-7890

---
© 2024 BPJS Ketenagakerjaan - Program PERISAI
