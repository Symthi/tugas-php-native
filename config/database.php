<?php
date_default_timezone_set('Asia/Makassar'); 

$host = '127.0.0.1';
$db   = 'db_inventaris';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     error_log("Koneksi Gagal: " . $e->getMessage());
     die("Koneksi ke database gagal. Silakan coba lagi nanti.");
}