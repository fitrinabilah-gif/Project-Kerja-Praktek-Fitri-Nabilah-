# DOKUMENTASI DATABASE PERISAI

## Informasi Umum
- **Nama Database**: perisai_db
- **Charset**: UTF-8
- **Collation**: utf8_general_ci
- **Engine**: InnoDB

## Struktur Tabel

### 1. Tabel: admin
**Deskripsi**: Menyimpan data administrator sistem

| Field | Type | Null | Key | Extra | Keterangan |
|-------|------|------|-----|-------|------------|
| id | INT(11) | NO | PRI | auto_increment | ID admin (primary key) |
| username | VARCHAR(50) | NO | UNI | | Username login (unique) |
| password | VARCHAR(255) | NO | | | Password (hashed) |
| nama_lengkap | VARCHAR(255) | YES | | | Nama lengkap admin |
| email | VARCHAR(255) | YES | | | Email admin |

**Default Data**:
- Username: admin
- Password: admin123 (hashed: $2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi)

---

### 2. Tabel: pendaftaran
**Deskripsi**: Menyimpan data pendaftaran peserta PERISAI

| Field | Type | Null | Key | Extra | Keterangan |
|-------|------|------|-----|-------|------------|
| id | INT(11) | NO | PRI | auto_increment | ID pendaftaran |
| nama | VARCHAR(255) | NO | | | Nama lengkap peserta |
| email | VARCHAR(255) | NO | | | Email peserta |
| no_hp | VARCHAR(20) | YES | | | Nomor HP/WhatsApp |
| alamat | TEXT | YES | | | Alamat lengkap |
| tanggal_daftar | TIMESTAMP | NO | | DEFAULT CURRENT_TIMESTAMP | Waktu pendaftaran |

**Index**:
- PRIMARY KEY (id)
- INDEX idx_email (email)
- INDEX idx_tanggal (tanggal_daftar)

---

### 3. Tabel: pesan
**Deskripsi**: Menyimpan pesan/kontak dari pengunjung

| Field | Type | Null | Key | Extra | Keterangan |
|-------|------|------|-----|-------|------------|
| id | INT(11) | NO | PRI | auto_increment | ID pesan |
| nama | VARCHAR(255) | NO | | | Nama pengirim |
| email | VARCHAR(255) | NO | | | Email pengirim |
| pesan | TEXT | NO | | | Isi pesan |
| tanggal_kirim | TIMESTAMP | NO | | DEFAULT CURRENT_TIMESTAMP | Waktu pengiriman |
| status | ENUM | NO | | DEFAULT 'belum_dibaca' | Status: belum_dibaca / dibaca |

**Status Values**:
- belum_dibaca: Pesan belum dibaca admin
- dibaca: Pesan sudah dibaca admin

**Index**:
- PRIMARY KEY (id)
- INDEX idx_status (status)
- INDEX idx_tanggal (tanggal_kirim)

---

### 4. Tabel: statistik
**Deskripsi**: Menyimpan data statistik untuk dashboard

| Field | Type | Null | Key | Extra | Keterangan |
|-------|------|------|-----|-------|------------|
| id | INT(11) | NO | PRI | auto_increment | ID statistik |
| total_peserta | INT(11) | YES | | DEFAULT 0 | Total peserta terdaftar |
| total_pekerja_terdaftar | INT(11) | YES | | DEFAULT 0 | Total pekerja aktif |
| total_klaim_diproses | INT(11) | YES | | DEFAULT 0 | Total klaim diproses |
| last_updated | TIMESTAMP | NO | | ON UPDATE CURRENT_TIMESTAMP | Waktu update terakhir |

**Default Data**:
- total_peserta: 5000
- total_pekerja_terdaftar: 3500
- total_klaim_diproses: 1200

---

## Query Umum

### Insert Data Pendaftaran
```sql
INSERT INTO pendaftaran (nama, email, no_hp, alamat) 
VALUES ('John Doe', 'john@email.com', '08123456789', 'Jakarta');
```

### Insert Data Pesan
```sql
INSERT INTO pesan (nama, email, pesan) 
VALUES ('Jane Doe', 'jane@email.com', 'Saya ingin bertanya tentang PERISAI');
```

### Update Status Pesan
```sql
UPDATE pesan SET status = 'dibaca' WHERE id = 1;
```

### Get Recent Registrations
```sql
SELECT * FROM pendaftaran 
ORDER BY tanggal_daftar DESC 
LIMIT 10;
```

### Get Unread Messages
```sql
SELECT * FROM pesan 
WHERE status = 'belum_dibaca' 
ORDER BY tanggal_kirim DESC;
```

### Count Registrations by Month
```sql
SELECT 
    MONTH(tanggal_daftar) as bulan,
    YEAR(tanggal_daftar) as tahun,
    COUNT(*) as total
FROM pendaftaran
GROUP BY YEAR(tanggal_daftar), MONTH(tanggal_daftar)
ORDER BY tahun DESC, bulan DESC;
```

### Get Statistics
```sql
SELECT * FROM statistik ORDER BY id DESC LIMIT 1;
```

---

## Backup & Restore

### Backup Database
```bash
# Via Command Line
mysqldump -u root -p perisai_db > backup_perisai_$(date +%Y%m%d).sql

# Via phpMyAdmin
# Export → Quick → Format: SQL → Go
```

### Restore Database
```bash
# Via Command Line
mysql -u root -p perisai_db < backup_perisai.sql

# Via phpMyAdmin
# Import → Choose File → Go
```

---

## Maintenance

### Optimize Tables
```sql
OPTIMIZE TABLE pendaftaran;
OPTIMIZE TABLE pesan;
OPTIMIZE TABLE admin;
OPTIMIZE TABLE statistik;
```

### Check Table Status
```sql
SHOW TABLE STATUS FROM perisai_db;
```

### Database Size
```sql
SELECT 
    table_schema AS 'Database',
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) AS 'Size (MB)'
FROM information_schema.tables
WHERE table_schema = 'perisai_db'
GROUP BY table_schema;
```

---

## Security Notes

1. **Password Hashing**: Semua password admin menggunakan PHP `password_hash()` dengan algoritma bcrypt
2. **SQL Injection Prevention**: Gunakan prepared statements untuk semua query
3. **Input Validation**: Validasi dan sanitize semua input user
4. **Regular Backup**: Backup database secara berkala (minimal 1x seminggu)
5. **Access Control**: Batasi akses database hanya dari localhost di production

---

© 2024 BPJS Ketenagakerjaan - Program PERISAI
