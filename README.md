# Website PERISAI - BPJS Ketenagakerjaan

Website untuk program PERISAI (Penggerak Jaminan Sosial Indonesia) yang membantu pekerja mandiri dan informal bergabung dengan BPJS Ketenagakerjaan.

## Teknologi yang Digunakan

- **PHP** - Server-side scripting
- **CSS** - Styling dan desain responsif
- **JavaScript** - Interaktivitas dan validasi form
- **MySQL** - Database management

## Fitur Website

### Frontend (Pengunjung)
- Halaman beranda dengan informasi lengkap tentang PERISAI
- Informasi tentang program dan manfaat
- Panduan cara bergabung dengan BPJS Ketenagakerjaan
- Formulir pendaftaran online
- Formulir kontak
- Desain responsif (mobile-friendly)

### Backend (Admin)
- Dashboard admin dengan statistik
- Manajemen data pendaftaran
- Manajemen pesan dari pengunjung
- Sistem login yang aman

## Struktur Folder

```
perisai-website/
│
├── admin/                  # Folder admin panel
│   ├── login.php          # Halaman login admin
│   ├── dashboard.php      # Dashboard admin
│   └── logout.php         # Logout admin
│
├── css/                   # Folder CSS
│   └── style.css         # File CSS utama
│
├── js/                    # Folder JavaScript
│   └── script.js         # File JavaScript utama
│
├── images/               # Folder gambar (buat folder ini)
│   └── (letakkan semua gambar di sini)
│
├── includes/             # Folder konfigurasi
│   └── config.php       # Konfigurasi database
│
├── index.php            # Halaman utama
├── daftar.php           # Halaman pendaftaran
├── submit_form.php      # Handler form kontak
└── database.sql         # File SQL database
```

## Cara Instalasi di XAMPP

### 1. Install XAMPP
- Download XAMPP dari https://www.apachefriends.org/
- Install XAMPP di komputer Anda
- Jalankan XAMPP Control Panel

### 2. Persiapan Folder
1. Copy folder `perisai-website` ke `C:\xampp\htdocs\`
2. Sehingga lokasinya menjadi: `C:\xampp\htdocs\perisai-website\`

### 3. Setup Database
1. Jalankan **Apache** dan **MySQL** di XAMPP Control Panel
2. Buka browser dan akses: `http://localhost/phpmyadmin`
3. Klik tab "SQL"
4. Copy seluruh isi file `database.sql`
5. Paste di kolom SQL dan klik "Go"
6. Database `perisai_db` akan terbuat otomatis dengan semua tabelnya

### 4. Konfigurasi Database (Opsional)
File `includes/config.php` sudah dikonfigurasi dengan setting default XAMPP:
```php
DB_HOST: localhost
DB_USER: root
DB_PASS: (kosong)
DB_NAME: perisai_db
```

Jika setting XAMPP Anda berbeda, edit file `includes/config.php`

### 5. Akses Website
Buka browser dan akses:
- **Website Utama**: `http://localhost/perisai-website/`
- **Halaman Pendaftaran**: `http://localhost/perisai-website/daftar.php`
- **Admin Panel**: `http://localhost/perisai-website/admin/login.php`

### 6. Login Admin
- **Username**: admin
- **Password**: admin123

## Cara Menambahkan Gambar

1. Buat folder `images` di dalam folder `perisai-website`
2. Tambahkan gambar-gambar berikut (sesuai kebutuhan):
   - logo-bpjs.png
   - logo-perisai.png
   - hero-illustration.png
   - about-illustration.png
   - icon-education.png
   - icon-registration.png
   - icon-claim.png
   - step1-icon.png sampai step4-icon.png
   - icon-jkk.png, icon-jkm.png, icon-jht.png, icon-jp.png
   - icon-email.png, icon-phone.png, icon-location.png

3. Jika gambar tidak tersedia, website akan menggunakan placeholder otomatis

## Fitur-Fitur Utama

### 1. Form Pendaftaran
- Validasi input (client-side & server-side)
- Data tersimpan di database
- Notifikasi sukses/error

### 2. Form Kontak
- Submit via AJAX (tanpa reload halaman)
- Validasi email
- Data tersimpan di database

### 3. Admin Dashboard
- Statistik total pendaftaran
- Statistik total pesan
- Daftar pendaftaran terbaru
- Daftar pesan terbaru
- Status pesan (dibaca/belum dibaca)

### 4. Responsive Design
- Tampilan optimal di desktop
- Tampilan optimal di tablet
- Tampilan optimal di mobile

## Keamanan

- Password admin di-hash menggunakan PHP password_hash()
- Input user di-sanitize untuk mencegah SQL Injection
- Session management untuk admin login
- CSRF protection (bisa ditambahkan)

## Troubleshooting

### Database Connection Error
- Pastikan MySQL di XAMPP sudah running
- Cek konfigurasi di `includes/config.php`
- Pastikan database `perisai_db` sudah dibuat

### Page Not Found
- Pastikan folder ada di `C:\xampp\htdocs\perisai-website\`
- Cek apakah Apache di XAMPP sudah running
- Akses dengan URL yang benar: `http://localhost/perisai-website/`

### Form Tidak Terkirim
- Cek apakah file `submit_form.php` ada
- Cek console browser untuk error JavaScript
- Cek koneksi database

## Pengembangan Lebih Lanjut

Fitur yang bisa ditambahkan:
- Upload dokumen pendaftaran
- Email notification
- Export data ke Excel
- Grafik statistik
- Multiple admin dengan role berbeda
- Reset password
- Captcha untuk keamanan
- Payment gateway integration

## Support

Jika ada pertanyaan atau masalah, silakan hubungi:
- Email: info@perisai-bpjs.go.id
- Telepon: 0812-4456-7890

## License

© 2024 BPJS Ketenagakerjaan - Program PERISAI
