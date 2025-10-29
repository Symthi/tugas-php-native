<?php
/*
 * File: hapus.php
 * Deskripsi: FITUR Delete - Logika hapus data
 */
session_start();
require_once 'config/database.php';

// Pastikan parameter ID ada dan valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // FITUR Keamanan: SQL Injection dicegah
        $stmt = $pdo->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);

        $_SESSION['pesan'] = "Data barang berhasil dihapus.";

    } catch (\PDOException $e) {
        // Jika terjadi error (misal: foreign key constraint)
        error_log("Error Hapus: " . $e->getMessage());
        $_SESSION['pesan'] = "Gagal menghapus data. Terjadi kesalahan.";
    }

} else {
    $_SESSION['pesan'] = "ID tidak valid.";
}

// Redirect kembali ke halaman utama
header("Location: index.php");
exit;