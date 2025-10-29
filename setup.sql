/*
 * File: setup.sql
 * Deskripsi: Setup database dan tabel untuk aplikasi inventaris.
 */

-- 1. Buat database 'db_inventaris' jika belum ada
CREATE DATABASE IF NOT EXISTS db_inventaris 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

-- 2. Gunakan database yang baru dibuat
USE db_inventaris;

-- 3. Hapus tabel 'barang' jika sudah ada (untuk setup ulang)
DROP TABLE IF EXISTS barang;

-- 4. Buat tabel 'barang'
CREATE TABLE barang (
    -- 'id' sebagai primary key
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    -- 'kode_barang' sebagai kolom kunci, harus unik
    kode_barang VARCHAR(50) NOT NULL UNIQUE,
    
    nama_barang VARCHAR(255) NOT NULL,
    jumlah INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    
    -- 'created_at' untuk fitur "urutkan berdasarkan created_at desc"
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    -- 'updated_at' akan otomatis update saat ada perubahan baris
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 5. (Opsional) Masukkan beberapa data contoh
INSERT INTO barang (kode_barang, nama_barang, jumlah, deskripsi) VALUES
('BRG-001', 'Monitor LED 24 Inch', 15, 'Monitor untuk desainer grafis.'),
('BRG-002', 'Keyboard Mechanical', 30, 'Keyboard dengan switch biru.'),
('BRG-003', 'Mouse Wireless', 50, 'Mouse optik dengan koneksi bluetooth.'),
('BRG-004', 'Laptop Core i7', 10, 'Laptop 16GB RAM, 512GB SSD.'),
('BRG-005', 'Kabel HDMI 2M', 100, 'Kabel HDMI v2.0 high speed.'),
('BRG-006', 'Webcam 1080p', 25, 'Webcam untuk video conference.'),
('BRG-007', 'Hard Disk Eksternal 1TB', 40, 'HDD Eksternal USB 3.0.');