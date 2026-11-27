-- Database: perisai_db
-- Buat database terlebih dahulu di phpMyAdmin

CREATE DATABASE IF NOT EXISTS perisai_db;
USE perisai_db;

-- Tabel untuk menyimpan data pendaftaran
CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    no_hp VARCHAR(20),
    alamat TEXT,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel untuk menyimpan pesan/kontak
CREATE TABLE IF NOT EXISTS pesan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    pesan TEXT NOT NULL,
    tanggal_kirim TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('belum_dibaca', 'dibaca') DEFAULT 'belum_dibaca'
);

-- Tabel untuk admin
CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(255),
    email VARCHAR(255)
);

-- Insert admin default (username: admin, password: admin123)
INSERT INTO admin (username, password, nama_lengkap, email) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 'admin@perisai-bpjs.go.id');

-- Tabel untuk statistik
CREATE TABLE IF NOT EXISTS statistik (
    id INT AUTO_INCREMENT PRIMARY KEY,
    total_peserta INT DEFAULT 0,
    total_pekerja_terdaftar INT DEFAULT 0,
    total_klaim_diproses INT DEFAULT 0,
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert data statistik awal
INSERT INTO statistik (total_peserta, total_pekerja_terdaftar, total_klaim_diproses) VALUES 
(5000, 3500, 1200);
