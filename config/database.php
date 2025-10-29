<?php
/*
 * File: config/database.php
 * Deskripsi: Koneksi database menggunakan PDO (WAJIB)
 */

// Atur zona waktu default
date_default_timezone_set('Asia/Makassar'); 

// Konfigurasi Database (sesuai Laragon)
$host = '127.0.0.1';       // atau 'localhost'
$db   = 'db_inventaris'; // Nama database dari setup.sql
$user = 'root';            // User default Laragon
$pass = '';                // Password default Laragon (kosong)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    // Opsi 1: Mode error -> Exceptions (WAJIB)
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    // Opsi 2: Mode fetch -> Associative Array
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    // Opsi 3: Matikan emulasi prepared statements (untuk keamanan)
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     // Buat instance PDO
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     // Fitur: Pesan error informatif, tidak menampilkan stack trace
     error_log("Koneksi Gagal: " . $e->getMessage()); // Log error ke server
     die("Koneksi ke database gagal. Silakan coba lagi nanti.");
}