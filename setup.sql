CREATE DATABASE IF NOT EXISTS db_inventaris 
DEFAULT CHARACTER SET utf8mb4 
DEFAULT COLLATE utf8mb4_general_ci;

USE db_inventaris;

DROP TABLE IF EXISTS barang;

CREATE TABLE barang (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    kode_barang VARCHAR(50) NOT NULL UNIQUE,
    
    nama_barang VARCHAR(255) NOT NULL,
    jumlah INT NOT NULL DEFAULT 0,
    deskripsi TEXT NULL,
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT INTO barang (kode_barang, nama_barang, jumlah, deskripsi) VALUES
('BRG-001', 'Monitor LED 24 Inch', 15, 'Monitor untuk desainer grafis.'),
('BRG-002', 'Keyboard Mechanical', 30, 'Keyboard dengan switch biru.'),
('BRG-003', 'Mouse Wireless', 50, 'Mouse optik dengan koneksi bluetooth.'),
('BRG-004', 'Laptop Core i7', 10, 'Laptop 16GB RAM, 512GB SSD.'),
('BRG-005', 'Kabel HDMI 2M', 100, 'Kabel HDMI v2.0 high speed.'),
('BRG-006', 'Webcam 1080p', 25, 'Webcam untuk video conference.'),
('BRG-007', 'Hard Disk Eksternal 1TB', 40, 'HDD Eksternal USB 3.0.');